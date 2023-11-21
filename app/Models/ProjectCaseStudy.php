<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCaseStudy extends Model
{
    use HasFactory;

    public $table = "project_case_study";

    protected $casts = [
        "government_fees" => "array"
    ];

    protected $fillable = [
        "project_id",
        "capital_cost",
        "loan_interest_percentage",
        "salary_per_year",
        "rent_per_year",
        "purchases_cost_per_year",
        "decor_cost_per_month",
        "marketing_cost",
        "additional_costs",
        "government_fees",
    ];
}
