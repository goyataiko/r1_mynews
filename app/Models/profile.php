<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;
    
    protected $guared = array('id');
    
    public static $rules = array(
        'name' => 'required',
        'age' => 'required',
    );
}
