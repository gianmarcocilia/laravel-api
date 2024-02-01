<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('user_id', '=', Auth::user()->id)->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->validated();

        $project = new Project();

        $project->fill($form_data);
        if ($request->hasFile('project_image')) {
            $path = Storage::put('project_images', $request->project_image);
            $project->project_image = $path;
        }
        $project->user_id = Auth::id();
        $project->save();

        if($request->has('technologies')) {
            $project->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->checkUser($project);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->checkUser($project);
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $this->checkUser($project);

        $form_data = $request->validated();

        if ($request->hasFile('project_image')) {
            if ($project->project_image) {
                Storage::delete($project->project_image);
            }

            $path = Storage::put('project_images', $request->project_image);
            $form_data['project_image'] = $path;
        }

        $project->update($form_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($form_data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }
        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->checkUser($project);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'Il progetto ' . $project->title . ' è stato eliminato.');
    }

    public function deleted()
    {
        $projects = Project::onlyTrashed()->get();
        return view('admin.projects.deleted', compact('projects'));
    }

    public function restore($id)
    {
        $project = Project::withTrashed()->find($id);
        $project->restore();
        return redirect()->route('admin.projects.deleted');
    }

    private function checkUser(Project $project) {
        if($project->user_id !== Auth::user()->id) {
            abort(404);
        } 
    }
}
