<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{
	use HasFactory;

	public function series(){
    	return $this->belongsTo('App\Models\Items');
    }
    
    
}