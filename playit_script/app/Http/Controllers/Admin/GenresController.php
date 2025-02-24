<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Genres;
use App\Models\Items;

class GenresController extends MainAdminController{

 	//Display Genres List
    public function lists_genres()
    {
        $data = Genres::orderBy('name', 'ASC')->paginate(10)->onEachSide(1);
        return view('admin.genres.lists',compact('data'));
    }

    //Display Genres Add
    public function add_genre()
    {
        return view('admin.genres.add');
    }

    //Display Genres Edit
    public function edit_genre($id)
    {
        $genresl = Genres::find($id);
        return view('admin.genres.edit',compact('genresl'));
    }

    //CODE Genres Update
    public function update_genre()
    {
        $this->validate($request,[
            'name' => 'required'
        ], [
            'name.required' => 'Name Field is Required!',
        ]);

        $genres = Genres::find($id);
        $genres->name = $request->name;
        $genres->save();

        return redirect()->action([GenresController::class,'lists_genres'])->with('success','Genres Updated Successfully');
    }

    //CODE Genres Save
    public function save_genre(Request $request){
        $this->validate($request,[
            'name' => 'required'
        ], [
            'name.required' => 'Name Field is Required!',
        ]);

        $genres = new Genres();
        $genres->name = $request->name;

        $genres->visible = 1;
        $genres->save();

        return redirect()->action([GenresController::class,'lists_genres'])->with('success','Genre Created Successfully');
    }

    //CODE Genres Delete
    public function delete($id)
    {
        $ids = trim($id, '[]');
        $genresid = explode(",",$ids);
        $genres = Genres::whereIn('id', $genresid)->get();

        foreach ($genres as $genre ) {
            //Delete Movie
            $genre->delete();
        }

        return redirect()->action([GenresController::class,'lists_genres'])->with('success','Genre Deleted Successfully');
    }

}
