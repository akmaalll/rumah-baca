<?php

use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\ClusteringController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Apps\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Apps\RekomendasiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Apps\PreferensiController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/store', [AuthController::class, 'store'])->name('store.register');

Route::get('/preferensi', [PreferensiController::class, 'showForm'])->name('preferensi.form');
Route::post('/preferensi', [PreferensiController::class, 'simpanPreferensi'])->name('simpan.preferensi');

Route::prefix('admin')->middleware('auth', 'role:admin')->group(function () {
    // Route::view('/', 'pages.dashboard.index', ['menu' => 'dashboard'])->name('admin.dashboard');
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('buku')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('buku.index');
        Route::get('/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/store', [BukuController::class, 'store'])->name('buku.store');
        Route::get('/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::put('/update/{id}', [BukuController::class, 'update'])->name('buku.update');
        Route::delete('/delete/{id}', [BukuController::class, 'destroy'])->name('buku.delete');
    });

    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.delete');
    });
    Route::prefix('tag')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('tag.index');
        Route::get('/create', [TagController::class, 'create'])->name('tag.create');
        Route::post('/store', [TagController::class, 'store'])->name('tag.store');
        Route::get('/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
        Route::put('/update/{id}', [TagController::class, 'update'])->name('tag.update');
        Route::delete('/delete/{id}', [TagController::class, 'destroy'])->name('tag.delete');
    });

    Route::prefix('clustering')->group(function () {
        Route::get('/', [ClusteringController::class, 'index'])->name('clustering.index');
        Route::get('/proses', [ClusteringController::class, 'clusterBuku'])->name('clustering.proses');
        Route::get('/hasil-cluster', [ClusteringController::class, 'hasilClustering'])->name('clustering.hasil');
    });
});

Route::prefix('user')->middleware('auth', 'role:user')->group(function () {
    // Rute untuk halaman utama pengguna
    Route::get('/', [HomeController::class, 'index'])->name('user.dashboard');
    Route::prefix('rekomendasi')->group(function () {
        Route::get('/', [RekomendasiController::class, 'index'])->name('user.rekomendasi.index');
        Route::post('/generate', [RekomendasiController::class, 'generate'])->name('user.rekomendasi.generate');
    });

    Route::prefix('detail-buku')->group(function () {
        Route::get('/{id}', [HomeController::class, 'detail'])->name('detail.buku');
    });

    // Rute untuk rekomendasi buku
});



// Dashboard
Route::prefix('dashboard')->group(function () {

    Route::get('ecommerce', function () {
        return view('pages.dashboard.dashboard-ecommerce', ['menu' => 'dashboard']);
    })->name('dashboard.ecommerce');

    Route::get('general', function () {
        return view('pages.dashboard.dashboard-general', ['menu' => 'dashboard']);
    })->name('dashboard.general');
});



// Layouts
Route::prefix('layout')->group(function () {

    Route::get('default', function () {
        return view('pages.layouts.layout-default', ['menu' => 'layout']);
    })->name('layout.default');

    Route::get('transparent', function () {
        return view('pages.layouts.layout-transparent', ['menu' => 'layout']);
    })->name('layout.transparent');

    Route::get('top-navigation', function () {
        return view('pages.layouts.layout-top-navigation', ['menu' => 'layout']);
    })->name('layout.top-navigation');
});

// Blank
Route::get('blank', function () {
    return view('pages.blank.layout-blank', ['menu' => 'blank']);
})->name('blank');

