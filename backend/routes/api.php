<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;

// use App\Http\Controllers\TeamController;
// use App\Http\Controllers\ProjectController;
// use App\Http\Controllers\TaskController;
// use App\Http\Controllers\TaskRequestController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/test', function () {
//     return response()->json(['message' => 'API is working!']);
// });




// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/users/{id}', [AuthController::class, 'show']);
    Route::put('/users/{id}', [AuthController::class, 'update']);
    Route::get('/teams/{id}', [TeamController::class, 'show']);
    // Route::delete('/users/{id}', [AuthController::class, 'destroy']);
});
Route::middleware(['auth:sanctum', 'role:Project Manager'])->group(function () {
    Route::post('/teams', [TeamController::class, 'store']);
    Route::put('/teams/{id}', [TeamController::class, 'update']);
    Route::delete('/teams/{id}', [TeamController::class, 'destroy']);
    Route::post('/teams/{team_id}/users/{user_id}', [TeamController::class, 'addUser']);
    Route::delete('/teams/{team_id}/users/{user_id}', [TeamController::class, 'removeUser']);
});


// // Team Routes
// Route::post('/teams', [TeamController::class, 'store']);
// Route::get('/teams/{id}', [TeamController::class, 'show']);
// Route::put('/teams/{id}', [TeamController::class, 'update']);
// Route::delete('/teams/{id}', [TeamController::class, 'destroy']);
// Route::post('/teams/{team_id}/users/{user_id}', [TeamController::class, 'addUser']);
// Route::delete('/teams/{team_id}/users/{user_id}', [TeamController::class, 'removeUser']);

// // Project Routes
// Route::post('/projects', [ProjectController::class, 'store']);
// Route::get('/projects/{id}', [ProjectController::class, 'show']);
// Route::put('/projects/{id}', [ProjectController::class, 'update']);
// Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);
// Route::post('/projects/{project_id}/team/{team_id}', [ProjectController::class, 'assignToTeam']);

// // Task Routes
// Route::post('/tasks', [TaskController::class, 'store']);
// Route::get('/tasks/{id}', [TaskController::class, 'show']);
// Route::put('/tasks/{id}', [TaskController::class, 'update']);
// Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
// Route::post('/tasks/{task_id}/assign/{user_id}', [TaskController::class, 'assign']);
// Route::post('/tasks/{task_id}/request', [TaskRequestController::class, 'requestTask']);

// // Task Request Routes
// Route::get('/users/{id}/task-requests', [TaskRequestController::class, 'getUserTaskRequests']);
// Route::get('/tasks/{task_id}/task-requests', [TaskRequestController::class, 'getTaskRequests']);
// Route::post('/tasks/{task_id}/request/{request_id}/approve', [TaskRequestController::class, 'approveRequest']);
// Route::post('/tasks/{task_id}/request/{request_id}/reject', [TaskRequestController::class, 'rejectRequest']);
