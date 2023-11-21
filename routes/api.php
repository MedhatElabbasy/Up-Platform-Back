<?php

use App\Http\Controllers\Api\Club\Event\ClubEventCalendar;
use App\Http\Controllers\Api\Club\Event\ClubEventController;
use App\Http\Controllers\ConsulationApiController;
use App\Http\Controllers\Api\Fund_AgencyController;
use App\Http\Controllers\Api\Fund_ApplicationController;
use App\Http\Controllers\Api\Fund_CategoryController;
use App\Http\Controllers\Api\Opportunity_ApplicationController;
use App\Http\Controllers\Api\Opportunity_CategoryController;
use App\Http\Controllers\Api\OpportunityController;
use App\Http\Controllers\Api\Partnership_ApplicationController;
use App\Http\Controllers\Api\freelance_servicesController;
use App\Http\Controllers\Api\service_applicationsController;
use App\Http\Controllers\Api\service_categoryController;
use App\Http\Controllers\Api\PartnershipController;
use App\Http\Controllers\Api\partner_categoryController;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;


Auth::routes(['verify' => true]);

Route::group(['namespace' => 'Api'], function () {

});

Route::group([
    'namespace' => 'Api',
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('social-login', 'AuthController@socialLogin')->middleware('demo');
    Route::post('signup', 'AuthController@signup')->middleware('demo');
    Route::post('send-otp', 'AuthController@sendOtp');
    Route::post('reset', 'AuthController@resetWithOtp');

    Route::post('send-phone-otp', 'AuthController@sendPhoneOtp');
    Route::post('activate-phone', 'AuthController@activateWithOtp');

    Route::get('get-lang', 'AuthController@getLang');

    //UserController
    Route::get('user/{id}', 'UserController@show');

    //CourseApiController
    Route::get('/get-all-courses', 'CourseApiController@getAllCourses');
    Route::get('/get-all-classes', 'CourseApiController@getAllClasses');
    Route::get('/get-all-quizzes', 'CourseApiController@getAllQuizzes');
    //
    Route::get('/get-all-quizzes/web-site', 'CourseApiController@getAllWebSiteExam');
    Route::get('/get-popular-courses', 'CourseApiController@getPopularCourses');
    Route::get('/get-popular-classes', 'CourseApiController@getPopularClasses');
    Route::get('/get-course-details/{id}', 'CourseApiController@getCourseDetails');
    Route::get('/get-class-details/{id}', 'CourseApiController@getClassDetails');
    Route::get('/get-quiz-details/{id}', 'CourseApiController@getQuizDetails');
    Route::get('/get-lesson-quiz-details/{id}', 'CourseApiController@getLessonQuizDetails');
    Route::get('/top-categories', 'CourseApiController@topCategories');
    Route::get('/search-course', 'CourseApiController@searchCourse');
    Route::get('/filter-course', 'CourseApiController@filterCourse');

    Route::get('/payment-gateways', 'WebsiteApiController@paymentGateways');
    Route::get('/sliders', 'WebsiteApiController@sliders');
    Route::get('categories', 'CourseApiController@categories');
    Route::get('sub-categories/{category_id}', 'CourseApiController@subCategories');
    Route::get('get-sub-categories/{category_name}', 'CourseApiController@subCategoriesByName');
    Route::get('levels', 'CourseApiController@levels');
    Route::get('languages', 'CourseApiController@languages');
    Route::get('mobile-menu', 'MobileMenuController@mobileMenus');

    Route::get('settings', 'WebsiteApiController@settings');

    // Bundle Subscription Controller
    Route::resource('bundle-subscription', 'BundleSubscriptionApiController')->only(['index', 'show']);

    Route::group([
        'middleware' => ['auth:api', 'verified'],
    ], function () {
        //with login routes

        Route::post('set-fcm-token', 'AuthController@setFcmToken');

        Route::post('set-lang', 'AuthController@setLang');

        Route::any('lesson-complete', 'WebsiteApiController@lessonComplete')->name('lesson.complete');

        Route::get('/get-bbb-start-url/{meeting_id}/{user_name}', 'WebsiteApiController@getBbbMeetingUrl');

        Route::get('/cart-list', 'WebsiteApiController@cartList');
        Route::post('/add-to-cart/{id}', 'WebsiteApiController@addToCart');
        Route::get('/remove-to-cart/{id}', 'WebsiteApiController@removeCart');
        Route::post('/apply-coupon', 'WebsiteApiController@applyCoupon');

        //AuthController
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::post('change-password', 'AuthController@changePassword');
        Route::post('account-delete', 'AuthController@accountDelete');
        Route::post('/update-profile', 'WebsiteApiController@updateProfile');
        Route::post('logout-device', 'AuthController@logOutDevice');

        /// crud club event
        Route::apiResource('club-events', ClubEventController::class);
        /////
        Route::get('/club-event/locations', [ClubEventController::class, 'showLocations']);
        Route::get('/club-event/location-events', [ClubEventController::class, 'showEventsByLocation']);
        Route::get('/club-event/users', [ClubEventController::class, 'showUsersInEvents']);
        /// all users in this events
        Route::get('club_events/{id}/users', [ClubEventController::class, 'getUsersInEvent']);
        ///get event for user by id
        Route::get('club-event/user/events/{userId}', [ClubEventController::class, 'getEventsForUser']);
        Route::post('calendar/events', [ClubEventCalendar::class, 'index']);

        //
        // Route::get('/all-blogs', [CommunityApiController::class,'index']);
        // blogs
        Route::prefix('blogs')->group(function () {
            Route::get('/', 'WebsiteApiController@news');
            //store blog
            Route::post('store', 'WebsiteApiController@storeNews');
            //display all  blog categories
            Route::get('categories', 'WebsiteApiController@displayCategoriesNews');
            //store blog comment
            Route::post('{blogId}/comments', 'WebsiteApiController@storeBlogComment');
           //display all comments for  article
            Route::get('{blogId}/allComments-blog', 'WebsiteApiController@getBlogComments');
        });
                #######consultants#############
        Route::get('all-consultants', [ConsulationApiController::class, 'index']);
        // get consultant by id
        // Route::get('consultant/{id}', [ConsulationApiController::class, 'getConsultantById']);
        Route::post('/consultant-message-request', [ConsulationApiController::class,'storeMassage']);
        Route::post('/consultant-appointment-request', [ConsulationApiController::class,'storeAppointmentRequest']);
        ###################quizzes type########################
        Route::get('/get-all-quizzes', 'CourseApiController@getAllQuizzes');
        //
        Route::get('/get-all-quizzes/for-my_exams', 'CourseApiController@getAllMyExamsQuizzes');
        Route::get('/get-all-quizzes/for-courses', 'CourseApiController@getAllCoursesQuizzes');
        Route::get('/get-all-quizzes/for-pass', 'CourseApiController@getAllPassQuizzes');
        //WebsiteApiController

        Route::get('/countries', 'WebsiteApiController@countries');
        Route::get('/states/{country_id}', 'WebsiteApiController@states');
        Route::get('/cities/{state_id}', 'WebsiteApiController@cities');
        Route::get('/my-courses', 'WebsiteApiController@myCourses');
        Route::get('/my-quizzes', 'WebsiteApiController@myQuizzes');
        Route::get('/my-classes', 'WebsiteApiController@myClasses');
        Route::post('/submit-review', 'WebsiteApiController@submitReview');
        Route::post('/comment', 'WebsiteApiController@comment');
        Route::post('/comment-reply', 'WebsiteApiController@commentReply');
        Route::post('/delete-comment', 'WebsiteApiController@deleteComment');
        Route::post('/delete-comment-reply', 'WebsiteApiController@deleteCommnetReply');
        Route::post('/delete-course-review', 'WebsiteApiController@deleteReview');
        Route::get('/payment-methods', 'WebsiteApiController@paymentMethods');

        Route::post('/make-order', 'WebsiteApiController@makeOrder');
        Route::post('/make-order-ssl', 'WebsiteApiController@makeOrderForSSL');
        Route::post('/make-payment/{gateWayName}', 'WebsiteApiController@payWithGateWay');
        Route::get('/my-billing-address', 'WebsiteApiController@myBilling');

        Route::post('tapApiSuccess', 'WebsiteApiController@tapApiSuccess')->name('tapApiSuccess');

        Route::post('paytm-order-generate', 'WebsiteApiController@paytmOrderGenerate');
        Route::post('paytm-order-verify', 'WebsiteApiController@paytmOrderVerify');

        //quiz route
        Route::post('quiz-start/{course_id}/{quiz_id}', 'WebsiteApiController@quizStart');
        Route::post('quiz-single-submit', 'WebsiteApiController@singleQusSubmit');
        Route::post('quiz-final-submit', 'WebsiteApiController@finalQusSubmit');
        Route::post('quiz-result/{course_id}/{quiz_id}', 'WebsiteApiController@quizResult');
        Route::post('quiz-results', 'WebsiteApiController@quizResults');
        Route::post('quiz-result-preview/{quiz_id}', 'WebsiteApiController@quizResultPreview');
        //new quiz result
        Route::post('quiz-history/{quiz_id}', 'WebsiteApiController@quizHistory');
        Route::post('quiz-test-result/{quiz_test__id}', 'WebsiteApiController@quizTestResult');

        //new
        Route::get('/news', 'WebsiteApiController@news');
        Route::get('/activities', 'WebsiteApiController@activities');
        Route::get('/login-devices', 'WebsiteApiController@loginDevices');
        Route::get('/certificate-records', 'WebsiteApiController@certificateRecords');
        Route::get('/course-list', 'WebsiteApiController@courseList');
        Route::get('/quiz-list', 'WebsiteApiController@quizList');
        Route::get('/learning-schedule-plans', 'WebsiteApiController@learningSchedulePlans');
        Route::get('/learning-schedule-plan-icon/{plan_id}', 'WebsiteApiController@learningSchedulePlanIcon');
        Route::get('/learning-schedule-plan-list/{plan_id}', 'WebsiteApiController@learningSchedulePlanList');
        Route::get('/course-sequence/{course_id}', 'WebsiteApiController@CourseSequence');
        Route::get('/course-report', 'WebsiteApiController@courseReport');
        Route::get('/quiz-report', 'WebsiteApiController@quizReport');
        Route::get('/notifications', 'WebsiteApiController@notifications');
        Route::get('category-courses', 'CourseApiController@categoryCourses');
        Route::post('buy-now', 'CourseApiController@buyNow');
        Route::get('get-course-certificate/{id}', 'CourseApiController@getCertificate');

        Route::get('/offline-attendance-report', 'WebsiteApiController@offlineAttendanceReport');
        Route::post('/get-course-from-slug', 'CourseApiController@getCourseFromSlug');
        Route::get('/blog-visit/{blog_id}', 'WebsiteApiController@visitBlogPost');
        Route::post('/enroll-iap', 'WebsiteApiController@enrollIAP');

        // Lottery Wheel Controller
        Route::get('lottery-wheel/prizes', 'LotteryWheelApiController@prizes');
        Route::resource('lottery-wheel', 'LotteryWheelApiController')->only(['index', 'store']);

        // Wallet Controller
        Route::get('wallet', 'WalletApiController@index');

        // Suggested Path Test Controller
        Route::get('suggested-path-test/settings', 'SuggestedPathTestApiController@settings');
        Route::get('suggested-path-test/start', 'SuggestedPathTestApiController@start');
        Route::get('suggested-path-test/reset', 'SuggestedPathTestApiController@reset');
        Route::get('suggested-path-test/result', 'SuggestedPathTestApiController@show');
        Route::resource('suggested-path-test', 'SuggestedPathTestApiController')->only(['index', 'store']);


        // Projects
        Route::prefix('projects')->as('projects')->group( function () {
            // Categories
            Route::apiResource('/categories', 'ProjectCategoryController')->only(['index', 'show']);

            // Points
            Route::group(['prefix'=> '/{project_id}/points'], function () {
                Route::apiResource('/','ProjectPointController')->only(['index', 'store']);
            });

            // Case study notes
            Route::group(['prefix'=> '/{project_id}/case-study-notes'], function () {
                Route::apiResource('/','ProjectCaseStudyNoteController')->only(['index', 'store']);
            });

            // Case Study
            Route::group(['prefix'=> '/{project_id}/case-study'], function () {
                Route::apiResource('/','ProjectCaseStudyController')->only(['index', 'store']);
            });

            // Lessons
            Route::apiResource('/lessons', 'ProjectLessonController')->only(['index', 'show']);

            // Markting ads
            Route::group(['prefix'=> '/markting/ads/{project_id_or_ad_id}'], function () {
                Route::get('/','ProjectMarketingAdsController@index');
                Route::post('/','ProjectMarketingAdsController@store');
                Route::post('/update','ProjectMarketingAdsController@update');
                Route::delete('/','ProjectMarketingAdsController@destroy');
                Route::get('/ad','ProjectMarketingAdsController@show');

                Route::post('/like','ProjectMarktingAdLikeController@store');
                Route::delete('/like','ProjectMarktingAdLikeController@destroy');
                Route::put('/like','ProjectMarktingAdLikeController@toggle');
            });

            // Markting products
            Route::group(['prefix'=> '/markting/products/{project_id_or_product_id}'], function () {
                Route::get('/','ProjectMarktingProductController@index');
                Route::post('/','ProjectMarktingProductController@store');
                Route::put('/','ProjectMarktingProductController@update');
                Route::delete('/','ProjectMarktingProductController@destroy');
            });


            // Purchases
            Route::group(['prefix'=> '/purchases/{project_id_or_purchase_id}'], function () {
                Route::get('/','ProjectPurchaseController@index');
                Route::post('/','ProjectPurchaseController@store');
                Route::put('/','ProjectPurchaseController@update');
                Route::delete('/','ProjectPurchaseController@destroy');
            });

            // Project
            Route::group(['prefix'=> '/'], function () {
                Route::get('/','ProjectController@index');
                Route::post('/','ProjectController@store');
                Route::get('/{project_id}','ProjectController@show');
                Route::put('/{project_id}','ProjectController@update');
                Route::delete('/{project_id}','ProjectController@destroy');
            });
        });
    });

    Route::prefix('opp_category')->name('opp_category.')->group( function () {

    Route::controller(Opportunity_CategoryController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});
Route::prefix('opportunity')->name('opportunity.')->group( function () {

    Route::controller(OpportunityController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});
Route::prefix('opp_app')->name('opp_app.')->group( function () {

    Route::controller(Opportunity_ApplicationController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});
Route::prefix('part')->name('part.')->group( function () {

    Route::controller(PartnershipController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});

Route::prefix('part_app')->name('part_app.')->group( function () {

    Route::controller(Partnership_ApplicationController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});
Route::prefix('fund_agency')->name('fund_agency.')->group( function () {

    Route::controller(Fund_AgencyController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});

Route::prefix('fund_app')->name('fund_app.')->group( function () {

    Route::controller(Fund_ApplicationController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});

Route::prefix('fund_cat')->name('fund_cat.')->group( function () {

    Route::controller(Fund_CategoryController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});


Route::prefix('freelance_services')->name('freelance_services.')->group( function () {

    Route::controller(freelance_servicesController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});

Route::prefix('service_applications')->name('service_applications.')->group( function () {

    Route::controller(service_applicationsController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});


  Route::prefix('service_category')->name('service_category.')->group( function () {

    Route::controller(service_categoryController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});


Route::prefix('partner_category')->name('partner_category.')->group( function () {

    Route::controller(partner_categoryController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});

});
