<?php

use App\Models\Translation\Translation;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('{locale?}')
    ->middleware([
        \App\Http\Middleware\SetLocale::class,
        \App\Http\Middleware\StatusChecker::class,
        \App\Http\Middleware\ComingSoonMiddleware::class
    ])
    ->group(function(){
        Route::resource('latest-news', \App\Http\Controllers\NewsController::class)->only([
            'show', 'index'
        ]);

        Route::resource('educational-programs', \App\Http\Controllers\EducationalPrograms::class)->only(['show']);

        Route::prefix('student-life')->group(function(){
            Route::resource('facilities', \App\Http\Controllers\FacilitiesController::class)->only(['show', 'index']);
            Route::resource('extra-curricular-activities', \App\Http\Controllers\ExtraCurricularActivitiesController::class)->only(['show', 'index']);
            Route::any('summer-camp/register', [\App\Http\Controllers\SummerCampController::class, 'register'])->name('summer-camp.register');
            Route::resource('summer-camp', \App\Http\Controllers\SummerCampController::class)->only(['show', 'index']);
            Route::any('summer-camp/{summer_camp}/register', [\App\Http\Controllers\SummerCampController::class, 'register'])->name('summer-camp.camp.register');

        });

        Route::controller(\App\Http\Controllers\AboutIecController::class)
            ->prefix('about-iec')
            ->group(function(){
                Route::get('/downloads', 'downloads')->name('about-iec.downloads');
                Route::get('/awards-and-accreditations', 'awards_and_accreditations')->name('about-iec.awards-and-accreditations');
                Route::get('/our-history', 'our_history')->name('about-iec.our-history');
                Route::get('/faqs', 'faqs')->name('about-iec.faqs');
                Route::get('/photo-gallery', 'photo_gallery')->name('about-iec.photo-gallery');
                Route::get('/video-gallery', 'video_gallery')->name('about-iec.video-gallery');
            });

        Route::controller(\App\Http\Controllers\AboutIcsController::class)
            ->prefix('about-ics')
            ->group(function(){
                Route::get('/founders', 'founders')->name('about-ics.founders');
                Route::get('/our-history', 'our_history')->name('about-iec.our-ics-history');
                Route::get('/mission-and-vision', 'mission_and_vision')->name('about-ics.mission-and-vision');
                Route::get('/board-of-directors', 'board_of_directors')->name('about-ics.board-of-directors');
            });

        Route::controller(\App\Http\Controllers\SiteController::class)
            ->group(function(){
                Route::get('/', 'index')->name('site.index');
                Route::any('/filter', 'filter')->name('site.filter');
                Route::any('/contact-us', 'contactUs')->name('site.contact-us');
            });

        Route::get('/{page}', [\App\Http\Controllers\SiteController::class, 'show'])->name('page.show');

        Route::fallback([\App\Http\Controllers\SiteController::class, 'show']);
    });

