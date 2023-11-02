<?php

namespace Modules\BundleSubscription\Entities;

use App\Traits\Tenantable;
use App\User;
use Illuminate\Database\Eloquent\Model;

class BundleReveiw extends Model
{
    use Tenantable;

    protected $guarded = ['id'];

    protected $with = ['user'];

    public function plan()
    {
        return $this->belongsTo(BundleCoursePlan::class, 'bundle_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

}
