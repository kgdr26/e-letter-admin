<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ControllerCIA;
use App\Http\Controllers\DocumentController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'ShowFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login_post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('test', [MainController::class, 'test'])->name('test');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['auth'], 'role_id:1')->group(function () {
        Route::get('users', [MainController::class, 'users'])->name('users');
    });

    Route::middleware(['auth'], 'role_id:1|7|9|10|11|12|13|14|15|16|17|18|19|20|21|22|23|25')->group(function () {
        Route::get('inputsurat', [MainController::class, 'inputsurat'])->name('inputsurat');
    });

    Route::middleware(['auth'], 'role_id:1|7|9|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25')->group(function () {
        Route::get('assetsdash', [MainController::class, 'assetsdash'])->name('assetsdash');
    });

    Route::middleware(['auth'], 'role_id:1|7|9|10|11|12|13|14|15|16|17|18|19|20|21|22|23|25')->group(function () {
        Route::get('assetscreate', [MainController::class, 'assetscreate'])->name('assetscreate');
    });

    Route::middleware(['auth'], 'role_id:1|7|8|9|10')->group(function () {
        Route::get('assetsdephed', [MainController::class, 'assetsdephed'])->name('assetsdephed');
    });

    Route::middleware(['auth'], 'role_id:1|16|21|22')->group(function () {
        Route::get('assetsfirst', [MainController::class, 'assetsfirst'])->name('assetsfirst');
    });

    Route::middleware(['auth'], 'role_id:1|24')->group(function () {
        Route::get('assetssecond', [MainController::class, 'assetssecond'])->name('assetssecond');
    });

    Route::middleware(['auth'], 'role_id:1|24')->group(function () {
        Route::get('assetsdirector', [MainController::class, 'assetsdirector'])->name('assetsdirector');
    });

    Route::middleware(['auth'], 'role_id:1|7|9|10|11|12|13|14|15|16|17|18|19|20|21|22|23|24|25')->group(function () {
        Route::get('assetsdata', [MainController::class, 'assetsdata'])->name('assetsdata');
    });

    Route::middleware(['auth'], 'role_id:1|8|16|21|22')->group(function () {
        Route::get('dataasset', [MainController::class, 'dataasset'])->name('dataasset');
    });

    Route::middleware(['auth'], 'role_id:1|8|16|21|22')->group(function () {
        Route::get('assetscheck', [MainController::class, 'assetscheck'])->name('assetscheck');
    });

    // Route::get('document', [MainController::class, 'document'])->name('document');
    // Route::get('detaildocument', [MainController::class, 'detaildocument'])->name('detaildocument');
    Route::get('scurity', [MainController::class, 'scurity'])->name('scurity');

    Route::middleware(['auth'], 'role_id:1|8|16')->group(function () {
        Route::get('employeloan', [MainController::class, 'employeloan'])->name('employeloan');
    });
    Route::post('dataemploye', [MainController::class, 'dataemploye'])->name('dataemploye');
    Route::get('employeloanperuser', [MainController::class, 'employeloanperuser'])->name('employeloanperuser');
    Route::get('exportallloan', [MainController::class, 'exportallloan'])->name('exportallloan');
    Route::get('exportassetslanding', [MainController::class, 'exportassetslanding'])->name('exportassetslanding');

    Route::get('exportsuratadmin', [MainController::class, 'exportsuratadmin'])->name('exportsuratadmin');


    // Ticket
    Route::get('ticket_request', [MainController::class, 'ticket_request'])->name('ticket_request');
    Route::post('addticketrequest', [MainController::class, 'addticketrequest'])->name('addticketrequest');
    Route::post('editticketrequest', [MainController::class, 'editticketrequest'])->name('editticketrequest');
    Route::post('showdataticket', [MainController::class, 'showdataticket'])->name('showdataticket');
    Route::get('exportrequestticket', [MainController::class, 'exportrequestticket'])->name('exportrequestticket');

    // End Ticket

    //Action
    Route::get('assetscall', [MainController::class, 'assetscall'])->name('assetscall');
    Route::get('assetchecksheetcall', [MainController::class, 'assetchecksheetcall'])->name('assetchecksheetcall');
    Route::post('upload_profile', [MainController::class, 'upload_profile'])->name('upload_profile');
    Route::post('upload_surat', [MainController::class, 'upload_surat'])->name('upload_surat');
    Route::post('upload_file', [MainController::class, 'upload_file'])->name('upload_file');
    Route::post('actionshowdata', [MainController::class, 'actionshowdata'])->name('actionshowdata');
    Route::post('actionshowdatawmulti', [MainController::class, 'actionshowdatawmulti'])->name('actionshowdatawmulti');
    Route::post('actionlistdata', [MainController::class, 'actionlistdata'])->name('actionlistdata');
    Route::post('actionedit', [MainController::class, 'actionedit'])->name('actionedit');
    Route::post('actioneditwmulti', [MainController::class, 'actioneditwmulti'])->name('actioneditwmulti');
    Route::post('actiondelete', [MainController::class, 'actiondelete'])->name('actiondelete');
    Route::post('actionadd', [MainController::class, 'actionadd'])->name('actionadd');
    Route::post('addform', [MainController::class, 'addform'])->name('addform');
    Route::post('actioneditform', [MainController::class, 'actioneditform'])->name('actioneditform');
    Route::post('detaildataassets', [MainController::class, 'detaildataassets'])->name('detaildataassets');
    Route::post('maincekketersediaanassets', [MainController::class, 'maincekketersediaanassets'])->name('maincekketersediaanassets');
    Route::post('showdetailtimeline', [MainController::class, 'showdetailtimeline'])->name('showdetailtimeline');
    Route::post('action_autogenerateloan', [MainController::class, 'action_autogenerateloan'])->name('action_autogenerateloan');
    Route::post('showlistdataloanperuser', [MainController::class, 'showlistdataloanperuser'])->name('showlistdataloanperuser');
    Route::post('listtableloanperuser', [MainController::class, 'listtableloanperuser'])->name('listtableloanperuser');
    Route::post('actionpelunasanloan', [MainController::class, 'actionpelunasanloan'])->name('actionpelunasanloan');
    Route::post('showdatapelunasanloan', [MainController::class, 'showdatapelunasanloan'])->name('showdatapelunasanloan');
    Route::post('dataemployeperuser', [MainController::class, 'dataemployeperuser'])->name('dataemployeperuser');

    // Asset Lending
    Route::get('peminjamanasset', [MainController::class, 'peminjamanasset'])->name('peminjamanasset');

    // Assets

    // // Cash In Advance
    // Route::get('listcia', [MainController::class, 'listcia'])->name('listcia');
    // Route::get('looplistcia', [MainController::class, 'looplistcia'])->name('looplistcia');

    // Route::get('inputcia', [MainController::class, 'inputcia'])->name('inputcia');
    // Route::get('listinputcia', [MainController::class, 'listinputcia'])->name('listinputcia');
    // Route::post('inpinputcia', [MainController::class, 'inpinputcia'])->name('inpinputcia');
    // Route::post('showdatainputcia', [MainController::class, 'showdatainputcia'])->name('showdatainputcia');
    // Route::post('cancelcia', [MainController::class, 'cancelcia'])->name('cancelcia');

    // Route::get('listciadephead', [MainController::class, 'listciadephead'])->name('listciadephead');
    // Route::get('looplistciadephead', [MainController::class, 'looplistciadephead'])->name('looplistciadephead');
    // Route::post('approvedepheadcia', [MainController::class, 'approvedepheadcia'])->name('approvedepheadcia');

    // Route::get('listciafinance', [MainController::class, 'listciafinance'])->name('listciafinance');
    // Route::get('looplistciafinance', [MainController::class, 'looplistciafinance'])->name('looplistciafinance');
    // Route::post('approvefinancecia', [MainController::class, 'approvefinancecia'])->name('approvefinancecia');
    // Route::post('submitselisih', [MainController::class, 'submitselisih'])->name('submitselisih');
    // Route::post('submitclosecia', [MainController::class, 'submitclosecia'])->name('submitclosecia');

    // Route::get('listciacashier', [MainController::class, 'listciacashier'])->name('listciacashier');
    // Route::get('looplistciacashier', [MainController::class, 'looplistciacashier'])->name('looplistciacashier');
    // Route::post('submitciaambilchasir', [MainController::class, 'submitciaambilchasir'])->name('submitciaambilchasir');
    // Route::post('cekdatacia', [MainController::class, 'cekdatacia'])->name('cekdatacia');

    // Route::post('rejectcia', [MainController::class, 'rejectcia'])->name('rejectcia');

    // Route::post('addamountactual', [MainController::class, 'addamountactual'])->name('addamountactual');

    // Route::get('downloadcia', [MainController::class, 'downloadcia'])->name('downloadcia');
    // // End Cash In Advance


    Route::middleware(['auth'])->group(function () {
        // Route untuk menampilkan stok dan histori stok
        Route::get('/stok', [StockController::class, 'index'])->name('stok.index');

        // Route untuk entry stok oleh finance
        Route::post('/stok/add', [StockController::class, 'addStock'])->name('stok.add');

        // Route untuk entry pengambilan dan pengembalian stok oleh requester
        Route::post('/stok/minus-return', [StockController::class, 'minusReturnStock'])->name('stok.minusReturn');

        // Route untuk fungsi export file phpOffice
        Route::get('/export-stock-history', [StockController::class, 'exportStockHistoryToExcel'])->name('export-stock-history');
    });


    // Start CIA Route
    // Route::post('/cia/store', [ControllerCIA::class, 'store'])->name('cia.store');
    // Route::get('/cia/form', [ControllerCIA::class, 'indexForm'])->name('cia.form');
    // Route::get('/cia/dephead-approval', [ControllerCIA::class, 'depheadApproval'])->name('cia.depheadApproval');
    // Route::get('/cia/finance-approval', [ControllerCIA::class, 'financeApproval'])->name('cia.financeApproval');
    // Route::get('/cia/payment-request', [ControllerCIA::class, 'paymentRequest'])->name('cia.paymentRequest');
    // Route::post('/cia/submit-settlement', [ControllerCIA::class, 'submitSettlement'])->name('cia.submitSettlement');
    // Route::get('/cia/overview', [ControllerCIA::class, 'overview'])->name('cia.overview');
    // Route::post('/cia/edit', [ControllerCIA::class, 'edit'])->name('actionshowdata'); // Route untuk ambil data
    // Route::post(
    //     '/cia/update',
    //     [ControllerCIA::class, 'update']
    // )->name('actioneditform');
    // Route::get('/cia/print/{id}', [ControllerCIA::class, 'printPdf'])->name('cia.print');
    // Route::get('/cia/delete/{id}', [ControllerCIA::class, 'delete'])->name('cia.delete');
    // Route::get('/cia/dephead-approval', [ControllerCIA::class, 'depheadApproval'])->name('cia.depheadApproval');
    // Route::post('/cia/dephead-approval/action', [ControllerCIA::class, 'depheadApproveOrReject'])->name('cia.depheadApproveOrReject');
    // End CIA Route

    //Document Control
    Route::middleware(['auth'])->group(function () {
        Route::get('/document/create', [DocumentController::class, 'create'])->name('document.create');
        Route::post('/document/upload', [DocumentController::class, 'upload'])->name('document.upload');
        Route::post('/document/approve/{id}', [DocumentController::class, 'approve'])->name('document.approve');
        Route::post('/document/approve/sechead/{id}', [DocumentController::class, 'approveSechead'])->name('document.approve.sechead');
        Route::post('/document/approve/dephead/{id}', [DocumentController::class, 'approveDephead'])->name('document.approve.dephead');
        Route::post('/document/pic/docu/{id}', [DocumentController::class, 'picDocu'])->name('document.pic.docu');
    });
});
