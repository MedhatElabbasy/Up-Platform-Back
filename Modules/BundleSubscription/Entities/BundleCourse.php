<?php

namespace Modules\BundleSubscription\Entities;

use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Modules\CourseSetting\Entities\Course;

class BundleCourse extends Model
{
    use Tenantable;

    protected $guarded = ['id'];

    protected $with = ['course'];


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')->withDefault();
    }

    public function plan()
    {
        return $this->belongsTo(BundleCoursePlan::class, 'plan_id')->withDefault();
    }
}
