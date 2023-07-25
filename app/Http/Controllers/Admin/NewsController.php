<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\News;

class NewsController extends Controller
{
   //==================  Index 기능 ==================
   //==================
    public function index(Request $request)
    {
        $searched = $request->search_value;
        if ($searched != '') {
            $posts = News::where('title', 'LIKE', '%' . $searched . '%')
             ->orWhere('text', 'LIKE', '%' . $searched . '%')
             ->get();
        } else {
            $posts = News::all();
        }
        return view('admin.news.index', ['posts' => $posts, 'search_value' => $searched]);
    }
    
    
    
    //==================  Add Create 기능 ==================
    //==================
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
    
    
    
    //==================  Edit Update 기능 ==================
    //==================
    public function edit(Request $request){
        
        $news = News::find($request->id);
        if(empty($news)){
            abort(404);
        }
        
        return view('admin.news.edit',['news_form'=> $news]);
    }
    
    public function update(Request $request) {
        //유효성검사
        $this -> validate($request, News::$rules);
        
        $news = News::find($request->id);
        //송신된 데이터 저장 
        $news_form = $request-> all();
            //이미지 부분
                   //remove값이 있으면 이미지를 삭제 
            if ($request->remove == 'true'){
                $news_form['image_path']=null;
                    //새로 송신된 이미지 파일이 있나? 
            } elseif ($request -> file('image')) {
                $path = $request->file('image')->store('public/image');
                $news_form['image_path'] = basename($path);
                // remove도 없고, 새로 송신된 이미지도 아니라면, 
                // 그대로 이전 image_path를 계속 써라 
            } else {
                $news_form['image_path'] = $news->image_path;
            }
        
        unset($news_form['_token']);
        unset($news_form['remove']);
        unset($news_form['image']);
        
        //덮어쓰기
        $news->fill($news_form)-> save();
        //아래 2줄의 축약형
        // $news->fill($news_form);
        // $news->save();

        return redirect('admin/news');
    }
}
