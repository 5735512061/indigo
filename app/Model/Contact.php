<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contacts';

	protected $fillable = [
    	'admin_id', 'phone', 'facebook', 'facebook_url', 'line', 'line_url'
    ];

    protected $primaryKey = 'id';
}
