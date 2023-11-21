<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\ImageStore;
use App\Traits\SendMail;
use App\Traits\SendSMS;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Coupons\Entities\Coupon;
use Modules\CourseSetting\Entities\Category;
use Modules\CourseSetting\Entities\Course;
use Modules\OrgInstructorPolicy\Entities\OrgPolicyCategory;

class CourseController extends Controller
{
    use ImageStore, SendSMS, SendMail;


    public function ajaxGetSubCategoryList(Request $request)
    {
        $subcategories = Category::where('parent_id', '=', $request->id)->get();
        return response()->json([$subcategories]);
    }


    public function ajaxGetCourseList(Request $request)
    {
        $category_id = $request->category_id;
        $subcategory_id = $request->subcategory_id;
        if (Auth::user()->role_id == 1) {
            $subcategories = Course::select('id', 'title')->where('category_id', $category_id)->where('subcategory_id', $subcategory_id)->get();
        } else {
            $query = Course::select('id', 'title')->where('category_id', $category_id)->where('subcategory_id', $subcategory_id);
            if (isModuleActive('Organization') && Auth::user()->isOrganization()) {
                $query->whereHas('user', function ($q) {
                    $q->where('organization_id', Auth::id());
                    $q->orWhere('id', Auth::id());
                });
            }
            $subcategories = $query->get();
        }

        return response()->json([$subcategories]);
    }


