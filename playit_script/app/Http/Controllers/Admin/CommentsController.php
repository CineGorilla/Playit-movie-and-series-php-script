<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Models\Comments;
use App\Models\Items;

class CommentsController extends MainAdminController{ 

	//Display Comments List
    public function lists_comments(Request $request){
        $data = Comments::orderBy('id', 'DESC')->paginate(10)->onEachSide(1);
        return view('admin.comments.lists',compact('data'));
    }

    public function show($id)
    {
        $items = Items::find($id);
        $data = Comments::with(['items'])->where('post_id',$id)->orderBy('id', 'DESC')->paginate(10)->onEachSide(1);

        return view('admin.comments.lists',compact('data'));
    }

    //CODE Users Block    
    public function approve_comments(Request $request){
        $comments = Comments::find($request->id);
        if ($comments->approve == 1) {
            $comments->approve = 0;
        }else{
            $comments->approve = 1;
        }
        $comments->save();
    }

    public function delete_comments($id){
    	$ids = trim($id, '[]');
        $usersid = explode(",",$ids);
        $comments = Comments::whereIn('id', $usersid)->get();

        foreach ($comments as $comment ) {   
            //Delete Comment
            $comment->delete();    
        }
        return redirect()->action([CommentsController::class,'lists_comments'])->with('success','Comments Deleted Successfully');
    }


    
}