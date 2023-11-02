<?php

namespace Modules\BundleSubscription\Entities;

use App\Traits\Tenantable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BundleSetting extends Model
{
    use Tenantable;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            Cache::forget('BundleSetting' . SaasDomain());

        });
        self::updated(function ($model) {
            Cache::forget('BundleSetting' . SaasDomain());

        });
        self::deleted(function ($model) {
            Cache::forget('BundleSetting' . SaasDomain());
        });
    }

    public static function getData()
    {
        return Cache::rememberForever('BundleSetting' . SaasDomain(), function () {
            $setting = DB::table('bundle_settings')->where('lms_id', SaasInstitute()->id)->first();
            if (!$setting) {
                $setting = DB::table('bundle_settings')->first();
            }
            return $setting;
        });
    }
}
