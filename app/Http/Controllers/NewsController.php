<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index() {
        $full_list_data = News::all() -> sortByDesc('updated_at');
        
        if (empty($full_list_data)) {
            $headline = null;
        } else {
            $headline = $full_list_data-> shift();
        }
        
        return view('news.index', ['every_news'=> $full_list_data, 'headline' => $headline]);
    }
}
