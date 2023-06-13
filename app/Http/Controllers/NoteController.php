<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Note;
use Auth;

class NoteController extends Controller
{
    public function index(){

        $notes = DB::table('notes')
            ->select(DB::raw('notes.*, projects.name'))
            ->leftjoin('projects', 'notes.project_id', 'projects.id')
                            ->get();

        $data = [
            'notes' => $notes,
        ];

        return view('note.index', ['data' => $data]);
    }

    public function createIndex(){
        $categories = Category::all();

        return view('note.create',['categories' => $categories]);
    }

    public function create(Request $request){
        if($request->file()) {
            /*$request->validate([
                'image' => 'mimes:jpg,jpeg,png,jfif|max:2048',
            ]);*/

            $note = new Note();
            //$note->note = $request->note;
            //$note->brand = $request->brand;
            $note->description = $request->description;
            //$note->stock = $request->stock;
            //$note->price = $request->price;
            //$note->image = '';
            $note->project_id = $request->project_id;
            //$note->seller_id = Auth::user()->seller->id;
            $note->save();

            //$file_name = $note->id.'.'.$request->file('image')->extension();
            //$file_path = $request->file('image')->storeAs('img/notes', $file_name, 'public');

            //$note->image = "/storage/".$file_path;
            $note->save();

            return $note;
        }
    }

    public function update(Request $request){
        $note = Note::find($request->id);
        $note->note = $request->note;
        //$note->brand = $request->brand;
        //$note->description = $request->description;
        //$note->stock = $request->stock;
        //$note->price = $request->price;

        if($request->file()) {
            $request->validate([
                'image' => 'mimes:jpg,jpeg,png,jfif|max:2048',
            ]);

            $file_name = $note->id.'.'.$request->file('image')->extension();
            $file_path = $request->file('image')->storeAs('img/notes', $file_name, 'public');

            $note->image = "/storage/".$file_path;

        }
        $note->save();
        return $note;
    }

    public function destroy(Request $request){
        $requests = Note::destroy($request->note_id);
        return 'Successfully Deleted';
    }
}
