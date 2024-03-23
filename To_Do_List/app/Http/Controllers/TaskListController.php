<?php

namespace App\Http\Controllers;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $tasks = TaskList::all();
        
      
        return response()->json($tasks, 200);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       dd("hello");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);

        $validatedData = $request->validate([
            'Titre' => 'required|string|max:255',
            'Description' => 'required|string|max:255',
        ]);
    
        
        $task = new TaskList();
    
     
        $task->Titre = $validatedData['Titre'];
        $task->Description = $validatedData['Description'];
        $task->Etat ='Incomplete';
    
       
        $task->save();
    
     
        return response()->json(['message' => 'Task created successfully', 'task' => $task]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        //dd($id);
        $task = TaskList::findOrFail($id);
        //dd($task->Etat);
       
    
        $task->Etat='Complete';
       
        $task->update();
    
     
        return response()->json(['message' => 'Task completed successfully', 'task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $task = TaskList::findOrFail($id); // Assuming TaskList is the model name
     // dd($task);
    return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Find the task list item by ID
            $task = TaskList::findOrFail($id);
    
            // Update the task list item attributes with the data received in the request
            $task->Titre = $request->input('Titre');
            $task->Description = $request->input('Description');
            $task->save();
    
            // Optionally, you can return the updated task list item as a response
            return response()->json($task);
        } catch (\Exception $e) {
            // Handle any errors that occur during the update process
            return response()->json(['error' => 'Failed to update task list item.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the task by ID
        //dd($id);
        $task = TaskList::findOrFail($id);
        
        // Delete the task
        $task->delete();
        
        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
    
}
