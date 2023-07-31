<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
	protected $table = 'tours';

	protected $fillable = [
    	'id','admin_id', 'type_id', 'title', 'title_eng', 'image_main', 'date', 'expire', 'status'
    ];

    protected $primaryKey = 'id';
}
