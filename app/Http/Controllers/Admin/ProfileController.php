<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;

class ProfileController extends Controller
{
    //==========index
    //=========
    public function index(Request $request){
        $searched = $request->search_value;
        if($searched !== ''){
            $posts = Profile::where('name','Like','%'.$searched.'%')
             ->orWhere('age', 'LIKE', '%' . $searched . '%')
             ->orWhere('introduction', 'LIKE', '%' . $searched . '%')
             ->get();
        } else{
            $posts = Profile::all();
        }
        return view('admin.profile.index',['posts'=>$posts, 'search_value' => $searched]);
    }
    
    //==========create
    //=========    
    public function add(){
        return view('admin.profile.create');
    }
    
    public function create(Request $request){
        
        $this -> validate($request, Profile::$rules);
        
        $profile_table = new Profile;
        $form = $request-> all();
        
        unset($form['_token']);
        
        $profile_table->fill($form);
        $profile_table->save();        
        
        return redirect('admin/profile/');
    }
    
    //==========edit
    //=========    
    public function edit(Request $request){
    
        $original_profile_table = Profile::find($request->id);
        if(empty($original_profile_table)){
            abort(404);
        }
        
        return view('admin.profile.edit',['profile_form'=>$original_profile_table]);
    }
    
    public function update(Request $request){
        
        $this -> validate($request, Profile::$rules);
        $original_profile_table = Profile::find($request->id);
        $new_profile_table = $request -> all();
        
        unset($new_profile_table['_token']);
        
        $original_profile_table -> fill($new_profile_table) -> save();
        
        return redirect('admin/profile/');
    }
    //==========delete
    //=========    
    public function delete(Request $request) {
        $original_profile_table = Profile::find($request->id);
        $original_profile_table -> delete();
        
        return redirect('admin/profile/');
    }
}
