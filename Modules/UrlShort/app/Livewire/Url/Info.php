<?php

namespace Modules\UrlShort\Livewire\Url;

use Livewire\Component;
use Modules\UrlShort\Models\Url;
use Modules\UrlShort\Models\UrlDetail;

class Info extends Component
{

    public $totalCreated;
    public $totalVisited;
    public $lastVisited;
    public $urlUnique;

    public function render()
    {


        $url = Url::where('user_id' , auth()->id())->get();

        $urlDetails = UrlDetail::select(
            'url_details.id',
            'url_details.url_id',
            'url_details.created_at',
            'urls.id',
            'urls.url',
            'urls.code',
            'urls.description'
            )
        ->join('urls', 'url_details.url_id', '=', 'urls.id')
        ->whereIn('url_id', $url->pluck('id'))
        ->get();


        

        $this->totalCreated = $url->count();
        $this->totalVisited = $urlDetails->count();
        $this->urlUnique = $url->groupBy('url')->count();
        $this->lastVisited = $urlDetails->last();

        // dd($this->totalCreated, $this->totalVisited, $this->lastVisited);






        return view('urlshort::livewire.url.info');
    }
}
