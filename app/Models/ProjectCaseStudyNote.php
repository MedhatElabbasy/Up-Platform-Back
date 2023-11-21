<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCaseStudyNote extends Model
{
    use HasFactory;

    protected $fillable = [
        "project_id",
        "main_partnerships",
        "main_activities",
        "added_value",
        "customer_relations",
        "customer_category",
        "main_sub_activities",
        "marketing_channels",
        "project_revenue",
        "project_costs",
    ];
}
