<?php

namespace App\Http\Controllers;

use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FileController
{
    public function upload(Request $request, FileUploadService $upload) : Response
    {
        $files = $request->file('files');

        $savedFiles = $upload($files);

        return response()->json($savedFiles);
    }
}
