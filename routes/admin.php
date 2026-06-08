<?php

use App\Http\Controllers\Backend\Admin\SettingsController;
use App\Http\Controllers\Backend\Admin\ManageUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Menu\MenuController;
use App\Http\Controllers\Backend\Pages\CardsController;
use App\Http\Controllers\Backend\Pages\PagesController;
use App\Http\Controllers\Backend\Seo\BlogsController;
use App\Http\Controllers\Backend\Seo\CategoriesController;
use App\Http\Controllers\Backend\Seo\SeoController;
use App\Http\Controllers\Backend\Seo\SitemapController;
use App\Http\Controllers\Backend\Seo\TestimonialController;
use App\Http\Controllers\PagecraftController;
use App\Http\Controllers\Utility\FileManagerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagebuilderTemplateController;
use App\Models\Page;

Route::get('/forgot-password', [AuthController::class, 'showForgotPage'])->name('password.request');
Route::post('/forgot-password/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/forgot-password/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/forgot-password/reset', [AuthController::class, 'resetPassword']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/log-out', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/backend/login');
})->name('backend.logout');
Route::post('/login-post', [AuthController::class, 'loginPost']);
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->can('dashboard');
        //users
        Route::get('users', [ManageUserController::class, 'userIndex'])->name('user-index')->can('user-list');
        Route::get('user-create', [ManageUserController::class, 'createUser'])->name('user-create')->can('user-create');
        Route::post('user-store', [ManageUserController::class, 'storeUpdate'])->name('user-store')->can('user-create');
        Route::put('user-update/{id}', [ManageUserController::class, 'storeUpdate'])->name('user-update')->can('user-edit');
        Route::get('user-delete/{id}', [ManageUserController::class, 'userDelete'])->name('user-delete')->can('user-delete');
        Route::get('user-edit/{id}', [ManageUserController::class, 'editUser'])->name('user-edit')->can('user-edit');

        //roles
        Route::get('roles', [ManageUserController::class, 'rolesIndex'])->name('roles-index')->can('user-roles-list');
        Route::get('role-create', [ManageUserController::class, 'roleCreate'])->name('role-create')->can('user-roles-create');
        Route::get('role-edit/{id}', [ManageUserController::class, 'editRole'])->name('role-edit')->can('user-roles-edit');
        Route::post('role-store', [ManageUserController::class, 'roleStoreUpdate'])->name('role-store')->can('user-roles-create');
        Route::put('role-update/{id}', [ManageUserController::class, 'roleStoreUpdate'])->name('role-update')->can('user-roles-edit');
        Route::get('role-delete/{id}', [ManageUserController::class, 'roleDelete'])->name('role-delete')->can('user-roles-delete');

        Route::get('role-permission/{id}', [ManageUserController::class, 'rolePermission'])->name('role-permissions')->can('user-roles-permission');
        Route::post('role-permission-update/{id}', [ManageUserController::class, 'updateRolePermissions'])->name('role-permissions-update')->can('user-roles-permission');

        //permission
        Route::get('permissions', [ManageUserController::class, 'permIndex'])->name('perm-index')->can('user-permissions-list');
        Route::get('perm-create', [ManageUserController::class, 'permCreate'])->name('perm-create')->can('user-permissions-create');
        Route::get('perm-edit/{id}', [ManageUserController::class, 'editPerm'])->name('perm-edit')->can('user-permissions-edit');
        Route::post('perm-store', [ManageUserController::class, 'permStoreUpdate'])->name('perm-store')->can('user-permissions-create');
        Route::put('perm-update/{id}', [ManageUserController::class, 'permStoreUpdate'])->name('perm-update')->can('user-permissions-edit');
        Route::get('perm-delete/{id}', [ManageUserController::class, 'permDelete'])->name('perm-delete')->can('user-permissions-delete');

        Route::get('/website-settings', [SettingsController::class, 'index'])->name('settings')->can('website-settings');
        Route::post('/website-color/store', [SettingsController::class, 'websiteStore'])->name('settings.website-color.store')->can('website-settings');
        Route::post('/website-logos/store', [SettingsController::class, 'logoStore'])->name('settings.logos-store')->can('website-settings');
        Route::post('/website-social-media/store', [SettingsController::class, 'socialMediaStore'])->name('settings.social.update')->can('website-settings');

        Route::post('/website-info-store', [SettingsController::class, 'websiteInfoStore'])->name('settings.website_info_store')->can('website-settings');
        Route::post('/working-hour-store', [SettingsController::class, 'workingHoursStore'])->name('settings.working_hours_store')->can('website-settings');
        Route::post('/particle-js-store', [SettingsController::class, 'particleJsTypeStore'])->name('settings.particle_type_store')->can('website-settings');
        Route::post(
            'home-banner-slider-store',
            [SettingsController::class, 'home_banner_slider_store']
        )->name('settings.home_banner_slider_store')->can('home_banner_slider_store');

        Route::get('/contacts-list', [AdminController::class, 'contactFormIndex'])->name('contacts')->can('contacts-list');

        Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials')->can('testimonial-list');
        Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create')->can('testimonial-list');
        Route::post('/testimonials/store', [TestimonialController::class, 'storeUpdate'])->name('testimonials.store')->can('testimonial-list');
        Route::get('/testimonial/edit/{testimonial}', [TestimonialController::class, 'edit'])->name('testimonials.edit')->can('testimonial-list');

        Route::get('/delete-testimonial/{id}', [TestimonialController::class, 'delete'])->name('testimonials.delete')->can('testimonial-list');
        Route::post('/testimonial-update/{testimonial}', [TestimonialController::class, 'storeUpdate'])->name('testimonials.update')->can('testimonial-list');

        Route::get('/custom-codes', [AdminController::class, 'customCodes'])->name('custom_codes.index')->can('custom-codes');
        Route::get('/custom-codes/create', [AdminController::class, 'customCodeCreate'])->name('custom_codes.create')->can('custom-codes');
        Route::get('/custom-codes/edit/{id}', [AdminController::class, 'customCodeEdit'])->name('custom_codes.edit')->can('custom-codes');
        Route::post('/custom-codes/storeUpdate/{id?}', [AdminController::class, 'customCodeStoreUpdate'])->name('custom_codes.store_update')->can('custom-codes');
    });
    Route::prefix('seo/')->name('seo.')->group(function () {
        Route::prefix('/blogs')->name('blogs.')->group(function () {
            Route::get('/', [BlogsController::class, 'index'])->name('index')->can('blog-list');
            Route::get('/create', [BlogsController::class, 'create'])->name('create')->can('blog-create');
            Route::post('/save', [BlogsController::class, 'store'])->name('save')->can('blog-create');
            Route::get('/edit/{id}', [BlogsController::class, 'edit'])->name('edit')->can('blog-edit');
            Route::put('/update/{id}', [BlogsController::class, 'store'])->name('update')->can('blog-edit');
            Route::get('/delete/{id}', [BlogsController::class, 'delete'])->name('delete')->can('blog-delete');
            Route::get('/categories', [CategoriesController::class, 'index'])->name('categories')->can('blog-categories');
            Route::get('/ajax-categories', [CategoriesController::class, 'ajaxCategories']);
            Route::post('/ajax-category-save', [CategoriesController::class, 'storeCategory']);
            Route::get('/ajax-category-get/{id}', [CategoriesController::class, 'getCategory']);
            Route::delete('/ajax-category-delete/{id}', [CategoriesController::class, 'deleteCategory'])->can('blog-categories');
            Route::get('/comments', [BlogsController::class, 'commentIndex'])->name('comments')->can('blogs-comment');
            Route::post('/change-comment-status', [BlogsController::class, 'commentStatus'])->name('comments.status')->can('blogs-comment');
            Route::post('/change-blog-status', [BlogsController::class, 'changeBlogStatus'])->name('status.change')->can('change-blog-status');
        });
        Route::get('/', [SeoController::class, 'index'])->name('index')->can('seo-index');
        Route::post('/store-blog-seo', [SeoController::class, 'blogsSeo'])->name('store-blogs-seo')->can('seo-index');
        Route::post('/store-contact-us-seo', [SeoController::class, 'contactSeo'])->name('store-contact-us-seo')->can('seo-index');
        Route::post('/store-analytics', [SeoController::class, 'contactAnalytics'])->name('store-analytics')->can('seo-index');

        Route::get('/generate-sitemap', [SitemapController::class, 'generateSitemap'])->can('generate-sitemap');
    });





    Route::prefix('pages')->name('pages.')->group(function () {
        Route::get('/', [PagesController::class, 'index'])->name('index')->can('page-list');
        Route::get('/clone/{id}', [PagesController::class, 'clone'])->name('clone')->can('page-list');
        Route::get('/create', [PagesController::class, 'create'])->name('create')->can('page-create');
        Route::post('/store', [PagesController::class, 'storeUpdate'])->name('store')->can('page-create');
        Route::get('/edit/{id}', [PagesController::class, 'edit'])->name('edit')->can('page-edit');
        Route::post('/update/{id}', [PagesController::class, 'storeUpdate'])->name('update')->can('page-edit');
        Route::get('/delete/{id}', [PagesController::class, 'delete'])->name('delete')->can('page-delete');
        Route::post('/pages/preview', [PagesController::class, 'preview'])->name('preview');

        Route::post('/status-change', [PagesController::class, 'changeStatus'])->name('status.change');
    });

    Route::prefix('menus')->name('menus.')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('index')->can('menu-list');
        Route::get('/create', [MenuController::class, 'create'])->name('create')->can('create-menu');
        Route::post('/store', [MenuController::class, 'store'])->name('store')->can('create-menu');
        Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit')->can('edit-menu');
        Route::post('/{menu}/update', [MenuController::class, 'update'])->name('update')->can('edit-menu');
    });



    Route::prefix('cards')->name('cards.')->group(function () {

        Route::get('/', [CardsController::class, 'index'])->name('index')->can('cards-list');
        Route::get('/create', [CardsController::class, 'create'])->name('create')->can('cards-create');
        Route::get('/edit/{card}', [CardsController::class, 'edit'])->name('edit')->can('cards-edit');
        Route::get('/delete/{id}', [CardsController::class, 'delete'])->name('delete')->can('cards-delete');
        Route::post('/store', [CardsController::class, 'storeUpdate'])->name('store')->can('cards-store');
        Route::post('/update/{id}', [CardsController::class, 'storeUpdate'])->name('update')->can('cards-update');
    });

    Route::post('/upload', [FileManagerController::class, 'upload'])->name('tinymce.upload');
    Route::get('/file-manager/images', [FileManagerController::class, 'index']);
    Route::post('/file-manager/upload', [FileManagerController::class, 'upload']);
    Route::delete('/file-manager/delete/{id}', [FileManagerController::class, 'delete']);
    Route::get('/file-manager', [FileManagerController::class, 'fileManager'])->name('file-manager');

     Route::get('page-editor/{id}', [PagesController::class,'pageCraftEditor']);
  
    Route::prefix('pagecraft')->name('pagecraft.')->group(function () {
        Route::post('/preview/{slug}', [PagecraftController::class, 'preview'])->name('preview');
    });
    Route::post(
        '/pagebuilder/templates/save',
        [PagebuilderTemplateController::class, 'save']
    );

    Route::get(
        '/pagebuilder/templates/list',
        [PagebuilderTemplateController::class, 'list']
    );
    Route::post('pagebuilder/templates/delete', [PagebuilderTemplateController::class, 'deleteTemplate']);
    Route::post('pagebuilder/page/store', [PagebuilderTemplateController::class, 'storePage']);
});
