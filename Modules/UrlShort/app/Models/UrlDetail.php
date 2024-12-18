<?php

namespace Modules\UrlShort\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\UrlShort\Database\Factories\UrlDetailFactory;

class UrlDetail extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'url_id',
        'browser',
        'device',
        'platform',
        'languages',
        'ip'
    ];

    // protected static function newFactory(): UrlDetailFactory
    // {
    //     // return UrlDetailFactory::new();
    // }
}
