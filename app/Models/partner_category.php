<?php

namespace App\Models;

use App\Models\Partnership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class partner_category extends Model
{
    use HasFactory;
    protected $table = "partner_category";
    protected $fillable = [
        "partcategory_name",
        "partscategory_description",

    ];
// reltion
    public function partnerships()
    {
        return $this->hasMany(Partnership::class, "partcat_id");
    }

}