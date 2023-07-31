<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class TourType extends Model
{
	protected $table = 'tour_types';

	protected $fillable = [
    	'id', 'type', 'type_eng', 'status'
    ];

    protected $primaryKey = 'id';
}
