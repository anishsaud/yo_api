<?php

namespace App\Services;

use App\Enums\FileStatusEnum;
use App\Jobs\ProductImportJob;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FileUploadService
{
    public function __invoke(array $files) : array
    {
        $savedFiles = [];

        foreach ($files as $file) {
            if (! $file->isValid()) {
                continue;
            }
                
            $name = $file->hashName();
            $storeLocation = $file->storeAs('to_process', $name, 'local');
            
            $data = [
                'name' => $name,
                'original_name' => $file->getClientOriginalName(),
                'store_location' => $storeLocation,
                'status' => FileStatusEnum::PENDING,
            ];
            
            $savedFile = File::create($data);
            $this->dispatchImportJob($savedFile);
            $savedFiles[] = $savedFile;
        }

        return $savedFiles;
    }

    private function dispatchImportJob(File $file) : void
    {
        dispatch(new ProductImportJob($file));
    }
}
