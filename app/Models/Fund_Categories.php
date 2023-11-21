<?php

namespace App\Models;
use App\Models\Funding_Agency;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund_Categories extends Model
{
    use HasFactory;
        protected $table="fund_categories";
    protected $fillable = [
        "fund_categories_name",
    ] ;

    // relation

    public function fundingAgencies()
    {
        return $this->hasMany(Funding_Agency::class, 'fund_categories_id');
    }
}
