<?php

namespace App\Models;
use App\Models\post;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'comment',
        'commentable_type',
        'commentable_id',
        'user_id'
    ];
    public function commentable()
    {
        return $this->morphTo();
    }
    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }
}
