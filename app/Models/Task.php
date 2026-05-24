<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'due_date',
        'assigned_to',
        'ai_summary',
        'ai_priority'
    ];

    protected $casts = [
        'due_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        $query
            ->when($filters['status'] ?? null, function ($q, $status) {
                $q->where('status', $status);
            })
            ->when($filters['priority'] ?? null, function ($q, $priority) {
                $q->where('priority', $priority);
            })
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%");
            });
    }
}