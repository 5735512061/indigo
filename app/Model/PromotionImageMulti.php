<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class PromotionImageMulti extends Model
{
	protected $table = 'promotion_image_multis';

	protected $fillable = [
    	'promotion_id', 'image_multi'
    ];

    protected $primaryKey = 'id';
}
