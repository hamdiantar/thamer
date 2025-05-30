<?php

use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Controllers\Admin\TimetableController;
use App\Http\Controllers\Admin\YearController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainAdminController::class, 'loginForm'])->name('index');
Route::name('admin.')->group(function () {
    Route::get('/login', [MainAdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [MainAdminController::class, 'login'])->name('login');
    Route::middleware('auth')->group(function () {
        Route::get('home', [MainAdminController::class, 'home'])->name('home');
        Route::post('logout', [MainAdminController::class, 'logout'])->name('logout');
        Route::get('my_profile', [MainAdminController::class, 'profile'])->name('profile');
        Route::put('my_profile', [MainAdminController::class, 'updateProfile'])->name('profile');


        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('years', YearController::class)->names('years');
        Route::resource('levels', LevelController::class)->names('levels');


        Route::resource('courses', \App\Http\Controllers\Admin\CourseController::class);
        Route::resource('instructors', \App\Http\Controllers\Admin\InstructorController::class);
        Route::resource('departments', \App\Http\Controllers\Admin\DepartmentController::class);
        Route::resource('rooms', \App\Http\Controllers\Admin\RoomController::class);
        Route::resource('periods', \App\Http\Controllers\Admin\PeriodController::class);
        Route::resource('groups', \App\Http\Controllers\Admin\GroupController::class);
        Route::resource('classes', ClassController::class);
        Route::get('timetable/{departmentId?}/{groupId?}/{semesterId?}', [ClassController::class, 'timetable'])
            ->name('timetable');
        Route::post('pre/timetable/classes', [ClassController::class, 'updateTimeTable'])->name('classes.store2');
        Route::resource('semesters', \App\Http\Controllers\Admin\SemesterController::class);



        Route::post('timetable/get-courses', [ClassController::class, 'getCoursesAndTeachers'])
            ->name('timetable.getCourses');

    });
});
