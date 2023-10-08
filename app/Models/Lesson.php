<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description','content','type','section_id'];

    #### Relation ###
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}