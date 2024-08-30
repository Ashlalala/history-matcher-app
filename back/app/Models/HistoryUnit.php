<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\History;

class HistoryUnit extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function history()
    {
        return $this->belongsTo(History::class);//, 'foreign_key', 'other_key');
    }
}
