<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'agendas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'date',
        'created_by',
        'notes',
        'file_path',
        'status',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function concerns()
    {
        return $this->hasMany(Concern::class, 'agenda_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'agenda_id');
    }
}