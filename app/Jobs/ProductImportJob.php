<?php

namespace App\Jobs;

use App\Enums\FileStatusEnum;
use App\Models\File;
use App\Services\ProductsImportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public File $file)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() : void
    {
        $file = $this->file;
        \Excel::import(new ProductsImportService($file), $file->store_location)->chain([
            'importFinished' => function() use ($file){
                FileStatusChangeJob::dispatchSync($file, FileStatusEnum::COMPLETED);
            },
            'cleanFiles' => function() {
                CleanFilesDirectoryJob::dispatch();
            },
        ]);
    }
}
