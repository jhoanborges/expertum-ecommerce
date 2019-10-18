<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
        protected $table = 'news_letters';
    protected $guarded = ['id'];
	protected $fillable = [];
}
