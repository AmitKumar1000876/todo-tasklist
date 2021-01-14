<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <button style="float: right;" type="button" class="btn btn-primary" data-toggle="modal" id="add-new-task" data-target="#add-new-task-modal" title="Add Task"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"> <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/> <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>
            </button>
            <form action="{{route('tasks.chart')}}">
                <button style="float: right; margin-right: 10px;" type="submit" class="btn btn-primary" id="view-chart" data-title="View Chart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pie-chart-fill" viewBox="0 0 16 16"> <path d="M15.985 8.5H8.207l-5.5 5.5a8 8 0 0 0 13.277-5.5zM2 13.292A8 8 0 0 1 7.5.015v7.778l-5.5 5.5zM8.5.015V7.5h7.485A8.001 8.001 0 0 0 8.5.015z"/></svg>
                </button>
            </form>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1 style="text-align: center; font-size: 30px">Task List</h1>
                <p style="text-align: center; color: grey;">Here is your Detailed Task List</p>
                <hr>
                <table class="table-fixed w-full" id="task_list">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class = "px-4 py-2 w-20">Sr. No.</th>
                            <th class = "px-4 py-2">Title</th>
                            <th class = "px-4 py-2">Description</th>
                            <th class = "px-4 py-2">Completed</th>
                            <th class = "px-4 py-2">Actions</th>
                        </tr> 
                    </thead>
                    <tbody>
                        @if($tasks->count() == 0)
                            <tr>
                                <td style="text-align: center; font-size: 25px;" colspan="5">No Tasks Found !</td>
                            </tr>
                        @else
                            @foreach($tasks as $key => $task)
                                <tr>
                                    <th class="border px-4 py-2">{{$key+1}}</th>
                                    <td class="border px-4 py-2">{{$task->task_title}}</td>
                                    <td class="border px-4 py-2" title="{{$task->description}}" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{$task->description}}</td>
                                    <td class="border px-4 py-2">
                                        @if($task->is_completed == true || $task->is_completed == 1 )
                                        <input class="rounded" type="checkbox" checked="checked" disabled="disabled">
                                        @else
                                        <input class="rounded" type="checkbox" disabled="disabled">
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">
                                        @if($task->is_completed == false || $task->is_completed == 0)
                                            <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#edit-task-modal" data-id="{{ $task->id }}" data-title="{{$task->task_title}}" data-description="{{$task->description}}" id="edit-task" title="Edit Task">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>
                                            </a>
                                        @endif
                                        <a class="btn btn-danger" href="#" role="button" data-toggle="modal" id="delete-task" data-target="#delete-task-modal" data-id="{{ $task->id }}" title="Delete Task">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16"><path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/></svg>
                                        </a>
                                        @if($task->is_completed == false || $task->is_completed == 0)
                                            <a class="btn btn-success" href="#" role="button" data-toggle="modal" id="complete-task" data-target="#complete-task-modal" data-id="{{ $task->id }}" title="Mark as Complete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16"><path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/></svg>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

