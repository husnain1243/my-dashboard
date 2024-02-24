<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegister;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserDetailController;
use Illuminate\Support\Facades\Auth;

// Admin CRUD Control Pages

Route::get('/admin/login' , [LoginRegister::class , 'login'])->name('login');
Route::get('/admin/userLogin' , [LoginRegister::class , 'UserLogin'])->name('UserLogin');
Route::get('/admin/register' , [LoginRegister::class , 'register'])->name('register');
Route::post('/admin/userregister' , [LoginRegister::class , 'create'])->name('UserRegister');
Route::get('/admin/ForgetPassword' , [LoginRegister::class , 'forgetpassword'])->name('ForgetPassword');
Route::get('/admin/userforgetpassword' , [LoginRegister::class , 'UserForgetPassword'])->name('UserForgetPassword');
Route::get('/admin/logout' , [LoginRegister::class , 'logout'])->name('logout');

Route::post('/forms-front/form-submit', [FormController::class, 'FormSubmit'])->name('form-submit');
// User Pages route

Route::get('/' , [PagesController::class , 'HomePage'])->name('home-page');
Route::get('/{slug}' , [PagesController::class , 'LoadPage'])->name('load-page');

// Authentication Controll route

Route::prefix('admin')->group(function () {
    Auth::routes();
    Route::middleware('auth')->group(function(){

        // Admin Main Dashboard

        Route::get('/dashboard' , [LoginRegister::class , 'Dashboard'])->name('Dashboard');

        // Admin User Control Pages

        Route::get('/userdetail/{id}' , [UserDetailController::class , 'UserDetail'])->name('UserDetails');
        Route::get('/update/{id}' , [LoginRegister::class , 'update'])->name('update');
        Route::post('/updateUserRecord/{id}' , [LoginRegister::class , 'updateUserRecord'])->name('updateUserRecord');
        Route::get('/DeleteUser/{id}' , [LoginRegister::class , 'Userdelete'])->name('DeleteUser');

        // Admin SitePages Control

        Route::get('/SitePages' , [PagesController::class , 'SitePages'])->name('SitePages');
        Route::get('/SitePagesDetails/{id}' , [PagesController::class , 'SitePagesDetails'])->name('SitePagesDetails');
        Route::get('/Create_SitePages' , [PagesController::class , 'Create_Site_Pages'])->name('Create_SitePages');
        Route::get('/Site_Pages_Saver' , [PagesController::class , 'Site_Pages_Saver'])->name('Site_Pages_Saver');
        Route::get('/PagesUpdate/{id}' , [PagesController::class , 'PagesUpdate'])->name('PagesUpdate');
        Route::post('/Pages_Update_New/{id}' , [PagesController::class , 'Pages_Update_New'])->name('Pages_Update_New');
        Route::get('/PagesDelete/{id}' , [PagesController::class , 'PagesDelete'])->name('PagesDelete');

        // Admin Blogs Control Pages

        Route::get('/Blogs' , [PagesController::class , 'Blogs'])->name('Blogs');
        Route::get('/Create_blogs' , [PagesController::class , 'Create_Blogs'])->name('Create_blogs');
        Route::post('/Blogs_Saver' , [PagesController::class , 'Blogs_Saver'])->name('Blogs_Saver');
        Route::get('/BlogsDetails/{id}' , [PagesController::class , 'BlogsDetails'])->name('BlogsDetails');
        Route::get('/BlogsUpdate/{id}' , [PagesController::class , 'BlogsUpdate'])->name('BlogsUpdate');
        Route::post('/Blogs_Update_New/{id}' , [PagesController::class , 'Blogs_Update_New'])->name('Blogs_Update_New');
        Route::get('/BlogDelete/{id}' , [PagesController::class , 'BlogDelete'])->name('BlogDelete');

        // Admin Services Control Pages

        Route::get('/Services' , [PagesController::class , 'Services'])->name('Services');
        Route::get('/Services_Detail/{id}' , [PagesController::class , 'Services_Detail'])->name('Services_Detail');
        Route::get('/Create_Services' , [PagesController::class , 'Create_Services'])->name('Create_Services');
        Route::post('/Services_Saver' , [PagesController::class , 'Services_Saver'])->name('Services_Saver');
        Route::get('/Services_Update/{id}' , [PagesController::class , 'Services_Update'])->name('Services_Update');
        Route::post('/Services_Update_New/{id}' , [PagesController::class , 'Services_Update_New'])->name('Services_Update_New');
        Route::get('/Services_Delete/{id}' , [PagesController::class , 'Services_Delete'])->name('Services_Delete');

        // Admin Teams Control Pages

        Route::get('/Teams' , [PagesController::class , 'Teams'])->name('Teams');
        Route::get('/Teams_Detail/{id}' , [PagesController::class , 'Teams_Detail'])->name('Teams_Detail');
        Route::get('/Create_Teams' , [PagesController::class , 'Create_Teams'])->name('Create_Teams');
        Route::post('/Teams_Saver' , [PagesController::class , 'Teams_Saver'])->name('Teams_Saver');
        Route::get('/Teams_Update/{id}' , [PagesController::class , 'Teams_Update'])->name('Teams_Update');
        Route::post('/Teams_Update_New/{id}' , [PagesController::class , 'Teams_Update_New'])->name('Teams_Update_New');
        Route::get('/Teams_Delete/{id}' , [PagesController::class , 'Teams_Delete'])->name('Teams_Delete');

        // Admin Form Control Pages
        Route::get('/Forms' , [FormController::class , 'Forms'])->name('Forms');
        Route::get('/Forms_Delete/{id}' , [FormController::class , 'Forms_Delete'])->name('Forms_Delete');

        // Admin Media Control Pages

        Route::get('/Media' , [PagesController::class , 'Media'])->name('Media');
        Route::get('/Create_Media' , [PagesController::class , 'Create_Media'])->name('Create_Media');
        Route::post('/Media_Saver' , [PagesController::class , 'Media_Saver'])->name('Media_Saver');
        Route::get('/Media_Delete/{id}' , [PagesController::class , 'Media_Delete'])->name('Media_Delete');

        // Admin Site Control Pages

        Route::get('/Site_Settings' , [PagesController::class , 'Site_Settings'])->name('Site_Settings');
        Route::get('/Create_Site_Settings' , [PagesController::class , 'Create_Site_Settings'])->name('Create_Site_Settings');
        Route::Post('/Create_Site_Form' , [PagesController::class , 'Create_Site_Form'])->name('Create_Site_Form');
        Route::get('/Update_Site_Settings/{id}' , [PagesController::class , 'Update_Site_Settings'])->name('Update_Site_Settings');
        Route::post('/Update_Site_Settings_New/{id}' , [PagesController::class , 'Update_Site_Settings_New'])->name('Update_Site_Settings_New');
        Route::get('/Site_Setting_Delete/{id}' , [PagesController::class , 'Site_Setting_Delete'])->name('Site_Setting_Delete');
    });
});
