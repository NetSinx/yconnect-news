<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';
    
    public $incrementing = true;

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'title', 'user_id', 'image', 'slug', 'excerpt', 'category_id', 'content'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
