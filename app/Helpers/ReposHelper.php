<?php


namespace App\Helpers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Http;

class ReposHelper
{
    public static function getRepos()
    {
        $username = 'Marcap00';
        $response = Http::withToken(env('GIT_HUB_ACCESS_TOKEN'))
            ->withHeader('Accept', 'application/vnd.github+json')
            ->withHeader('X-GitHub-Api-Version', '2022-11-28')
            ->withOptions(['verify' => false])
            ->get("https://api.github.com/users/$username/repos" . "?per_page=100");

        return $response->json();
    }
}
