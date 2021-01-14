<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Auth;

class DashBoardController extends Controller
{
	protected  $taskModel;

	public function __construct()
	{
		$this->taskModel = new Task;
	}

    public function index()
    {
    	$userId = Auth::user()->id;

    	$tasks = $this->taskModel->getTasks($userId);

        return view('dashboard', compact('tasks'));
    }
}