    public function category(Request $request, $category_name=null)
    {
        $selected_category_name = $category_name ? ucfirst(str_replace('-', ' ', $category_name)) : null;

        try {
            $query = Category::query();
            if($category_name){
                $selected_category = Category::where("name->en", $selected_category_name)->whereNull('parent_id')->firstOrFail();
                $query = $query->where('parent_id', $selected_category->id);
            }
            
            if (isModuleActive('OrgInstructorPolicy') && \auth()->user()->role_id != 1) {
                $assign = OrgPolicyCategory::where('policy_id', \auth()->user()->policy_id)->pluck('category_id')->toArray();
                $query->whereIn('id', $assign);
            }
            $categories = $query->whereNotNull('parent_id')->with('parent')->orderBy('position_order', 'asc')->get();
            $max_id = count($categories) + 1;

            $categories_box = Category::whereNull('parent_id')->get();

            return view('backend.categories.index', compact('categories', 'category_name', 'categories_box', 'max_id'));
        } catch (\Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }

    public function category_delete($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            Category::find($id)->delete();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }

    public function category_edit($id, $category_name=null)
    {
        $selected_category_name = $category_name ? ucfirst(str_replace('-', ' ', $category_name)) : null;

        try {
            $edit = Category::find($id);
            $query = Category::orderBy('position_order', 'ASC');
            if($category_name){
                $selected_category = Category::where("name->en", $selected_category_name)->whereNull('parent_id')->firstOrFail();
                $query = $query->where('parent_id', $selected_category->id);
            }

            if (isModuleActive('OrgInstructorPolicy')) {
                $user = Auth::user();
                if ($user->role_id == 2) {
                    $assign = OrgPolicyCategory::where('policy_id', \auth()->user()->policy_id)->pluck('category_id')->toArray();
                    $query->whereIn('id', $assign);
                }
            }
            $categories = $query->whereNotNull('parent_id')->with('parent')->orderBy('position_order', 'asc')->get();

            $max_id = count($categories) + 1;

            $categories_box = Category::whereNull('parent_id')->get();
            return view('backend.categories.index', compact('categories', 'category_name', 'categories_box', 'edit', 'max_id'));
        } catch (\Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }

    public function category_store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        $code = auth()->user()->language_code;

        $rules = [
            'name.' . $code => 'required|max:255',
            'photo' => 'mimes:jpeg,jpg,png,gif,svg|max:10000',
            'thumbnail' => 'mimes:jpeg,jpg,png,gif,svg|max:10000'
        ];

        $this->validate($request, $rules, validationMessage($rules));


        try {
            $url1 = $this->saveImage($request->photo);
            $url1 = !empty($url1) ? $url1 : 'public/demo/category/image/5.png';

            $url2 = $this->saveImage($request->thumbnail);
            $url2 = !empty($url2) ? $url2 : 'public/demo/category/thumb/1.png';

            DB::beginTransaction();

            $check_position = Category::where('position_order', $request->position_order)->first();

            if ($check_position != '') {
                $old_categories = Category::where('position_order', '>=', $request->position_order)->get();

                foreach ($old_categories as $old_category) {
                    $old_category->position_order = $old_category->position_order + 1;
                    $old_category->save();
                }
            }


            $store = new Category;

            foreach ($request->name as $key => $name) {
                $store->setTranslation('name', $key, $name);
            }
            foreach ($request->description as $key => $description) {
                $store->setTranslation('description', $key, $description);
            }
            $store->status = $request->status;
            if (!empty($request->parent)) {
                $store->parent_id = $request->parent;
            } else {
                $store->parent_id = null;
            }
            $store->position_order = $request->position_order;
            if (@$url1) {
                $store->image = $url1;
            }
            if (@$url2) {
                $store->thumbnail = $url2;
            }
            $store->save();


            if (isModuleActive('OrgInstructorPolicy')) {
                if (!empty(auth()->user()->policy_id)) {
                    OrgPolicyCategory::create([
                        'category_id' => $store->id,
                        'policy_id' => \auth()->user()->policy_id,
                        'status' => 1
                    ]);
                }

            }
            DB::commit();
            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }

    public function category_status_update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        try {
            $store = Category::find($request->id);
            $store->status = $request->status;
            $store->save();
            return response()->json([
                'message' => 'success'
            ], 200);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    public function category_update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $code = auth()->user()->language_code;

        $rules = [
            'name.' . $code => 'required|max:255',
        ];
        $this->validate($request, $rules, validationMessage($rules));


        $is_exist = Category::where('name', $request->name)->where('id', '!=', $request->id)->first();
        if ($is_exist) {
            Toastr::error('This name has been already taken', 'Failed');
            return redirect()->back();
        }


        try {

            $check_position = Category::where('position_order', $request->position_order)->first();

            if ($check_position != '') {
                $old_categories = Category::where('position_order', '>=', $request->position_order)->get();

                foreach ($old_categories as $old_category) {
                    $old_category->position_order = $old_category->position_order + 1;
                    $old_category->save();
                }
            }

            $store = Category::find($request->id);
            foreach ($request->name as $key => $name) {
                $store->setTranslation('name', $key, $name);
            }
            foreach ($request->description as $key => $description) {
                $store->setTranslation('description', $key, $description);
            }
            $store->status = $request->status;
            $store->url = $request->url;
            $store->title = $request->title;
            $store->show_home = (int)$request->show_home;
            $store->position_order = $request->position_order;
            if ($request->photo) {
                $store->image = $this->saveImage($request->photo);
            }
            if ($request->thumbnail) {
                $store->thumbnail = $this->saveImage($request->thumbnail);
            }


            if (!empty($request->parent)) {
                $store->parent_id = $request->parent;
            } else {
                $store->parent_id = null;
            }
            $results = $store->save();
            if ($results) {
                Toastr::success(trans('common.Operation successful'), trans('common.Success'));
                return redirect()->route('course.category');
            } else {
                Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
                return redirect()->back();
            }

        } catch (\Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }


    public function coupon(Request $request)
    {
        try {
            $coupons = Coupon::all();
            return view('backend.courses.coupons', compact('coupons'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Operation failed'), trans('common.Failed'));
            return redirect()->back();
        }
    }

    public function ajaxCategory(Request $request)
    {
        try {
            $query = Category::with('parent')->orderBy('position_order');
            if ($request->search) {
                $query->whereLike('name', $request->search);
            }
            $categories = $query->paginate(10);

            $response = [];
            foreach ($categories as $category) {
                $level_gap = '';
                for ($level = 0; $level < $this->getCategoryLevel($category); $level++) {
                    $level_gap .= '-';
                }

                if ($request->column) {
                    $col1 = $request->column[0];
                    $col2 = $request->column[1];
                    $id = $category->$col1;
                    $title = $category->$col2;
                } else {
                    $id = $category->id;
                    $title = $category->name;
                }
                $response[] = [
                    'id' => $id,
                    'text' => $level_gap . $title
                ];

            }


            $data['results'] = $response;
            if (count($response) == 0) {
                $data['pagination'] = ["more" => false];
            } else {
                $data['pagination'] = ["more" => true];
            }
            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json("", 404);
        }
    }

    public function getCategoryLevel($category, $level = 0)
    {
        if (!empty($category->parent->id)) {
            return $this->getCategoryLevel($category->parent, ++$level);
        }
        return $level;
    }

}

