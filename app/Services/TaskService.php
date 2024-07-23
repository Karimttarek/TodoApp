<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class TaskService{

    /**
     * @return array
     */
    public function all():array{

        $tasks = DB::table('tasks')
            ->where('user_id' , Auth::id())
            ->whereNull('tasks.deleted_at')
            ->leftJoin('categories' , 'categories.id' ,'=' ,'tasks.category_id')
            ->select('tasks.id','tasks.title','tasks.description','tasks.status','tasks.deadline', 'tasks.created_at','categories.description as category_description')
            ->orderBy('id' ,'desc')
            ->paginate();

        return [
            'tasks' => $tasks,
            'categories' => $this->getAllCategories()
        ];
    }

    /**
     * @return Collection
     */
    public function create():Collection{

        return DB::table('categories')->select('id','description')->get();
    }

    /**
     * @param $request
     * @return void
     */
    public function store($request):void{

        DB::table('tasks')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'deadline' => $request->deadline,
            'created_at' => now()
        ]);
    }

        /**
     * @param $id
     * @return array
     */
    public function edit($id):array{

        $task = DB::table('tasks')
            ->where('tasks.id' ,$id)
            ->leftJoin('categories' , 'categories.id' ,'=' ,'tasks.category_id')
            ->select('tasks.id','tasks.title', 'tasks.description', 'tasks.status', 'tasks.deadline', 'categories.id as category_id')
            ->get();

        return [
            'task' => $task,
            'categories' => $this->getAllCategories()
        ];
    }

    /**
     * @param $request
     * @return void
     */
    public function update($id, $request):void{

        DB::table('tasks')->where('id', $id)
        ->update(
            [
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => $request->status ?? 'pending',
            'deadline' => $request->deadline,
            'updated_at' => now()
            ]
        );
    }

    public function trash():void{

        foreach(\request('tasks') as $task_id){
            DB::table('tasks')->where('id' ,$task_id)
                ->update([
                    'deleted_at' => now()
                ]);
        }
    }

    public function trashed(){

        $tasks = DB::table('tasks')
            ->where('user_id' , Auth::id())
            ->whereNotNull('tasks.deleted_at')
            ->leftJoin('categories' , 'categories.id' ,'=' ,'tasks.category_id')
            ->select('tasks.id','tasks.title','tasks.description','tasks.status','tasks.deadline', 'tasks.created_at','categories.description as category_description')
            ->orderBy('id' ,'desc')
            ->paginate();

        return [
            'tasks' => $tasks,
            'categories' => $this->getAllCategories()
        ];
    }

    public function deleteTrashed():void{

        foreach(\request('tasks') as $task_id){
            DB::table('tasks')
                ->where('id' ,$task_id)
                ->whereNotNull('deleted_at')
                ->delete();
        }
    }

    public function deleteAllTrashed():void{

        DB::table('tasks')
            ->whereNotNull('deleted_at')
            ->delete();
    }

    public function undoTrash($id){

        DB::table('tasks')->where('id', $id)
            ->update(
                [
                'deleted_at' => null
                ]
            );
    }
    /**
     * Extra methods
     */

     /**
     * @param $request
     * @return void
     */
     public function markAsCompleted($id):void{

        DB::table('tasks')->where('id', $id)
        ->update(
            [
            'status' => 'completed',
            ]
        );
     }

     /**
      * @param $request
      * @return void
      */
     public function filter($request){

        $tasks = DB::table('tasks')
            ->where('user_id' , Auth::id())
            ->whereNull('tasks.deleted_at')
            ->where('tasks.title','LIKE', '%'.$request->title.'%')
            ->where('tasks.description','LIKE', '%'.$request->description.'%')
            ->where('tasks.category_id' , $request->category)
            ->where('tasks.status' , $request->status)
            ->leftJoin('categories' , 'categories.id' ,'=' ,'tasks.category_id')
            ->select('tasks.id','tasks.title','tasks.description','tasks.status','tasks.deadline', 'tasks.created_at','categories.description as category_description')
            ->orderBy('id' ,'desc')
            ->paginate();
            // handle your pagination links in AJAX
            return $tasks;
     }

     private function getAllCategories(){
        return DB::table('categories')->select('id' ,'description')->get();
     }
}
