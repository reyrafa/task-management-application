<?php

namespace App\Models;

use App\TaskPriority;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $casts = [
        'priority' => TaskPriority::class,
    ];
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'priority',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Tasks::class);
    }
}
