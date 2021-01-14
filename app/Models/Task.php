<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'task_title', 'description', 'is_completed'
    ];

    public function getTasks($userId)
    {
    	return $this->where('user_id', $userId)->get();
    }

    public function getTasksForCharts($userId)
    {
    	$completed = $this->where('user_id',$userId)->where('is_completed', true)->get();
    	$incompleted = $this->where('user_id',$userId)->where('is_completed', false)->get();
    	$completed_count = count($completed);
    	$uncompleted_count = count($incompleted);

    	return view('pie-chart',compact('completed', 'incompleted', 'completed_count', 'uncompleted_count')); 
    }

    public function saveTask($request, $userId)
    {
    	$this->user_id = $userId;
    	$this->task_title = $request->get('task_title');
    	$this->description = $request->get('task_description');

    	return $this->save();
    }

    public function editTask($request, $userId)
    {
    	return $this->where('id', $request->get('id'))->where('user_id', $userId)->update(['task_title' => $request->get('task_title'), 'description' => $request->get('task_description')]);
    }

    public function deleteTask($id, $userId)
    {
    	return $this->where('id', $id)->where('user_id', $userId)->delete();
    }

    public function completeTask($id, $userId)
    {
    	return $this->where('id', $id)->where('user_id', $userId)->update(['is_completed' => true]);
    }

    public function getById($id, $userId)
    {
    	return $this->where('id', $id)->where('user_id', $userId)->first();
    }
}
