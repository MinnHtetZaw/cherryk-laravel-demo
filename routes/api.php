<?php


use App\Http\Controllers\ProcedureVoucherController;
use App\Http\Controllers\SaleVoucherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SymptonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmrHealthController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\EmrSymptonController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EmrDocumentController;
use App\Http\Controllers\PreviousEmrController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\MachineryItemController;
use App\Http\Controllers\ProcedureItemController;
use App\Http\Controllers\TreatmentUnitController;
use App\Http\Controllers\ProcedurePhotoController;
use App\Http\Controllers\ProcedureTreatmentController;
use App\Http\Controllers\CountingUnitItemController;
use App\Http\Controllers\MedicineProcedureController;
use App\Http\Controllers\TreatmentUnitSaleController;
use App\Http\Controllers\CountingUnitMachineryItemController;
use App\Http\Controllers\CountingUnitProcedureItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your applicPation. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::apiResource('category', CategoryController::class);
Route::apiResource('subcategory', SubCategoryController::class);
//edit subcategory
Route::get('show-subcategory/{id}',[SubCategoryController::class,'showSubcategory']);
Route::post('updateSubcategory',[SubCategoryController::class,'updateSubcategory']);
Route::post('deleteSubcategory/{id}',[SubCategoryController::class,'delete']);

Route::apiResource('brand',BrandController::class);
Route::post('deleteBrand/{id}',[BrandController::class,'delete']);

Route::apiResource('item',ItemController::class);
//Item Search
Route::post('item-search',[ItemController::class,'search']);
Route::post('item-unit-search',[CountingUnitItemController::class,'search']);
Route::post('procedure-item-unit-search',[CountingUnitProcedureItemController::class,'search']);

Route::apiResource('item_unit',CountingUnitItemController::class);
Route::get('show-item_unit/{id}',[CountingUnitItemController::class,'showItemUnit']);
Route::post('delete-item_unit/{id}',[CountingUnitItemController::class,'deleteItemUnit']);
Route::post('delete_procedure_item_unit/{id}',[CountingUnitProcedureItemController::class,'deleteItemUnit']);



Route::apiResource('procedure_item',ProcedureItemController::class);
Route::apiResource('procedure_photo',ProcedurePhotoController::class);
//Procedure_item Search
Route::post('procedure-item-search',[ProcedureItemController::class,'search']);

Route::apiResource('counting_unit_procedure_item',CountingUnitProcedureItemController::class);
Route::apiResource('machinery_item',MachineryItemController::class);
Route::apiResource('counting_unit_machinery_item',CountingUnitMachineryItemController::class);
Route::apiResource('charge',ChargeController::class);
Route::apiResource('customer',CustomerController::class);
//Customer Search
Route::post('customer-search',[CustomerController::class,'search']);
Route::get('customer-export',[CustomerController::class,'export']);
Route::get('customer-birthday',[CustomerController::class,'customerBirthday']);
Route::get('sale-export',[SaleVoucherController::class,'export']);
Route::get('medicine-item-export',[CountingUnitItemController::class,'export']);
Route::get('procedure-item-export',[CountingUnitProcedureItemController::class,'export']);
Route::get('procedure-voucher-export',[ProcedureVoucherController::class,'export']);


Route::apiResource('treatment',TreatmentController::class);
Route::post('treatment-search',[TreatmentController::class,'search']);
Route::apiResource('treatment_unit',TreatmentUnitController::class);
Route::post('treatment-unit-search',[TreatmentUnitController::class,'search']);

Route::apiResource('treatment_procedure_item',\App\Http\Controllers\TreatmentProcedureItemController::class);
Route::apiResource('treatment_machine',\App\Http\Controllers\TreatmentMachineController::class);

