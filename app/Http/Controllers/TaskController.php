<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function __construct(private TaskService $tasksService){}

    public function index(){

        $tasksWithCategories =  $this->tasksService->all();
        return view('task.index' , compact('tasksWithCategories'));
    }

    public function create(){
        $categories = $this->tasksService->create();
        return view('task.create' , compact('categories'));
    }

    public function store(StoreTaskRequest $request){

        try {
            $this->tasksService->store($request);

            return redirect()->route('task.index')->with('status', 'success');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id){

        $taskWithCategories =  $this->tasksService->edit($id);
        return view('task.edit' , compact('taskWithCategories'));
    }

    public function update($id , UpdateTaskRequest $request){

        try {
            $this->tasksService->update($id, $request);

            return redirect()->route('task.index')->with('status', 'success');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function trash(){

        if (\request('tasks')) {
            $this->tasksService->trash();
            return redirect()->route('task.index')->with('status', 'success');
        }

        return redirect()->route('task.index')->with('status', 'error');
    }

    public function trashed(){

        $trashedWithCategories =  $this->tasksService->trashed();
        return view('task.trashed' , compact('trashedWithCategories'));
    }

    public function deleteTrashed(){
        if (\request('tasks')) {
            $this->tasksService->deleteTrashed();
            return redirect()->route('task.trashed')->with('status', 'success');
        }

        return redirect()->route('task.trashed')->with('status', 'error');
    }

    public function deleteAllTrashed(){

        $this->tasksService->deleteAllTrashed();
        return redirect()->route('task.trashed')->with('status', 'success');
    }

    public function undoTrash($id){

        $this->tasksService->undoTrash($id);
        return redirect()->route('task.index')->with('status', 'success');
    }

    /**
     * Extra methods
     */

     public function markAsCompleted($id){

        $this->tasksService->markAsCompleted($id);
        return redirect()->route('task.index')->with('status', 'success');
     }

     public function filter(Request $request){
        if ($request->ajax()) {
            $tasks = $this->tasksService->filter($request);
            return view('render.tasks' , compact('tasks'))->render();
        }
     }
}
