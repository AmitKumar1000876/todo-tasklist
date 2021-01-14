<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\AddTaskRequest;
use Auth;

class TaskController extends Controller
{
	protected $taskModel;

	public function __construct()
	{
		$this->taskModel = new Task;
	}
  	
  	/**
  	 * Save Task in DB
  	 */
    public function storeTask(AddTaskRequest $request)
    {
    	$userId = Auth::user()->id;
        $task = $this->taskModel->saveTask($request, $userId);
        if($task) {
            return response()->json(['status' => 'success', 'message' => 'Task created successfully']);
        }else {
            return response()->json(['status' => 'failed', 'message' => 'Failed to create task']);
        }   
    }

    public function editTask(Request $request)
    {
    	$userId = Auth::user()->id;
        $task = $this->taskModel->editTask($request, $userId);
        if($task) {
            return response()->json(['status' => 'success', 'message' => 'Task updated successfully']);
        }else {
            return response()->json(['status' => 'failed', 'message' => 'Failed to update task']);
        }   
    }


    public function deleteTask(Request $request)
    {
    	$userId = Auth::user()->id;
    	$id = $request->get('id');
        $isDeleted = $this->taskModel->deleteTask($id, $userId);
        if($isDeleted) {
            return response()->json(['status' => 'success', 'message' => 'Task Deleted successfully']);
        }else {
            return response()->json(['status' => 'failed', 'message' => 'Failed to delete task']);
        }   
    }

    public function completeTask(Request $request)
    {
    	$userId = Auth::user()->id;
    	$id = $request->get('id');
        $isCompleted = $this->taskModel->completeTask($id, $userId);
        if($isCompleted) {
            return response()->json(['status' => 'success', 'message' => 'Task Completed successfully']);
        }else {
            return response()->json(['status' => 'failed', 'message' => 'Failed to complete task']);
        }   
    }

    public function getChart()
    {
    	$userId = Auth::user()->id;
    	return $this->taskModel->getTasksForCharts($userId);
    }

    public function loadEditModel(Request $request, $id)
    {
    	$userId = Auth::user()->id;
    	$task = $this->taskModel->getById($id, $userId);

    	return view('modals.edit-task', compact('task'));
    }
}
