<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['web'])->group(function () {
    Route::get('clear-cache/v1', function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        return "Cache,View is cleared";
    });

    Route::middleware(['admin_not_logged_in'])->group(function () {
        Route::get('/', 'AuthController@get_login');
        Route::get('admin-login', ['uses' => 'AuthController@get_login', 'as' => 'admin-login']);
        Route::post('admin-login', ['uses' => 'AuthController@post_login', 'as' => 'admin-login']);
        Route::post('admin-forgotpassword', ['uses' => 'AuthController@post_forgot_password', 'as' => 'admin-forgotpassword']);
        Route::get('admin-lockscreen', ['uses' => 'AuthController@get_lockscreen', 'as' => 'admin-lockscreen']);
        Route::post('admin-lockscreen', ['uses' => 'AuthController@post_lockscreen', 'as' => 'admin-lockscreen']);
    });

    Route::middleware(['admin_logged_in'])->group(function () {
        Route::get('admin-logout', ['uses' => 'AuthController@logout', 'as' => 'admin-logout']);

        Route::get('admin-dashboard', ['uses' => 'DashboardController@index', 'as' => 'admin-dashboard']);
        Route::post('get-dashboard-request', ['uses' => 'DashboardController@dashboard_request', 'as' => 'get-dashboard-request']);
        Route::post('admin-requested-forworded-chart', ['uses' => 'DashboardController@requested_forworded_chart', 'as' => 'admin-requested-forworded-chart']);
        Route::post('admin-tender-posted-chart', ['uses' => 'DashboardController@tender_posted_chart', 'as' => 'admin-tender-posted-chart']);

        Route::get('admin-myprofile', ['uses' => 'MyprofileController@get_myprofile', 'as' => 'admin-myprofile']);
        Route::post('admin-myprofile', ['uses' => 'MyprofileController@post_myprofile', 'as' => 'admin-myprofile']);
        Route::post('change-email', ['uses' => 'MyprofileController@post_change_email', 'as' => 'change-email']);


        Route::get('admin-contact', ['uses' => 'ContactController@index', 'as' => 'admin-contact']);
        Route::get('admin-contact-list-datatable', ['uses' => 'ContactController@contact_list', 'as' => 'admin-contact-list-datatable']);
        Route::get('admin-viewcontact/{id}', ['uses' => 'ContactController@view', 'as' => 'admin-viewcontact']);
        Route::post('send-reply/{id}', ['uses' => 'ContactController@send_reply', 'as' => 'send-reply']);
        Route::get('admin-updatecontact/{id}', ['uses' => 'ContactController@get_update', 'as' => 'admin-updatecontact']);
        Route::post('admin-updatecontact/{id}', ['uses' => 'ContactController@post_update', 'as' => 'admin-updatecontact']);
        Route::post('admin-deleteContact', ['uses' => 'ContactController@delete', 'as' => 'admin-deleteContact']);

        Route::get('admin-cms', ['uses' => 'CmsController@index', 'as' => 'admin-cms']);
        Route::get('admin-cms-list-datatable', ['uses' => 'CmsController@cms_list', 'as' => 'admin-cms-list-datatable']);
        Route::get('admin-viewcms/{id}', ['uses' => 'CmsController@view', 'as' => 'admin-viewcms']);
        Route::get('admin-updatecms/{id}', ['uses' => 'CmsController@get_update', 'as' => 'admin-updatecms']);
        Route::post('admin-updatecms/{id}', ['uses' => 'CmsController@post_update', 'as' => 'admin-updatecms']);



        Route::get('admin-cmsMulti', ['uses' => 'CmsController@index_multi', 'as' => 'admin-cmsMulti']);
        Route::get('admin-viewcmsMulti/{id}', ['uses' => 'CmsController@index_multi_view', 'as' => 'admin-viewcmsMulti']);
        Route::get('admin-editcmsMulti/{id}', ['uses' => 'CmsController@cms_edit', 'as' => 'admin-editcmsMulti']);
        Route::get('admin-createcmsMulti/{id}', ['uses' => 'CmsController@cmsMulti_create', 'as' => 'admin-createcmsMulti']);
        // Route::get('admin-cms-list-datatable', ['uses' => 'CmsController@cms_list', 'as' => 'admin-cms-list-datatable']);
        Route::post('admin-updateMulti/{id}', ['uses' => 'CmsController@post_updateMulti1', 'as' => 'admin-updateMulti']);
        Route::post('admin-createMulti/{id}', ['uses' => 'CmsController@createpdateMulti1', 'as' => 'admin-createMulti']);


        // New Blog Routes //...........................................................

        Route::get('admin-news', ['uses' => 'NewsController@index', 'as' => 'admin-news']);
        Route::get('admin-editnews/{id}', ['uses' => 'NewsController@edit', 'as' => 'admin-editnews']);
        Route::post('admin-updateBlog', ['uses' => 'NewsController@post_updateBlog', 'as' => 'admin-updateBlog']);

        Route::get('admin-blog_create', ['uses' => 'NewsController@blog_create', 'as' => 'admin-blog_create']);
        Route::post('admin-create_blog', ['uses' => 'NewsController@create_blog', 'as' => 'admin-create_blog']);

        // Route::get('admin-viewcmsMulti/{id}', ['uses' => 'CmsController@index_multi_view', 'as' => 'admin-viewcmsMulti']);
        // // Route::get('admin-cms-list-datatable', ['uses' => 'CmsController@cms_list', 'as' => 'admin-cms-list-datatable']);

        // New Blog Routes //...........................................................


        Route::get('adminemail', ['uses' => 'EmailController@get_email', 'as' => 'adminemail']);
        Route::get('admin-email-list-datatable', ['uses' => 'EmailController@email_list', 'as' => 'admin-email-list-datatable']);
        Route::get('admin-updateeml/{id}', ['uses' => 'EmailController@get_update_email', 'as' => 'admin-updateeml']);
        Route::post('admin-updateeml/{id}', ['uses' => 'EmailController@post_update_email', 'as' => 'admin-updateeml']);


        Route::get('admin-emails', ['uses' => 'EmailController@index', 'as' => 'admin-emails']);
        Route::get('admin-viewemail/{id}', ['uses' => 'EmailController@view', 'as' => 'admin-viewemail']);
        Route::get('admin-updateemail/{id}', ['uses' => 'EmailController@get_update', 'as' => 'admin-updateemail']);
        Route::post('admin-updateemail/{id}', ['uses' => 'EmailController@post_update', 'as' => 'admin-updateemail']);
        Route::get('admin-faqs', ['uses' => 'FaqController@index', 'as' => 'admin-faqs']);
        Route::get('admin-faq-list-datatable', ['uses' => 'FaqController@index', 'as' => 'admin-faq-list-datatable']);
        Route::get('admin-createfaq', ['uses' => 'FaqController@get_create', 'as' => 'admin-createfaq']);
        Route::post('admin-createfaq', ['uses' => 'FaqController@post_create', 'as' => 'admin-createfaq']);
        Route::get('admin-viewfaq/{id}', ['uses' => 'FaqController@view', 'as' => 'admin-viewfaq']);
        Route::get('admin-updatefaq/{id}', ['uses' => 'FaqController@get_update', 'as' => 'admin-updatefaq']);
        Route::post('admin-updatefaq', ['uses' => 'FaqController@post_update', 'as' => 'admin-updatefaq']);
        Route::post('admin-deletefaq', ['uses' => 'FaqController@delete', 'as' => 'admin-deletefaq']);

        Route::get('admin-settings', ['uses' => 'SettingsController@index', 'as' => 'admin-settings']);
        Route::post('admin-settings', ['uses' => 'SettingsController@post_update', 'as' => 'admin-settings']);

        Route::get('admin-seo', ['uses' => 'SeoController@index', 'as' => 'admin-seo']);
        Route::get('admin-viewseo/{id}', ['uses' => 'SeoController@view', 'as' => 'admin-viewseo']);
        Route::get('admin-updateseo/{id}', ['uses' => 'SeoController@get_update', 'as' => 'admin-updateseo']);
        Route::post('admin-updateseo/{id}', ['uses' => 'SeoController@post_update', 'as' => 'admin-updateseo']);


        Route::get('admin-service-provider', ['uses' => 'ServiceProviderController@index', 'as' => 'admin-service-provider']);
        Route::post('admin-addprovider', ['uses' => 'ServiceProviderController@post_add', 'as' => 'admin-addprovider']);
        Route::get('admin-user-list-datatable', ['uses' => 'ServiceProviderController@user_list', 'as' => "admin-user-list-datatable"]);
        Route::get('admin-updateuser/{id}', ['uses' => 'ServiceProviderController@edit', 'as' => "admin-updateuser"]);
        Route::post('admin-updateuser', ['uses' => 'ServiceProviderController@post_update', 'as' => 'admin-updateuser']);
        Route::post('admin-deleteuser', ['uses' => 'ServiceProviderController@delete', 'as' => "admin-deleteuser"]);

        Route::get('admin-request', ['uses' => 'RequrirementController@index', 'as' => 'admin-request']);
        Route::get('admin-requrirement-list-datatable', ['uses' => 'RequrirementController@requrirement_list', 'as' => "admin-requrirement-list-datatable"]);
        Route::post('admin-deleterequriment', ['uses' => 'RequrirementController@delete', 'as' => "admin-deleterequriment"]);

        // Route::get('admin-product',['uses'=>'ProductController@index','as'=>'admin-product']);
        // Route::get('admin-addproduct',['uses'=>'ProductController@add','as'=>'admin-addproduct']);


        // Route::get('admin-deletproduct',['uses'=>'RequrirementController@delete','as'=>'admin-deleteproduct']);
        // Route::get('admin-deletproductattribute',['uses'=>'ProductController@productattributedelete','as'=>'admin-deletproductattribute']);
        // Route::get('admin-productimagedelete/{id}',['uses'=>'ProductController@productattributeimagedelete','as'=>'admin-productimagedelete']);

        Route::get('admin-assignrequest/{id}', ['uses' => 'RequrirementController@view', 'as' => 'admin-assignrequest']);
        Route::post('admin-assignrequest', ['uses' => 'RequrirementController@post_assign', 'as' => 'admin-assignrequest']);

        Route::get('admin-hire-request', ['uses' => 'HireController@index', 'as' => 'admin-hire-request']);
        Route::get('admin-hire-fixer-list-datatable', ['uses' => 'HireController@hire_fixer_list', 'as' => "admin-hire-fixer-list-datatable"]);
        Route::post('admin-addrequest', ['uses' => 'HireController@post_request', 'as' => 'admin-addrequest']);
        Route::get('admin-updaterequest/{id}', ['uses' => 'HireController@edit', 'as' => 'admin-updaterequest']);
        Route::get('show-hire-fixer-images', ['uses' => 'HireController@showimages', 'as' => 'show-hire-fixer-images']);
        Route::post('admin-updaterequest', ['uses' => 'HireController@post_update', 'as' => 'admin-updaterequest']);

        Route::post('admin-request-photo', ['uses' => 'HireController@upload_request_photo', 'as' => 'admin-request-photo']);
        Route::post('remove-request-image', ['uses' => 'RequrirementController@remove_request_photo', 'as' => 'remove-request-image']);
        Route::get('show-request-images', ['uses' => 'RequrirementController@showimages', 'as' => 'show-request-images']);
        Route::post('admin-deletefixer', ['uses' => 'HireController@delete', 'as' => "admin-deletefixer"]);


        // GasCylinder
        Route::get('admin-cylinder', ['uses' => 'CylinderController@index', 'as' => 'admin-cylinder']);
        Route::post('admin-addcylinder', ['uses' => 'CylinderController@post_cylinder', 'as' => 'admin-addcylinder']);
        Route::get('admin-cylinder-list-datatable', ['uses' => 'CylinderController@cylinder_list', 'as' => "admin-cylinder-list-datatable"]);
        Route::get('admin-deletecylinder', ['uses' => 'CylinderController@delete', 'as' => 'admin-deletecylinder']);
        Route::get('admin-updatecylinder/{id}', ['uses' => 'CylinderController@edit', 'as' => 'admin-updatecylinder']);
        Route::post('admin-updatecylinder', ['uses' => 'CylinderController@post_update', 'as' => 'admin-updatecylinder']);
        // End GasCylinder


        // GasCylinder
        Route::get('admin-autogas', ['uses' => 'AutogasController@index', 'as' => 'admin-autogas']);
        Route::post('admin-addautogas', ['uses' => 'AutogasController@post_autogas', 'as' => 'admin-addautogas']);
        Route::get('admin-autogas-list-datatable', ['uses' => 'AutogasController@autogas_list', 'as' => "admin-autogas-list-datatable"]);
        Route::get('admin-deleteautogas', ['uses' => 'AutogasController@delete', 'as' => 'admin-deleteautogas']);
        Route::get('admin-updateautogas/{id}', ['uses' => 'AutogasController@edit', 'as' => 'admin-updateautogas']);
        Route::post('admin-updateautogas', ['uses' => 'AutogasController@post_update', 'as' => 'admin-updateautogas']);
        // End GasCylinder


        // GasCylinder Orders
        Route::get('admin-orders', ['uses' => 'OrdersController@index', 'as' => 'admin-orders']);
        Route::post('admin_order_status', ['uses' => 'OrdersController@orders_status', 'as' => 'admin_order_status']);

        Route::post('admin-addorders', ['uses' => 'OrdersController@post_orders', 'as' => 'admin-addorders']);
        Route::get('admin-orders-list-datatable', ['uses' => 'OrdersController@orders_list', 'as' => "admin-orders-list-datatable"]);
        Route::get('admin-deleteorders', ['uses' => 'OrdersController@delete', 'as' => 'admin-deleteorders']);
        Route::get('admin-updateorders/{id}', ['uses' => 'OrdersController@edit', 'as' => 'admin-updateorders']);
        Route::post('admin-updateorders', ['uses' => 'OrdersController@post_update', 'as' => 'admin-updateorders']);
        // End GasCylinder Orders
        //

        Route::get('admin-dealership_opportunity', ['uses' => 'CylinderController@dealership_View', 'as' => 'admin-dealership_opportunity']);
        Route::post('admin-dealership_status', ['uses' => 'CylinderController@dealership_status', 'as' => 'admin-dealership_status']);


        Route::get('admin-category', ['uses' => 'CategoryController@index', 'as' => 'admin-category']);
        Route::post('admin-addcategory', ['uses' => 'CategoryController@post_category', 'as' => 'admin-addcategory']);
        Route::get('admin-category-list-datatable', ['uses' => 'CategoryController@category_list', 'as' => "admin-category-list-datatable"]);
        Route::post('admin-deletecategory', ['uses' => 'CategoryController@delete', 'as' => 'admin-deletecategory']);
        Route::get('admin-updatecategory/{id}', ['uses' => 'CategoryController@edit', 'as' => 'admin-updatecategory']);
        Route::post('admin-updatecategory', ['uses' => 'CategoryController@post_update', 'as' => 'admin-updatecategory']);

        /*         * ****************Notification Management**************** */
        Route::post('admin-get-notifications', ['uses' => 'NotificationController@admin_get_notifications', 'as' => 'admin-get-notifications']);
        Route::get('admin-notification', ['uses' => 'NotificationController@admin_show_all_notification', 'as' => 'admin-notification']);
        Route::post('admin-markAsInactive', ['uses' => 'NotificationController@markAsInactive', 'as' => 'admin-markAsInactive']);
        Route::get('changenotistatus', ['uses' => 'NotificationController@changenotistatus', 'as' => 'changenotistatus']);

        Route::get('admin-blog', ['uses' => 'BlogController@index', 'as' => 'admin-blog']);
        Route::get('admin-blog-list-datatable', ['uses' => 'BlogController@blog_list', 'as' => 'admin-blog-list-datatable']);
        Route::post('admin-addblog', ['uses' => 'BlogController@post_blog', 'as' => 'admin-addblog']);
        Route::get('admin-updateblog/{id}', ['uses' => 'BlogController@edit_blog', 'as' => 'admin-updateblog']);
        Route::post('admin-updateblog', ['uses' => 'BlogController@edit_post_blog', 'as' => 'admin-updateblog']);
        Route::post('admin-deleteblog', ['uses' => 'BlogController@delete', 'as' => 'admin-deleteblog']);

        Route::get('admin-testimonial', ['uses' => 'TestimonialController@index', 'as' => 'admin-testimonial']);
        Route::get('admin-testimonial-list-datatable', ['uses' => 'TestimonialController@testimonial_list', 'as' => 'admin-testimonial-list-datatable']);
        Route::post('admin-addtestimonial', ['uses' => 'TestimonialController@post_testimonial', 'as' => 'admin-addtestimonial']);
        Route::get('admin-updatetestimonial/{id}', ['uses' => 'TestimonialController@edit_testimonial', 'as' => 'admin-updatetestimonial']);
        Route::post('admin-updatetestimonial', ['uses' => 'TestimonialController@edit_post_testimonial', 'as' => 'admin-updatetestimonial']);
        Route::post('admin-deletetestimonial', ['uses' => 'TestimonialController@delete', 'as' => 'admin-deletetestimonial']);

        Route::get('admin-requirement-report', ['uses' => 'ReportController@requriment_report', 'as' => 'admin-requirement-report']);
    });

    Route::middleware(['moderator_logged_in'])->group(function () {
        /*         * ****************ModeratorController**************** */

        Route::get('admin-moderator', ['uses' => 'ModeratorController@index', 'as' => 'admin-moderator']);
        Route::get('admin-moderator-list-datatable', ['uses' => 'ModeratorController@moderator_list', 'as' => "admin-moderator-list-datatable"]);
        Route::get('admin-addmoderator', ['uses' => 'ModeratorController@add', 'as' => 'admin-addmoderator']);
        Route::post('admin-addmoderator', ['uses' => 'ModeratorController@post_add', 'as' => 'admin-addmoderator']);
        Route::get('admin-updatemoderator/{id}', ['uses' => 'ModeratorController@edit', 'as' => "admin-updatemoderator"]);
        Route::post('admin-updatemoderator/{id}', ['uses' => 'ModeratorController@post_update', 'as' => 'admin-updatemoderator']);
        Route::get('admin-deletemoderator', ['uses' => 'ModeratorController@delete', 'as' => "admin-deletemoderator"]);
    });

    Route::get('dev/test','AuthController@devLog');
});
