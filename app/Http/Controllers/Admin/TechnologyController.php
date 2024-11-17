<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::paginate(10);

        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technology = new Technology();
        $projects = Project::all();

        return view('admin.technologies.create', compact('technology', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {

        $data = $request->validated();

        $technology = Technology::create($data);

        return redirect()->route('admin.technologies.show', compact('technology'))
            ->with("message", "Project $technology->name has been created successfully!")
            ->with("alert-class", "success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        $projects = Project::all();

        return view('admin.technologies.edit', compact('technology', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $data = $request->validated();

        $technology->update($data);

        return redirect()->route('admin.technologies.show', $technology)
            ->with("message", "Project $technology->name has been updated successfully!")
            ->with("alert-class", "success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index')
            ->with("message", "Project $technology->name has been deleted successfully!")
            ->with("alert-class", "success");
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(string $id, string $name)
    {
        $technology = Technology::onlyTrashed()->findorFail($id);
        $technology->restore();
        return redirect()->route('admin.technologies.bin')
            ->with("message", "Technology $name has been restored successfully!")
            ->with("alert-class", "success");
    }

    public function permanentDestroy(string $id, string $name)
    {
        $technology = Technology::onlyTrashed()->findorFail($id);
        $technology->forceDelete();

        return redirect()->route('admin.technologies.bin')
            ->with("message", "Technology $name has been permanent deleted successfully!")
            ->with("alert-class", "success");
    }

    public function bin()
    {
        $technologies = Technology::onlyTrashed()->paginate(10);

        return view('admin.technologies.bin', compact('technologies'));
    }
}
