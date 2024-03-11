<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\TodoList;

class TodoListController extends Controller
{
    public function index(Request $request)
    {
        $todolists = TodoList::all();

        return view('todo_list.index', ['todolists' => $todolists]);
    }
}