// Bootstrap
Route::prefix('bootstrap')->group(function () {

    Route::get('alert', function () {
        return view('pages.bootstrap.alert', ['menu' => 'bootstrap']);
    })->name('bootstrap.alert');

    Route::get('badge', function () {
        return view('pages.bootstrap.badge', ['menu' => 'bootstrap']);
    })->name('bootstrap.badge');

    Route::get('breadcrumb', function () {
        return view('pages.bootstrap.breadcrumb', ['menu' => 'bootstrap']);
    })->name('bootstrap.breadcrumb');

    Route::get('button', function () {
        return view('pages.bootstrap.button', ['menu' => 'bootstrap']);
    })->name('bootstrap.button');

    Route::get('card', function () {
        return view('pages.bootstrap.card', ['menu' => 'bootstrap']);
    })->name('bootstrap.card');

    Route::get('carousel', function () {
        return view('pages.bootstrap.carousel', ['menu' => 'bootstrap']);
    })->name('bootstrap.carousel');

    Route::get('collapse', function () {
        return view('pages.bootstrap.collapse', ['menu' => 'bootstrap']);
    })->name('bootstrap.collapse');

    Route::get('dropdown', function () {
        return view('pages.bootstrap.dropdown', ['menu' => 'bootstrap']);
    })->name('bootstrap.dropdown');

    Route::get('form', function () {
        return view('pages.bootstrap.form', ['menu' => 'bootstrap']);
    })->name('bootstrap.form');

    Route::get('list-group', function () {
        return view('pages.bootstrap.list-group', ['menu' => 'bootstrap']);
    })->name('bootstrap.list-group');

    Route::get('media-object', function () {
        return view('pages.bootstrap.media-object', ['menu' => 'bootstrap']);
    })->name('bootstrap.media-object');

    Route::get('modal', function () {
        return view('pages.bootstrap.modal', ['menu' => 'bootstrap']);
    })->name('bootstrap.modal');

    Route::get('nav', function () {
        return view('pages.bootstrap.nav', ['menu' => 'bootstrap']);
    })->name('bootstrap.nav');

    Route::get('navbar', function () {
        return view('pages.bootstrap.navbar', ['menu' => 'bootstrap']);
    })->name('bootstrap.navbar');

    Route::get('pagination', function () {
        return view('pages.bootstrap.pagination', ['menu' => 'bootstrap']);
    })->name('bootstrap.pagination');

    Route::get('popover', function () {
        return view('pages.bootstrap.popover', ['menu' => 'bootstrap']);
    })->name('bootstrap.popover');

    Route::get('progress', function () {
        return view('pages.bootstrap.progress', ['menu' => 'bootstrap']);
    })->name('bootstrap.progress');

    Route::get('table', function () {
        return view('pages.bootstrap.table', ['menu' => 'bootstrap']);
    })->name('bootstrap.table');

    Route::get('tooltip', function () {
        return view('pages.bootstrap.tooltip', ['menu' => 'bootstrap']);
    })->name('bootstrap.tooltip');

    Route::get('typography', function () {
        return view('pages.bootstrap.typography', ['menu' => 'bootstrap']);
    })->name('bootstrap.typography');
});

// Components
Route::prefix('components')->group(function () {

    Route::get('article', function () {
        return view('pages.components.article', ['menu' => 'components']);
    })->name('components.article');

    Route::get('avatar', function () {
        return view('pages.components.avatar', ['menu' => 'components']);
    })->name('components.avatar');

    Route::get('chat-box', function () {
        return view('pages.components.chat-box', ['menu' => 'components']);
    })->name('components.chat-box');

    Route::get('empty-state', function () {
        return view('pages.components.empty-state', ['menu' => 'components']);
    })->name('components.empty-state');

    Route::get('gallery', function () {
        return view('pages.components.gallery', ['menu' => 'components']);
    })->name('components.gallery');

    Route::get('hero', function () {
        return view('pages.components.hero', ['menu' => 'components']);
    })->name('components.hero');

    Route::get('multiple-upload', function () {
        return view('pages.components.multiple-upload', ['menu' => 'components']);
    })->name('components.multiple-upload');

    Route::get('pricing', function () {
        return view('pages.components.pricing', ['menu' => 'components']);
    })->name('components.pricing');

    Route::get('statistic', function () {
        return view('pages.components.statistic', ['menu' => 'components']);
    })->name('components.statistic');

    Route::get('tab', function () {
        return view('pages.components.tab', ['menu' => 'components']);
    })->name('components.tab');

    Route::get('table', function () {
        return view('pages.components.table', ['menu' => 'components']);
    })->name('components.table');

    Route::get('user', function () {
        return view('pages.components.user', ['menu' => 'components']);
    })->name('components.user');

    Route::get('wizard', function () {
        return view('pages.components.wizard', ['menu' => 'components']);
    })->name('components.wizard');
});

// Forms
Route::prefix('forms')->group(function () {

    Route::get('advanced-form', function () {
        return view('pages.forms.advanced-form', ['menu' => 'forms']);
    })->name('forms.advanced-form');

    Route::get('editor', function () {
        return view('pages.forms.editor', ['menu' => 'forms']);
    })->name('forms.editor');

    Route::get('validation', function () {
        return view('pages.forms.validation', ['menu' => 'forms']);
    })->name('forms.validation');
});

// Google Maps
Route::prefix('gmaps')->group(function () {

    Route::get('advanced-route', function () {
        return view('pages.gmaps.advanced-route', ['menu' => 'gmaps']);
    })->name('gmaps.advanced-route');

    Route::get('draggable-marker', function () {
        return view('pages.gmaps.draggable-marker', ['menu' => 'gmaps']);
    })->name('gmaps.draggable-marker');

    Route::get('geocoding', function () {
        return view('pages.gmaps.geocoding', ['menu' => 'gmaps']);
    })->name('gmaps.geocoding');

    Route::get('geolocation', function () {
        return view('pages.gmaps.geolocation', ['menu' => 'gmaps']);
    })->name('gmaps.geolocation');

    Route::get('marker', function () {
        return view('pages.gmaps.marker', ['menu' => 'gmaps']);
    })->name('gmaps.marker');

    Route::get('multiple-marker', function () {
        return view('pages.gmaps.multiple-marker', ['menu' => 'gmaps']);
    })->name('gmaps.multiple-marker');

    Route::get('route', function () {
        return view('pages.gmaps.route', ['menu' => 'gmaps']);
    })->name('gmaps.route');

    Route::get('simple', function () {
        return view('pages.gmaps.simple', ['menu' => 'gmaps']);
    })->name('gmaps.simple');
});

