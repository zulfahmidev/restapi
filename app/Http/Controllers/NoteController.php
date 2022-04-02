<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function index() {
        $notes = Note::all();
        return response()->json([
            "status" => 200,
            "message" => "Success",
            "body" => $notes
        ]);
    }

    public function store(Request $request) {
        Validator::make($request->all(), [
            "title" => "required",
            "content" => "required",
        ]);
        $note = new Note();
        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();

        return response()->json([
            "status" => 200,
            "message" => "Success",
            "body" => $note
        ]);
    }

    public function update(Request $request, $id) {
        Validator::make($request->all(), [
            "title" => "required",
            "content" => "required",
        ]);
        $note = Note::find($id);

        if ($note) {
            $note->title = $request->title;
            $note->content = $request->content;
            $note->save();
            return response()->json([
                "status" => 200,
                "message" => "Success",
                "body" => $note
            ]);
        }

        return response()->json([
            "status" => 404,
            "message" => "Data Note Found",
            "body" => null
        ]);
    }
    public function destroy($id) {
        $note = Note::find($id);

        if ($note) {
            $temp = $note;
            $note->delete();
            return response()->json([
                "status" => 200,
                "message" => "Success",
                "body" => $temp
            ]);
        }

        return response()->json([
            "status" => 404,
            "message" => "Data Note Found",
            "body" => null
        ]);
    }
    
}
