<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ImageSlide extends Model
{
	protected $table = 'image_slides';

	protected $fillable = [
    	'admin_id', 'image', 'status'
    ];

    protected $primaryKey = 'id';
}
