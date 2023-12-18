<?php

use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PrensaController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\DocumentoViewController;
use App\Http\Controllers\ConvocatoriaController;
use App\Http\Controllers\ConvocatoriaFechaController;
use App\Http\Controllers\CarrouselController;
use App\Http\Controllers\AlcaldeController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\FooterController;

use App\Http\Controllers\MisionVisionController;

use App\Http\Controllers\OrganigramaController;
use App\Http\Controllers\DemografiaController;
use App\Http\Controllers\HistoriaController;
use App\Http\Controllers\LayoutController;








use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/show/{id}', [WelcomeController::class, 'show']);

Route::resource('noticias', NoticiaController::class);
Route::resource('docview', DocumentoViewController::class);
//Route::resource('misionvision', MisionVisionController::class);
Route::resource('organigrama', OrganigramaController::class);
Route::resource('demografia', DemografiaController::class);
Route::resource('historia', HistoriaController::class);
//Route::get('/viewlogo', [LogoController::class,'logoview']);
Route::get('/mision-vision', [MisionVisionController::class, 'misisionvision']);





Route::get('viewsconvocatorias', [ConvocatoriaController::class, 'viewconvocatoria']);
Route::get('/info-alcalde', [AlcaldeController::class, 'informacion']);




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    Route::resource('documentos', DocumentoController::class);
    Route::resource('users', UserController::class);
    Route::resource('prensas', PrensaController::class);
    Route::resource('carrousel', CarrouselController::class);
    Route::resource('alcalde', AlcaldeController::class,);
    Route::resource('logos', LogoController::class,);
    Route::resource('footers', FooterController::class,);
    Route::resource('paneles', PanelController::class,);
    Route::resource('misionvision', MisionVisionController::class,);








    //Route::resource('convocatorias', ConvocatoriaController::class);


    //Route::resource('fechas', ConvocatoriaFechaController::class);
    //Route::get('/fechas', [ConvocatoriaFechaController::class, 'checkDateExists']);

    //Route::post('fechas', [ConvocatoriaFechaController::class,'store']);





    // routes/web.php

//Route::get('/show/{prensaId}', [WelcomeController::class,'show'])->name('prensa.show');


});
