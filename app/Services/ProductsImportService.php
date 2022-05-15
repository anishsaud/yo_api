<?php

namespace App\Services;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Illuminate\Contracts\Queue\ShouldQueue;
use \ForceUTF8\Encoding;

class ProductsImportService implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow, WithUpserts, ShouldQueue
{
    public function __construct(public $file)
    {
        
    }
    public function model(array $row)
    {
        return new Product([
            'id' => Encoding::fixUTF8($row["unique_key"]),
            'title' => Encoding::fixUTF8($row["product_title"]),
            'description' => Encoding::fixUTF8($row["product_description"]),
            'style' => Encoding::fixUTF8($row["style"]),
            'sanmar_mainframe_color' => Encoding::fixUTF8($row["sanmar_mainframe_color"]),
            'size' => Encoding::fixUTF8($row["size"]),
            'color_name' => Encoding::fixUTF8($row["color_name"]),
            'piece_price' => Encoding::fixUTF8($row["piece_price"]),
            'processed_by' => $this->file->user_id,
        ]);
    }
    
    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return ['id'];
    }
}
