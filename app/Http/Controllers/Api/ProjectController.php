<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type')->where('user_id', '=', 1)->paginate(12);
        return response()->json([
            'response' => true,
            'data' => $projects
        ]);
    }

    public function show($slug) {
        $project = Project::with('type', 'user', 'technologies')->where('slug', $slug)->first();
        if ($project) {
            return response()->json([
                'response' => true,
                'data' => $project
            ]);
        } else {
            return response()->json([
                'response' => false,
                'message' => 'nessun progetto trovato per questo slug'
            ]);
        }
    }
}
