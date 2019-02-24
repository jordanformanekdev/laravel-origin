<?php

namespace App;

use App\Events\ProjectCreated;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
      'title',
      'description',
      'owner_id'
    ];

    protected $dispatchesEvents = [
      'created' => ProjectCreated::class
    ];

    protected static function boot()
    {
      parent::boot();

    }

    public function tasks()
    {
      return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
      $this->tasks()->create($task);
    }

    public function owner()
    {
      return $this->belongsTo(User::class);
    }
}
