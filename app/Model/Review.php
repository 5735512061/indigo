<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	protected $table = 'reviews';

	protected $fillable = [
    	'admin_id', 'image', 'status'
    ];

    protected $primaryKey = 'id';
}
