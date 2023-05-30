<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    public $incrementing = true;

    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'slug', 'name'];

    public function post()
    {
        return $this->hasMany(Posts::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
