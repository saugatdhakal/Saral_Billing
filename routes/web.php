<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalesReturnController;
use App\Http\Controllers\SaleItemController;
use App\Http\Controllers\SalesReturn;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\PurchaseItemController;
use App\Http\Controllers\SupplierLedgerController;
use App\Http\Controllers\AccountLedgerController;
use App\Http\Controllers\PurchaseEmailController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {


//Dashboard Routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//

//? User Routes
Route::get('/user', [App\Http\Controllers\Users::class, 'index'])->name('user');
Route::get('/user/changepassword', [App\Http\Controllers\Users::class, 'changepassword'])->name('user.changePassword');
Route::get('/user/changeDetails', [App\Http\Controllers\Users::class, 'changeDetails'])->name('user.changeDeatils'); //AJAX
Route::get('/user/updateDetails', [App\Http\Controllers\Users::class, 'updateDetails'])->name('user.updateDetails'); //AJAX
Route::get('/user/updatePassword', [App\Http\Controllers\Users::class, 'updatePassword'])->name('user.updatePassword');
Route::get('/user/addUser', [App\Http\Controllers\Users::class, 'addUser'])->name('user.addUser');
//

//* Account Routes
Route::post('/account/savePayment', [App\Http\Controllers\AccountController::class,'savePayment'])->name('account.savePayment');
Route::get('/account/searchSaleInvoice/{id}', [App\Http\Controllers\AccountController::class,'searchSaleInvoice'])->name('account.searchSaleInvoice');
Route::get('/account/paymentView', [App\Http\Controllers\AccountController::class,'paymentView'])->name('account.paymentView');
Route::get('/account/index', [App\Http\Controllers\AccountController::class, 'index'])->name('Account.index');
Route::get('/account/create', [App\Http\Controllers\AccountController::class, 'create'])->name('account.create');
Route::post('/account/add', [App\Http\Controllers\AccountController::class, 'add'])->name('Account.add');
Route::get('/account/edit/{id}', [App\Http\Controllers\AccountController::class, 'edit'])->name('account.edit');
Route::post('/account/update/{id}', [App\Http\Controllers\AccountController::class, 'update'])->name('account.update');
Route::get('/account/view/{id}', [App\Http\Controllers\AccountController::class, 'view'])->name('account.view');
Route::delete('/account/delete/{id}', [App\Http\Controllers\AccountController::class, 'delete'])->name('account.delete');
Route::get('/account/trash', [App\Http\Controllers\AccountController::class, 'trash'])->name('account.trash');
Route::delete('/account/trashDelete/{id}', [App\Http\Controllers\AccountController::class, 'trashDelete'])->name('account.trashDelete');
Route::post('/account/trashRestore/{id}', [App\Http\Controllers\AccountController::class, 'trashRestore'])->name('account.trashRestore');
//

//? Suppliers Routes
Route::get('/supplier/index', [App\Http\Controllers\SuppliersController::class, 'index'])->name('supplier.index');
Route::get('/supplier/getSuppliers', [App\Http\Controllers\SuppliersController::class, 'getSuppliers'])->name('supplier.getSuppliers'); //Yajra Box Datatable
Route::get('/supplier/create', [App\Http\Controllers\SuppliersController::class, 'create'])->name('supplier.create');
Route::post('/supplier/store', [App\Http\Controllers\SuppliersController::class, 'store'])->name('supplier.store');
Route::get('/supplier/edit/{id}', [App\Http\Controllers\SuppliersController::class, 'edit'])->name('supplier.edit');
Route::post('/supplier/update/{id}', [App\Http\Controllers\SuppliersController::class, 'update'])->name('supplier.update');
Route::delete('supplier/delete/{id}', [App\Http\Controllers\SuppliersController::class, 'delete'])->name('supplier.delete');
Route::get('/supplier/view/{id}', [App\Http\Controllers\SuppliersController::class, 'view'])->name('supplier.view');
Route::get('/supplier/trash', [App\Http\Controllers\SuppliersController::class, 'trash'])->name('supplier.trash');
Route::get('/supplier/getTrash', [App\Http\Controllers\SuppliersController::class, 'getTrash'])->name('supplier.getTrash'); //Yajra Box Datatable
Route::post('/supplier/restoreSupplier/{id}', [App\Http\Controllers\SuppliersController::class, 'restoreSupplier'])->name('supplier.restoreSupplier');
Route::delete('/supplier/trashSupplier/{id}', [App\Http\Controllers\SuppliersController::class, 'trashSupplier'])->name('supplier.trashSupplier');
Route::get('/supplier/paymentView', [App\Http\Controllers\SuppliersController::class, 'paymentView'])->name('supplier.paymentView');
Route::post('/supplier/paymentStore', [App\Http\Controllers\SuppliersController::class, 'paymentStore'])->name('supplier.paymentStore');
Route::get('/supplier/invoiceSearch/{id}', [App\Http\Controllers\SuppliersController::class, 'invoiceSearch'])->name('supplier.invoiceSearch');


//* Transport Routes Resource
Route::get('/transport/restoreTransport/{id}',[TransportController::class, 'restoreTransport'])->name('transport.restoreTransport');
Route::delete('/transport/forceDeleteTransport/{id}',[TransportController::class, 'forceDeleteTransport'])->name('transport.forceDeleteTransport');
Route::get('/transport/trashDataTable',[TransportController::class, 'trashDataTable'])->name('transport.trashDataTable');
Route::get('/transport/trash',[TransportController::class, 'trash'])->name('transport.trash');
Route::get('/transport/view/Model/{id}', [TransportController::class,'viewModel'])->name('transport.viewModel');
Route::get('/transport/yajraTable', [TransportController::class, 'yajraTableIndex'])->name('transport.yajraTableIndex');
Route::resource('transport', TransportController::class);

// *? Product  **/
Route::delete('/product/forceDeleteProduct/{id}', [ProductController::class, 'forceDeleteProduct'])->name('product.forceDeleteProduct');
Route::post('/product/restoreProduct/{id}', [ProductController::class, 'restoreProduct'])->name('product.restoreProduct');
Route::get('/product/productTrash', [ProductController::class, 'productTrash'])->name('product.productTrash');
Route::get('/product/trashAjax', [ProductController::class, 'trashAjax'])->name('product.trashAjax');
Route::get('/product/ajaxIndex', [ProductController::class, 'ajaxIndex'])->name('product.ajaxIndex');
Route::resource('product',ProductController::class);


// * *Category **/
Route::delete('/category/forceDeleteCategory/{id}',[CategoryController::class, 'forceDeleteCategory'])->name('transport.forceDeleteCategory');
Route::get('/category/restoreCategory/{id}',[CategoryController::class, 'restoreCategory'])->name('transport.restoreCategory');
Route::get('/category/trash',[CategoryController::class, 'trash'])->name('category.trash');
Route::get('/category/CategoryTrash',[CategoryController::class, 'CategoryTrash'])->name('category.CategoryTrash');
Route::get('/category/categoryUpdate',[CategoryController::class,'categoryUpdate'])->name('category.categoryUpdate');
Route::get('/category/yajraTable',[CategoryController::class,'yajraTableIndexs'])->name('category.yajraTableIndex');
Route::resource('category',CategoryController::class);

// *?Purchase 
Route::delete('/purchase/trashDelete/{id}',[PurchaseController::class, 'trashDelete'])->name('purchase.trashDelete');
Route::post('/purchase/restorePurchase/{id}',[PurchaseController::class,'restorePurchase'])->name('purchase.restorePurchase');
Route::get('/purchase/trashAjax',[PurchaseController::class,'trashAjax'])->name('purchase.trashAjax');
Route::get('/purchase/trashPage',[PurchaseController::class,'trashPage'])->name('purchase.trashPage');
Route::get('/purchase/moduleView/{id}',[PurchaseController::class,'moduleView'])->name('purchase.moduleView');
Route::get('/purchase/invoice2/{id}',[PurchaseController::class,'invoice2'])->name('purchase.invoice2');
Route::get('/purchase/invoice1/{id}',[PurchaseController::class,'invoice1'])->name('purchase.invoice1');
Route::get('/purchase/ajaxIndex',[PurchaseController::class,'ajaxIndex'])->name('purchase.ajaxIndex');
Route::get('purchase/purchaseOrderView/{id}',[PurchaseController::class,'purchaseOrderView'])->name('purchase.purchaseOrderView');   
Route::get('/Purchase/ajaxIndex',[PurchaseController::class,'ajaxIndex'])->name('purchase.ajaxIndex');
Route::get('/Purchase/print/{id}',[PurchaseController::class,'print'])->name('purchase.print');
Route::get('/purchase/domPdf/{id}',[PurchaseController::class,'domPdf'])->name('purchase.domPdf');
Route::resource('purchase',PurchaseController::class);

// **Purchase Item /
Route::post('/purchaseItem/updateList',[PurchaseItemController::class,'updateList'])->name('purchaseItem.updateList');
Route::get('/purchaseItem/editProductList/{id}',[PurchaseItemController::class,'editProductList'])->name('purchaseItem.editProductList');
Route::post('/purchaseItem/store/{id}',[PurchaseItemController::class,'store'])->name('purchaseItem.store');
Route::get('/purchaseItem/getProductCode',[PurchaseItemController::class,'getProductCode'])->name('purchaseItem.getProductCode');
Route::delete('/purchaseItem/deletePurchaseList/{id}',[PurchaseItemController::class,'deletePurchaseList'])->name('purchaseItem.deletePurchaseList');
Route::post('/purchaseItem/completeInvoice/{id}',[PurchaseItemController::class,'completeInvoice'])->name('purchaseItem.completeInvoice');

// *?Stock
Route::post('/stock/statusSwitch/{id}',[StockController::class,'statusSwitch'])->name('stock.statusSwitch');
Route::get('/stock/getIndexAjax',[StockController::class,'getIndexAjax'])->name('stock.getIndexAjax');
Route::resource('stock',StockController::class);

//!Email 
Route::get('/purchaseEmail/index',[PurchaseEmailController::class,'index'])->name('purchaseEmail.index');

//* Sale
Route::get('/sale/domPdf/{id}',[SaleController::class,'domPdf'])->name('sales.domPdf');
Route::get('/sale/print/{id}',[SaleController::class,'print'])->name('sales.print');
Route::get('/sale/invoiceView/{id}',[SaleController::class,'invoiceView'])->name('sales.invoiceView');
Route::get('/sale/moduleView/{id}',[SaleController::class,'moduleView'])->name('sales.moduleView');
Route::get('/sale/ajaxIndex',[SaleController::class,'ajaxIndex'])->name('sales.ajaxIndex');
Route::get('/sale/salesItem/{id}',[SaleController::class,'salesItem'])->name('sales.salesItem');
Route::resource('sale',SaleController::class);

// ? SaleItem
Route::post('/salesItem/completeSales/{id}',[SaleItemController::class,'completeSales'])->name('salesItem.completeSales');
Route::delete('/salesItem/deleteSaleItem/{id}',[SaleItemController::class,'deleteSaleItem'])->name('salesItem.deleteSaleItem');
Route::post('/salesItem/updateSalesItem/{id}',[SaleItemController::class,'updateSalesItem'])->name('salesItem.updateSalesItem');
Route::get('/salesItem/stockEdit/{id}',[SaleItemController::class,'stockEdit'])->name('salesItem.stockEdit');
Route::get('/salesItem/stockSelect/{id}',[SaleItemController::class,'stockSelect'])->name('salesItem.stockSelect');
Route::post('/salesItem/store/{id}',[SaleItemController::class,'store'])->name('salesItem.store');

//* SALE RETURN
Route::get('/salesReturn/moduleView/{id}',[SalesReturnController::class,'moduleView'])->name('salesReturn.moduleView');
Route::get('/salesReturn/ajaxIndex',[SalesReturnController::class,'ajaxIndex'])->name('salesReturn.ajaxIndex');
Route::post('/salesReturn/returnItemComplete/{id}',[SalesReturnController::class,'returnItemComplete'])->name('salesReturn.returnItemComplete');
Route::delete('/salesReturn/returnItemDelete/{id}',[SalesReturnController::class,'returnItemDelete'])->name('salesReturn.returnItemDelete');
Route::post('/salesReturn/returnItemSave/{id}',[SalesReturnController::class,'returnItemSave'])->name('salesReturn.returnItemSave');
Route::get('/salesReturn/returnItem/{id}',[SalesReturnController::class,'returnItem'])->name('salesReturn.returnItem');
Route::resource('salesReturn',SalesReturnController::class);

//? Supplier Ledger
Route::get('/supplierLedger/searchLedger',[SupplierLedgerController::class,'searchLedger'])->name('supplierLedger.searchLedger');
Route::resource('supplierLedger', SupplierLedgerController::class);

//* Account Ledger

Route::get('/accountLedger',[AccountLedgerController::class,'index'])->name('accountLedger.index');
Route::get('/accountLedger/searchLedger',[AccountLedgerController::class,'searchLedger'])->name('accountLedger.searchLedger');

Route::get('/salesReport',[SalesReportController::class,'index'])->name('salesReport.index');
Route::get('/salesReport/searchReport',[SalesReportController::class,'searchReport'])->name('salesReport.searchReport');

}); 