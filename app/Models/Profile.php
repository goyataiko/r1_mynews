<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required',
        'age' => 'required|numeric',
        'introduction' => 'required',
    );
    
    public function histories(){
        // return $this->hasMany('App\Models\NewsHistory');
    }
}
