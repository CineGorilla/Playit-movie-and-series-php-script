<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    public function items(){
    	return $this->belongsTo('App\Models\Items','itmes_id','id');
    }

    public function user(){
    	return $this->belongsTo('App\Models\User','email','email');
    }
}