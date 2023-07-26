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
        // SQL 쿼리에서 LIKE 연산자를 사용, searched가 포함된 모든 값 검색하도록 함
        // searched와 정확히 일치하는 값을 찾을 경우, where('title', $searched)
        if ($searched != '') {
            $posts = News::where('title', 'LIKE', '%' . $searched . '%')
             ->orWhere('text', 'LIKE', '%' . $searched . '%')
             ->get();
        } else {
            $posts = News::all();
        }
        
        //posts, search_value는 해당 blade파일에서 받아오는 인수명 
        return view('admin.news.index', ['news' => $posts, 'search_value' => $searched]);
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
            $news_table -> image_path = basename($path);
        } else {
            $news_table -> image_path = null;
        }

        //쓰고 남은 정보 삭제
        unset($form['_token']);
        unset($form['image']);

        //데이터베이스 보존
        $news_table->fill($form);
        $news_table->save();

        return redirect('admin/news/');
    }
    
    
    
    //==================  Edit Update 기능 ==================
    //==================
    public function edit(Request $request){
        
        $original_news_table = News::find($request->id);
        if(empty($original_news_table)){
            abort(404);
        }
        //news_form은 해당 blade파일에서 받아오는 인수명 
        return view('admin.news.edit',['news_form'=> $original_news_table]);
    }
    
    public function update(Request $request) {
        //유효성검사
        $this -> validate($request, News::$rules);
        
        $original_news_table = News::find($request->id);
        //송신된 데이터 저장 
        $new_news_form = $request-> all();
            //이미지 부분
                   //remove값이 있으면 이미지를 삭제 
            if ($request->remove == 'true'){
                $new_news_form['image_path']=null;
                    //새로 송신된 이미지 파일이 있나? 
            } elseif ($request -> file('image')) {
                $path = $request->file('image')->store('public/image');
                $new_news_form['image_path'] = basename($path);
                // remove도 없고, 새로 송신된 이미지도 아니라면, 
                // 그대로 이전 image_path를 계속 써라 
            } else {
                $new_news_form['image_path'] = $original_news_table->image_path;
            }
        
        unset($new_news_form['_token']);
        unset($new_news_form['remove']);
        unset($new_news_form['image']);
        
        //덮어쓰기
        $original_news_table->fill($new_news_form)-> save();
        //아래 2줄의 축약형
        // $original_news_table->fill($new_news_form);
        // $original_news_table->save();

        return redirect('admin/news');
    }
    
    //==================  Delete 기능 ==================
    //==================
    public function delete(Request $request){
        
        $original_news_table = News::find($request->id);
        $original_news_table-> delete();
        
        return redirect('admin/news/');
    }    
}