Route::apiResource('treatment_unit_sale',TreatmentUnitSaleController::class);
Route::apiResource('appointment',AppointmentController::class);
Route::post('appointment_search',[AppointmentController::class, 'search']);
Route::apiResource('procedure_treatment',ProcedureTreatmentController::class);
Route::apiResource('procedure_photo',ProcedurePhotoController::class);
Route::apiResource('medicine_procedure',MedicineProcedureController::class);
Route::apiResource('previous_emr',PreviousEmrController::class);
Route::apiResource('emr_health',EmrHealthController::class);
//Route::apiResource('emr_document',EmrDocumentController::class);
Route::apiResource('sympton',SymptonController::class);
Route::apiResource('emr_sympton',EmrSymptonController::class);
Route::apiResource('employee',EmployeeController::class);
Route::apiResource('service',ServiceController::class);
Route::apiResource('transaction',\App\Http\Controllers\TransactionController::class);
Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);
Route::apiResource('package',PackageController::class);
Route::apiResource('promotion',\App\Http\Controllers\PromotionController::class);
Route::apiResource('unit_convention',\App\Http\Controllers\UnitConventionController::class);
Route::apiResource('emr_symptom',\App\Http\Controllers\EmrSymptomController::class);
Route::apiResource('purchase',\App\Http\Controllers\PurchaseController::class);
//Supplier
Route::apiResource('supplier',\App\Http\Controllers\SupplierController::class);
Route::apiResource('supplier-credit',\App\Http\Controllers\SupplierCreditController::class);
//Sale Voucher
Route::apiResource('sale_voucher',\App\Http\Controllers\SaleVoucherController::class);
//Sale Voucher Search
Route::post('sale_search_date',[\App\Http\Controllers\SaleVoucherController::class,'searchByDate']);
//Expense
Route::apiResource('expense',\App\Http\Controllers\ExpenseController::class);
Route::apiResource('income',\App\Http\Controllers\IncomeController::class);
Route::apiResource('fix_asset',\App\Http\Controllers\FixAssetController::class);
Route::apiResource('bank_account',\App\Http\Controllers\BankAccountController::class);
Route::apiResource('profitLoss',\App\Http\Controllers\ProfitLossController::class);

Route::apiResource('admin', \App\Http\Controllers\AdminDashboardController::class);
//Symptom
Route::apiResource('symptom',\App\Http\Controllers\SymptomController::class);
Route::apiResource('symptom_unit',\App\Http\Controllers\SymptomUnitController::class);

//EMR Record
Route::apiResource('health',\App\Http\Controllers\HealthConditionController::class);
Route::apiResource('medication',\App\Http\Controllers\MedicationController::class);
Route::apiResource('drug',\App\Http\Controllers\DrugController::class);
Route::apiResource('medical_history',\App\Http\Controllers\MedicalHistoryController::class);
Route::apiResource('cosmetic',\App\Http\Controllers\CosmeticDematologyController::class);
Route::apiResource('customer_emr',\App\Http\Controllers\CustomerEmrController::class);
Route::apiResource('emr_health_condition',\App\Http\Controllers\CustomerEmrHealthConditionController::class);
Route::apiResource('emr_medication',\App\Http\Controllers\CustomerEmrMddicationController::class);
Route::apiResource('emr_document',\App\Http\Controllers\CustomerEmrDocumentController::class);
Route::apiResource('member',\App\Http\Controllers\MemberController::class);
Route::apiResource('customer_emr_symptom',\App\Http\Controllers\CustomerEmrSymptomController::class);
Route::apiResource('procedure_voucher', \App\Http\Controllers\ProcedureVoucherController::class);

//History
Route::apiResource('skin_care',\App\Http\Controllers\SkinCareController::class);
//PhysicalExamination
Route::apiResource('physical_exam',\App\Http\Controllers\PhysicalExaminationController::class);
Route::apiResource('physical_exam_unit',\App\Http\Controllers\PhysicalExamUnitController::class);
Route::apiResource('skin_type',\App\Http\Controllers\SkinTypeController::class);
Route::apiResource('acne',\App\Http\Controllers\AcneController::class);
Route::apiResource('black_spot',\App\Http\Controllers\BlackSpotController::class);
Route::apiResource('meso_fat',\App\Http\Controllers\MesoFatController::class);
Route::apiResource('facial_design',\App\Http\Controllers\FacialDesignController::class);
Route::apiResource('customer_pay_credit',\App\Http\Controllers\CustomerPayCreditController::class);
Route::apiResource('kit_item',\App\Http\Controllers\KitItemController::class);
Route::apiResource('kit_unit',\App\Http\Controllers\KitUnitController::class);
Route::apiResource('auth_user',\App\Http\Controllers\AuthController::class);
Route::apiResource('test_photo',\App\Http\Controllers\TestPhotoController::class);
Route::apiResource('sale_item',\App\Http\Controllers\CountingUnitSaleController::class);

Route::apiResource('procedure_skin_care',\App\Http\Controllers\ProcedureSkinCareController::class);

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::middleware(['auth:sanctum'])->group(function (){
    Route::post('logout',[AuthController::class, 'logout']);
    Route::post('check-token',[AuthController::class, 'checkToken']);

    Route::apiResource('notification',\App\Http\Controllers\NotificationController::class);
    Route::apiResource('procedure',ProcedureController::class);

});
