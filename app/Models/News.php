<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');
    
    public static $rules = array(
        'title' => 'required',
        'text' => 'required',
    );
    
    public function histories()
    {
        return $this->hasMany('App\Models\NewsHistory');
    }
    
}
