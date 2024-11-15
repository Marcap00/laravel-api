<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // All Projects
        $projects = Project::all();

        // All IDs Technologies
        $technologies = Technology::all()->pluck('id');

        /* $projects[0]->technologies()->sync([6]);
        $projects[1]->technologies()->sync([6]);
        $projects[2]->technologies()->sync([6]);
        $projects[3]->technologies()->sync([5]);
        $projects[4]->technologies()->sync([5]);
        $projects[5]->technologies()->sync([5]);
        $projects[6]->technologies()->sync([5]);
        $projects[7]->technologies()->sync([5]);
        $projects[8]->technologies()->sync([4]);
        $projects[9]->technologies()->sync([4]);
        $projects[10]->technologies()->sync([1]);
        $projects[11]->technologies()->sync([1]);
        $projects[12]->technologies()->sync([3]); */

        foreach ($projects as $project) {
            $formattedName = str_ireplace('-', ' ', $project->title);
            if (Str::contains($formattedName, 'laravel')) {
                $project->technologies()->sync([6]);
            } elseif (Str::contains($formattedName, ['vite', 'vue'])) {
                $project->technologies()->sync([5]);
            } elseif (Str::contains($formattedName, 'html') && Str::contains($formattedName, 'css')) {
                $project->technologies()->sync([1, 2]);
            } elseif (Str::contains($formattedName, 'html')) {
                $project->technologies()->sync([1]);
            } elseif (Str::contains($formattedName, 'css')) {
                $project->technologies()->sync([2]);
            } elseif (Str::contains($formattedName, ['js', 'javascript'])) {
                $project->technologies()->sync([3]);
            } elseif (Str::contains($formattedName, 'php')) {
                $project->technologies()->sync([4]);
            } elseif (Str::contains($formattedName, ['db', 'database', 'sql'])) {
                $project->technologies()->sync([7]);
            }
        }
    }
}