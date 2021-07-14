<?php

namespace App\Http\Controllers;
use App\Models\ToDo;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
	public function todolist() {
		return response()->json(ToDo::all(), 201);
	}

	public function create(Request $request){
		$todo = ToDo::create($request->all());
		return response()->json($todo, 201);
	}
}