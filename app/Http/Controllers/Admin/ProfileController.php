<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile;

use Carbon\Carbon;
use App\Models\NewsHistory;

class ProfileController extends Controller
{
    //==========index
    //=========
    public function index(Request $request){
        $searched = $request->search_value;
        if($searched !== ''){
            $full_list_data = Profile::where('name','Like','%'.$searched.'%')
             ->orWhere('age', 'LIKE', '%' . $searched . '%')
             ->orWhere('introduction', 'LIKE', '%' . $searched . '%')
             ->get();
        } else{
            $full_list_data = Profile::all();
        }
        return view('admin.profile.index',['every_profile'=>$full_list_data, 'search_value' => $searched]);
    }
    
    //==========create
    //=========    
    public function add(){
        return view('admin.profile.create');
    }
    
    public function create(Request $request){
        
        $this -> validate($request, Profile::$rules);
        
        $profile_table = new Profile;
        $inserted_data = $request-> all();
        
        unset($inserted_data['_token']);
        
        $profile_table->fill($inserted_data);
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
        $inserted_data = $request -> all();
        
        unset($inserted_data['_token']);
        
        $original_profile_table -> fill($inserted_data) -> save();
        
        $history_table = new ProfileHistory();
        $history_table->profile_id = $original_profile_table->id;
        $history_table->profile_name = $original_profile_table->name;
        $history_table->edited_at = Carbon::now('Asia/Tokyo');
        $history_table->save();
        
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
