<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\RolePermission\Entities\Permission;

class AddBundleSubscriptionPermission extends Migration
{
    public function up()
    {
        $routes = [
            ['name' => 'BundleSubscription', 'route' => 'bundle.subscription', 'type' => 1, 'parent_route' => null],
            ['name' => 'Bundle Course', 'route' => 'bundle.course', 'type' => 2, 'parent_route' => 'bundle.subscription'],
            ['name' => 'Bundle Store', 'route' => 'bundle.store', 'type' => 3, 'parent_route' => 'bundle.course'],
            ['name' => 'Bundle Edit', 'route' => 'bundle.update', 'type' => 3, 'bundle.course', 'parent_route' => 'bundle.course'],

            ['name' => 'Bundle Course List', 'route' => 'bundle.course.index', 'type' => 3, 'parent_route' => 'bundle.course'],
            ['name' => 'Bundle Course Store', 'route' => 'bundle.course.store', 'type' => 3, 'parent_route' => 'bundle.course'],
            ['name' => 'Bundle Course Delete', 'route' => 'bundle.course.delete', 'type' => 3, 'parent_route' => 'bundle.course'],

            ['name' => 'Bundle Setting', 'route' => 'bundle.setting.index', 'type' => 2, 'parent_route' => 'bundle.subscription'],


        ];
        foreach ($routes as $route) {
            Permission::updateOrCreate([
                'route' => $route['route'],
            ], [
                    'name' => $route['name'],
                    'route' => $route['route'],
                    'parent_route' => $route['parent_route'],
                    'type' => $route['type'],
                    'ecommerce' => 0,
                    'module' => 'BundleSubscription'
                ]
            );
        }
    }

    public function down()
    {
        Schema::table('', function (Blueprint $table) {

        });
    }
}
