<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiendanMessage extends Model
{
    use HasFactory;

    protected $table = 'diendan_messages';

    protected $fillable = [
        'diendan_id',
        'student_name',
        'content',
    ];

    public function diendan()
    {
        return $this->belongsTo(Diendan::class, 'diendan_id');
    }

    // Define the belongsTo relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
