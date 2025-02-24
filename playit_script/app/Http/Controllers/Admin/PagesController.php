<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Pages;

class PagesController extends MainAdminController{  
    
    //Display Pages List
    public function lists_pages(Request $request){
        $data = Pages::orderBy('id', 'DESC')->paginate(10)->onEachSide(1);
        return view('admin.pages.lists',compact('data'));
    }   

    //Display Pages Add
    public function add_pages(){
        return view('admin.pages.add');
    }  

    //Display Pages Edit
    public function edit_pages($id){
        $pages = Pages::find($id);
        return view('admin.pages.edit',compact('pages'));
    }  

    //CODE Pages Save
    public function save_pages(Request $request){
        $this->validate($request,[
            'page_title' => 'required|unique:pages,title',
        ], [ 
            'page_title.required' => 'Page title required!',
            'page_title.unique' => 'Page title already been use! please use some other title',
        ]);

        $pages = new Pages();

        $pages->title = $request->page_title;
        $pages->slug = Str::slug($request->page_title);
        $pages->summary = $request->page_summary;

        if(isset($request->page_showin)){
            $pages->show_in = $request->page_showin;
        }else{
            $pages->show_in = '';
        }

        $pages->content = $request->page_body;
        $pages->visible = 1;
        $pages->views = 0;

        $pages->save();

        return redirect()->action([PagesController::class,'lists_pages'])->with('success','Pages Created Successfully');
    }

    //CODE Pages Update
    public function update_pages(Request $request, $id){
        $this->validate($request,[
            'page_title' => 'required',
        ], [ 
            'page_title.required' => 'Page title required!',
        ]);

        $pages = Pages::find($id);
        $pages->title = $request->page_title;
        $pages->slug = Str::slug($request->page_title);
        $pages->summary = $request->page_summary;

        if(isset($request->page_showin)){
            $pages->show_in = $request->page_showin;
        }else{
            $pages->show_in = '';
        }
        $pages->content = $request->page_body;

        $pages->save();

        return redirect()->action([PagesController::class,'lists_pages'])->with('success','Pages Updated Successfully');
    }

    //CODE Pages Delete
    public function delete_pages($id){
        $ids = trim($id, '[]');
        $pagesid = explode(",",$ids);
        $pages = Pages::whereIn('id', $pagesid)->get();

        foreach ($pages as $page ) {   
            //Delete Page
            $page->delete();    
        }

        return redirect()->action([PagesController::class,'lists_pages'])->with('success','Pages Deleted Successfully!');
    }

    //CODE Pages Visible    
    public function visible(Request $request){
        $pages = Pages::find($request->id);
        if ($pages->visible == 1) {
            $pages->visible = 0;
        }else{
            $pages->visible = 1;
        }
        $pages->save();
    }

}