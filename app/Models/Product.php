<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'id',
    //     'title',
    //     'description',
    //     'style',
    //     'sanmar_mainframe_color',
    //     'size',
    //     'color_name',
    //     'piece_price',
    // ];
    protected $guarded = [];

    public function modifier() : BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}
