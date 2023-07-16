<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "film_id",
        "comments",
        "is_active"
    ];

    public static $ruleComment = [
        "comments" => 'required|string',
        "film_id" => "required|exists:films,id|integer"

    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name');
    }
}
