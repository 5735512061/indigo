<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ArticleImageMulti extends Model
{
	protected $table = 'article_image_multis';

	protected $fillable = [
    	'article_id', 'image_multi'
    ];

    protected $primaryKey = 'id';
}
