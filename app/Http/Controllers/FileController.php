<?php

namespace App\Http\Controllers;

use App\Http\Resources\FileCollection;
use App\Http\Resources\FileResource;
use App\Models\File;
use App\Services\FileRetrieveService;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class FileController
{
    public function index(Request $request, FileRetrieveService $service) : FileCollection
    {
        $files = $service->authUserFiles();
        return new FileCollection($files);
    }

    public function upload(Request $request, FileUploadService $upload) : FileCollection
    {
        $files = $request->file('files');

        $savedFiles = $upload($files);

        return new FileCollection($savedFiles);
    }
}
