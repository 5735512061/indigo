<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $table = 'articles';

	protected $fillable = [
    	'admin_id', 'title','title_eng', 'image_main', 'image_multi', 'article', 'article_eng', 'date', 'status'
    ];

    protected $primaryKey = 'id';
}
