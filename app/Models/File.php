<?php

namespace App\Models;

use App\Enums\FileStatusEnum;
use App\Events\FileChangedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class File extends Model
{
    use HasFactory;

    protected $guarded = [ 'user_id' ];
    protected $casts = [
        'status' => FileStatusEnum::class,
    ];

    protected $hidden = ["name", "store_location"];

    protected $dispatchesEvents = [
        'updated' => FileChangedEvent::class,
    ];



    protected static function booted() : void
    {
        static::creating(function ($file) {
            $file->user_id = Auth::user()->id;
        });
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
