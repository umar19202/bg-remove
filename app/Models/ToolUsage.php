<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ToolUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tool_id',
        'tool_name',
        'ip_address',
        'user_agent',
        'original_filename',
        'file_size',
        'success',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'success' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }
}
