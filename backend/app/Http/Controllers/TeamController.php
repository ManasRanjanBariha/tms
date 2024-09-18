<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Validator;

class TeamController extends Controller
{
    //
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "description" => "required|string|max:255"
        ]);
        // dd($request->name);
        $team = Team::create([
            'name' => $request->name,
            'description' => $request->description,
            'project_manager_id' => auth()->id()
        ]);

        return response()->json([
            'message' => 'Team created successfully',
            'team' => $team,
        ], 201);
    }

    public function show($id)
    {
        // Find the team by ID
        $team = Team::find($id);

        // Check if the team exists
        if (!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        // Return the team details along with its users
        return response()->json([
            'team' => $team,
            'users' => $team->users // Assuming 'users' relationship is defined
        ], 200);
    }

    public function update(Request $request, $id)
    {
        // Find the team by ID, if not found return a 404 response
        $team = Team::find($id);

        if (!$team) {
            return response()->json([
                'message' => 'Team not found',
            ], 404);
        }

        // Check if the authenticated user is the project manager of the team
        if ($team->project_manager_id != auth()->id()) {
            return response()->json([
                'message' => 'You are not authorized to update this team',
            ], 403);
        }

        // Update the team details directly
        if ($request->name) {
            $team->name = $request->name;
        }
        if ($request->description) {
            $team->description = $request->description;
        }
        $team->save();

        // Return a success response with the updated team
        return response()->json([
            'message' => 'Team updated successfully',
            'team' => $team,
        ], 200);
    }

    public function destroy($id)
    {
        $team = Team::find($id);

        if (!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        if ($team->project_manager_id != auth()->id()) {
            return response()->json([
                'message' => 'You are not authorized to update this team',
            ], 403);
        }
        $team->delete();

        return response()->json(['message' => 'Team deleted successfully'], 200);
    }

    public function addUser($team_id, $user_id)
    {
        $team = Team::find($team_id);
        $user = User::find($user_id);

        if (!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Assuming there's a relationship defined between Team and User models
        $team->users()->attach($user_id);

        return response()->json(['message' => 'User added to team successfully'], 200);
    }

    public function removeUser($team_id, $user_id)
    {
        $team = Team::find($team_id);
        $user = User::find($user_id);

        if (!$team) {
            return response()->json(['message' => 'Team not found'], 404);
        }

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $team->users()->detach($user_id);

        return response()->json(['message' => 'User removed from team successfully'], 200);
    }

}
