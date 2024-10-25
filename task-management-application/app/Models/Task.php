<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'start_date',
        'due_date',
        'status',
        'priority',
        'note',
    ];

    /**
     * Generate uuid on a task
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }

    /**
     * Owner of a task
     * Relation of task to a user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Category where task belongs
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Notes of a Task
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Get Task by uuid or id
     * Accept 2 parameter uuid and id
     * @param mixed $uuid
     * @param mixed $id
     * @return void
     */
    public function getTask($uuid = null, $id = null)
    {
        $task = null;
        if ($uuid !== null) {
            $task = $this->where('uuid', $uuid)->first();
        } else if ($id !== null) {
            $task = $this->find($id);
        }

        return $task;
    }

}
