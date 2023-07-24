<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function add(){
        return view('admin.news.create');
    }
    
    public function create(Request $request) {
        
        // validation규칙 가져오기
        $this -> validate($request, News::$rules);
        
        $news_table = new News;
        $form = $request->all();
        
        // 이미지 수신시, 이미지를 저장하고, 이미지 패스 또한 따로 저장함 
        if(isset($form['image'])){
            $path = $request->file('image')->store('public/image');
            $news_table -> image_path = basename('$path');
        } else {
            $news_table -> image_path = null;
        }
        
        //쓰고 남은 정보 삭제
        unset($form['_token']);
        unset($form['image']);
        
        //데이터베이스 보존
        $news_table->fill($form);
        $news_table->save();
        
        return redirect('admin/news/create');
    }
}
