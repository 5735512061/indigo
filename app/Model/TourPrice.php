<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class TourPrice extends Model
{
	protected $table = 'tour_prices';

	protected $fillable = [
    	'tour_id', 'price', 'status'
    ];

    protected $primaryKey = 'id';
}
