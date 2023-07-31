<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class TourImageMulti extends Model
{
	protected $table = 'tour_image_multis';

	protected $fillable = [
    	'tour_id', 'image_multi'
    ];

    protected $primaryKey = 'id';
}
