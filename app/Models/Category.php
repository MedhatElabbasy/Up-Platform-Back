<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name', 'description'];

    #### Relation ###
// public function question(){
//     return $this->belongsTo(Question::class);
// }
}