<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ImageLogo extends Model
{
	protected $table = 'image_logos';

	protected $fillable = [
    	'admin_id', 'image', 'status'
    ];

    protected $primaryKey = 'id';
}
