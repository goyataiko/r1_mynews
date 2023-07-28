<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsHistory extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');

    public static $rules = array(
        'news_id' => 'required',
        'news_title' => 'required',
        'edited_at' => 'required',
        
        'profile_id' => 'required',
        'profile_name' => 'required',
    );
    
}
