<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Product;
use App\Plan;
use App\ProfileImage;
use App\Events\ProjectCreated;


class UserProfileController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $user = auth()->user();

      $products = Product::all();

      $plans = Plan::all();

      $profileImage = $user->profileImages()->latest()->first();

      return view('user.profile', compact('user', 'products', 'plans', 'profileImage'));
    }
    // //
    // // public function create()
    // // {
    // //   $projects = Project::all();
    // //
    // //   return view('projects.create');
    // // }
    //
    // public function store()
    // {
    //
    //   $attributes = $this->validateProject();
    //
    //   $attributes['owner_id'] = auth()->id();
    //
    //   $project = Project::create($attributes);
    //
    //   return redirect('/projects');
    // }
    //
    // public function show(Project $project)
    // {
    //   $this->authorize('update', $project);
    //
    //   return view('projects.show', compact('project'));
    // }
    //
    // public function edit(Project $project)
    // {
    //
    //   return view('projects.edit', compact('project'));
    // }
    //
    // public function update(Project $project)
    // {
    //
    //   $this->authorize('update', $project);
    //
    //   $project->update($this->validateProject());
    //
    //   return redirect('/projects');
    // }
    //
    // public function destroy(Project $project)
    // {
    //   $this->authorize('update', $project);
    //
    //   $project->delete();
    //
    //   return redirect('/projects');
    // }
    //
    // protected function validateProject()
    // {
    //   return request()->validate([
    //     'title' => ['required', 'min:3'],
    //     'description' => ['required', 'min:3']
    //   ]);
    // }
}
