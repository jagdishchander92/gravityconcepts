<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //
    protected $fillable = [
        'title',
        'sub_title',
        'card_type',
        'card_img',
        'card_icon',
        'btn_title',
        'btn_url',
    ];
}
