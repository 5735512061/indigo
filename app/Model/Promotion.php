<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
	protected $table = 'promotions';

	protected $fillable = [
    	'admin_id', 'title', 'title_eng', 'image_main', 'date', 'expire', 'status'
    ];

    protected $primaryKey = 'id';
}
