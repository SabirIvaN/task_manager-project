<?php

namespace App;

use App\User;
use App\Status;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'status_id', 'created_by_id', 'assigned_by_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
