<?php


namespace Sabt\Media\Models;


use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $guarded = [];

    protected $casts=[
        'files'=>'json'
    ];
}
