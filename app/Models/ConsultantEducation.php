<?php

namespace App\Models;

use App\Models\User;
use App\Models\ConsultantPackageDetail;
use Illuminate\Database\Eloquent\Model;

class ConsultantEducation extends Model
{
    protected $table = 'consultant_education';

    protected $fillable = [
        'user_id',
        'degree',
        'institution',
        'start_date',
        'end_date',
    ];

    protected $dates = ['start_date', 'end_date'];
  //// relation
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function packageDetail()
    {
        return $this->hasOne(ConsultantPackageDetail::class, 'user_id');
    }


}
