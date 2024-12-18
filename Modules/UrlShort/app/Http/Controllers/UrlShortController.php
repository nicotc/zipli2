<?php

namespace Modules\UrlShort\Http\Controllers;

use Illuminate\Http\Request;
use Modules\UrlShort\Models\Url;
use App\Http\Controllers\Controller;
use Modules\UrlShort\Models\UrlDetail;
use Shetabit\Visitor\Traits\Visitable;

class UrlShortController extends Controller
{
    use Visitable;

    public static function shortUrl($url)
    {
// creamos un string de 6 caracteres letras y numeros aleatorios
        $short_url = substr(md5(uniqid()), 0, 6);
        // chequeamos si ya existe en la base de datos
        $url = Url::where('code', $short_url)->first();
        // si existe llamamos a la funcion de nuevo
        if ($url) {
            return shortUrl($url);
        }
        // si no existe retornamos el string

        return $short_url;
    }

    public function redirect($code)
    {
        $url = Url::where('code', $code)->first();
        if ($url) {
            UrlDetail::create([
                'url_id' => $url->id,
                'browser' => request()->visitor()->browser() ?? 'Unknown',
                'device' => request()->visitor()->device() ?? 'Unknown',
                'platform' => request()->visitor()->platform() ?? 'Unknown',
                'languages' => is_array(request()->visitor()->languages())
            ? implode(',', request()->visitor()->languages())
            : (request()->visitor()->languages() ?? 'Unknown'),
                'ip' => request()->visitor()->ip() ?? 'Unknown',
            ]);

            return redirect($url->url);
        }
        abort(404);
    }

    public function show($id)
    {
        $urls = Url::where('id', $id)
        ->where('user_id', auth()->id())
        ->get();

        if($urls->isEmpty()) {
            abort(404);
        }else {
           $urlDetail = UrlDetail::select('browser', 'device', 'platform', 'languages', 'ip', 'created_at')->where('url_id', $id)->get();
        }

        $data['count'] = count($urlDetail);
        $data['browser'] = $urlDetail->groupBy('browser')->map->count();
        $data['device'] = $urlDetail->groupBy('device')->map->count();
        $data['platform'] = $urlDetail->groupBy('platform')->map->count();
        $data['languages'] = $urlDetail->groupBy('languages')->map->count();
        $data['ip'] = $urlDetail->groupBy('ip')->map->count();
        // ultimo acceso
        $data['last_access'] = $urlDetail->sortByDesc('created_at')->first()->created_at;

        // accesos de los ultimos 7 dias
        $data['last_7_days'] = $urlDetail->where('created_at', '>=', now()->subDays(7))->count();
        //fechas de los ultimos 7 dias
        $data['last_7_days_dates'] = $urlDetail->where('created_at', '>=', now()->subDays(7))->groupBy(function($date) {
            return $date->created_at->format('Y-m-d');
        })->map->count();
        // accesos de los ultimos 30 dias
        $data['last_30_days'] = $urlDetail->where('created_at', '>=', now()->subDays(30))->count();
        //fechas de los ultimos 30 dias
        $data['last_30_days_dates'] = $urlDetail->where('created_at', '>=', now()->subDays(30))->groupBy(function($date) {
            return $date->created_at->format('Y-m-d');
        })->map->count();

        return view('urlshort::show', compact('urls', 'data'));
    }
}
