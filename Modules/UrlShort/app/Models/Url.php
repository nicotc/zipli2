<?php

namespace Modules\UrlShort\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\UrlShort\Database\Factories\UrlFactory;

class Url extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'url',
        'code',
        'description',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // APEND
    protected $appends = ['short_url'];


    public function getShortUrlAttribute(): string
    {
        $urlBase = config('app.url');
        return $urlBase . '/p/' . $this->code;
    }

    public function details()
    {
        return $this->hasMany(UrlDetail::class);
    }
}
