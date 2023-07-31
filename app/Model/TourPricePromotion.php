<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class TourPricePromotion extends Model
{
	protected $table = 'tour_price_promotions';

	protected $fillable = [
    	'tour_id', 'price', 'status'
    ];

    protected $primaryKey = 'id';
}
