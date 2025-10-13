<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concern extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'concerns';
    protected $primaryKey = 'id';

    protected $fillable = [
        'agenda_id',
        'description',
        'responsible_person_id',
        'status',
        'due_date',
        'comments',
        'file_path',
    ];

    // Relationships
    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id');
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_person_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'concern_id');
    }

    public function commentList()
    {
        return $this->hasMany(Comment::class, 'concern_id');
    }
}