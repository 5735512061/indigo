<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ImageLink extends Model
{
	protected $table = 'image_links';

	protected $fillable = [
    	'admin_id', 'image'
    ];

    protected $primaryKey = 'id';
}
