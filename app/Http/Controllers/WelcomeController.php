<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {

        $projects = Project::orderByDesc('creation_date')->paginate(9);
        $technologies = Technology::all();

        return view('welcome', compact('projects', 'technologies'));
    }
}
