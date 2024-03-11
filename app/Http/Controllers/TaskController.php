<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 未完了のタスクのみ表示
        $tasks = Task::where('status', false)->get();
        return view ('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーションルール
        $rules = [
            'task_name' => 'required|max:100',
        ];
        $messages = [
            'required' => '*Please input your task', 'max' => '*Please input under 100text'
        ];
        
        Validator::make($request->all(),$rules,$messages)->validate();

        // インスタンス生成
        $task = new Task;
        // モデル名->カラム名=値でデータを割り当て
        $task -> name = $request->input('task_name');
        // データベースに保存
        $task -> save();
        // リダイレクト
        return redirect ('/tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 編集ボタン押下時
        if($request->status === null) {
                $rules = [
                    'task_name' => 'required|max:100',
                ];
                $messages = [
                    'required' => '必須項目です', 'max' => '100文字以下にしてください'
                ];

                Validator::make($request->all(),$rules,$messages)->validate();

                // 該当タスクを検索
                $task = Task::find($id);

                // モデル名->カラム名=値でデータを割り当てる
                $task->name = $request->input('task_name');

                // データベースに保存
                $task->save();
            }else{
                // 完了ボタン押下時
                $task = Task::find($id);
                // モデル->カラム名=値でデータを割り当て
                $task ->status = true; 
                // true:完了、false:未完了

                // データベースに保存
                $task->save();
            }
            // リダイレクト
            return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 該当タスクを検索
        Task::find($id)->delete();
        return redirect('/tasks');
    }
}
