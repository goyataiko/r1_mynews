<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    use HasFactory;
    
    protected $guared = array('id');
    
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
}
