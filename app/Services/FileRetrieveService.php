<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class FileRetrieveService
{
    public function authUserFiles() : Collection
    {
        $authUserId = Auth::user()->id;
        $files = QueryBuilder::for(File::class)
                        ->where('user_id', $authUserId)
                        ->allowedFilters(File::$allowedFilters)
                        ->allowedSorts(File::$allowedSorts)
                        ->get();
        return $files;
    }
}