// Google Maps
Route::prefix('modules')->group(function () {

    Route::get('calendar', function () {
        return view('pages.modules.calendar', ['menu' => 'modules']);
    })->name('modules.calendar');

    Route::get('chart-js', function () {
        return view('pages.modules.chart-js', ['menu' => 'modules']);
    })->name('modules.chart-js');

    Route::get('datatables', function () {
        return view('pages.modules.datatables', ['menu' => 'modules']);
    })->name('modules.datatables');

    Route::get('flag', function () {
        return view('pages.modules.flag', ['menu' => 'modules']);
    })->name('modules.flag');

    Route::get('font-awesome', function () {
        return view('pages.modules.font-awesome', ['menu' => 'modules']);
    })->name('modules.font-awesome');

    Route::get('ion-icons', function () {
        return view('pages.modules.ion-icons', ['menu' => 'modules']);
    })->name('modules.ion-icons');

    Route::get('owl-carousel', function () {
        return view('pages.modules.owl-carousel', ['menu' => 'modules']);
    })->name('modules.owl-carousel');

    Route::get('sparkline', function () {
        return view('pages.modules.sparkline', ['menu' => 'modules']);
    })->name('modules.sparkline');

    Route::get('sweet-alert', function () {
        return view('pages.modules.sweet-alert', ['menu' => 'modules']);
    })->name('modules.sweet-alert');

    Route::get('toastr', function () {
        return view('pages.modules.toastr', ['menu' => 'modules']);
    })->name('modules.toastr');

    Route::get('vector-map', function () {
        return view('pages.modules.vector-map', ['menu' => 'modules']);
    })->name('modules.vector-map');

    Route::get('weather-icon', function () {
        return view('pages.modules.weather-icon', ['menu' => 'modules']);
    })->name('modules.weather-icon');
});

// Auth
Route::prefix('auth')->group(function () {

    Route::get('forgot-password', function () {
        return view('pages.auth.forgot-password', ['menu' => 'auth']);
    })->name('auth.forgot-password');

    Route::get('login', function () {
        return view('pages.auth.login', ['menu' => 'auth']);
    })->name('auth.login');

    Route::get('login2', function () {
        return view('pages.auth.login2', ['menu' => 'auth']);
    })->name('auth.login2');

    // Route::get('register', function () {
    //     return view('pages.auth.register', ['menu' => 'auth']);
    // })->name('auth.register');

    Route::get('reset-password', function () {
        return view('pages.auth.reset-password', ['menu' => 'auth']);
    })->name('auth.reset-password');
});

// Errors
Route::prefix('error')->group(function () {

    Route::get('error-503', function () {
        return view('pages.error.error-503', ['menu' => 'error']);
    })->name('error.error-503');

    Route::get('error-403', function () {
        return view('pages.error.error-403', ['menu' => 'error']);
    })->name('error.error-403');

    Route::get('error-404', function () {
        return view('pages.error.error-404', ['menu' => 'error']);
    })->name('error.error-404');

    Route::get('error-500', function () {
        return view('pages.error.error-500', ['menu' => 'error']);
    })->name('error.error-500');
});

// Features
Route::prefix('feature')->group(function () {

    Route::get('activities', function () {
        return view('pages.features.feature-activities', ['menu' => 'features']);
    })->name('feature.activites');

    Route::get('post-create', function () {
        return view('pages.features.feature-post-create', ['menu' => 'features']);
    })->name('feature.post-create');

    Route::get('posts', function () {
        return view('pages.features.feature-posts', ['menu' => 'features']);
    })->name('feature.posts');

    Route::get('profile', function () {
        return view('pages.features.feature-profile', ['menu' => 'features']);
    })->name('feature.profile');

    Route::get('settings', function () {
        return view('pages.features.feature-settings', ['menu' => 'features']);
    })->name('feature.settings');

    Route::get('setting-detail', function () {
        return view('pages.features.feature-setting-detail', ['menu' => 'features']);
    })->name('feature.setting-detail');

    Route::get('tickets', function () {
        return view('pages.features.feature-tickets', ['menu' => 'features']);
    })->name('feature.tickets');
});

// Utilites
Route::prefix('utilities')->group(function () {

    Route::get('contact', function () {
        return view('pages.utilities.contact', ['menu' => 'utilities']);
    })->name('utilities.contact');

    Route::get('invoice', function () {
        return view('pages.utilities.invoice', ['menu' => 'utilities']);
    })->name('utilities.invoice');

    Route::get('subscribe', function () {
        return view('pages.utilities.subscribe', ['menu' => 'utilities']);
    })->name('utilities.subscribe');
});

// Credits
Route::get('credits', function () {
    return view('pages.credits.credits', ['menu' => 'credits']);
})->name('credits');
