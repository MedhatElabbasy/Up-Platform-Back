<?php

namespace App\Models;
use App\Models\User;
use App\Models\partner_category;
use App\Models\Partner_Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partnership extends Model
{
    use HasFactory;
    protected $table="partnerships";
    protected $fillable = [
        "part_title",
        "part_desc",
        "part_duration",
        "part_percentage",
        "part_location",
        "part_rules",
        "part_cost",
        "user_id",
        "partcat_id",
        "category_id"

    ] ;

    /// relation
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function category()
    {
        return $this->belongsTo(partner_category::class, "category_id");
    }

    public function applications()
    {
        return $this->hasMany(Partner_Application::class, "partcat_id");
    }
}