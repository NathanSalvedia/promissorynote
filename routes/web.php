<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\PromissoryNoteController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SubledgerController;
use App\Http\Controllers\StatusTrackingController;
use App\Http\Controllers\PaymentHistoryController;
use App\Http\Controllers\ManageRecordsController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\PaymentTrackingController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SubledgerShowController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\SubledgerCreateController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DownpaymentController;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/auth/login', function () {
    return view('auth.login');
})->name('auth.login');

// Student routes
Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', DashboardController::class)->name('student.dashboard');
    Route::get('/student/promissory-table', [DashboardController::class, 'promissoryTable'])->name('student.promissory.table');
    Route::get('/student/promissorynote', [PromissoryNoteController::class, 'index'])->name('student.promissorynote');
    Route::post('/student/promissorynote', [PromissoryNoteController::class, 'store'])->name('promissorynotes.store');
    Route::get('/promissorynotes', [PromissoryNoteController::class, 'index'])->name('promissorynotes.index');
    Route::get('/student/promissorynote/check-status', [PromissoryNoteController::class, 'checkStatus'])->name('promissorynote.checkStatus');
    Route::get('/student/subledger', [SubledgerController::class, 'index'])->name('student.subledger');
    Route::get('/student/status-tracking', [StatusTrackingController::class, 'index'])->name('student.status-tracking');
    Route::get('/student/payment-history', [PaymentHistoryController::class, 'index'])->name('student.payment-history');
    Route::get('/student/promissorynote/view/{id}', [PromissoryNoteController::class, 'view'])->name('student.promissorynote.view');
    Route::get('/student/notification-view', [NotificationController::class, 'index'])->name('student.notification-view');
    Route::get('/student/promissorynote/{pn_id}/resubmit', [PromissoryNoteController::class, 'resubmit'])->name('student.promissorynote.resubmit');
    //Route::post('/student/promissorynote/{pn_id}/resubmit', [PromissoryNoteController::class, 'resubmit'])->name('student.promissorynote.resubmit.post');
    Route::post('/student/notifications/mark-read', [DashboardController::class, 'markNotificationsRead'])->name('student.notifications.markRead');
    Route::get('/student/attachments/{id}/download', [PromissoryNoteController::class, 'downloadAttachment'])->name('student.attachments.download');
    Route::get('/student/signature/{pn_id}', [PromissoryNoteController::class, 'viewSignature'])->name('student.signature.view');
    Route::get('/student/notifications-bell', [DashboardController::class, 'notificationsBell'])->name('student.notifications.bell');
});

// Admin login routes
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');


 Route::get('/admin', function () {
        return view('admin.admin-homepage');
    })->name('admin.home');

// Admin routes
Route::middleware(['auth', IsAdmin::class])->group(function () {

    Route::get('/admin/admindashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard-table', [AdminDashboardController::class, 'dashboardTable'])->name('admin.dashboard.table');
    Route::get('/admin/notifications', [AdminDashboardController::class, 'notifications'])->name('admin.notifications');
    Route::get('/admin/manage-record', [ManageRecordsController::class, 'index'])->name('admin.manage-record');
    Route::get('/admin/promissorynote-detail/{pn_id}', [AdminDashboardController::class, 'show'])->name('admin.promissorynote-detail');
    Route::post('/admin/promissory/approve/{pn_id}', [AdminDashboardController::class, 'approve'])->name('admin.promissory.approve');
    Route::post('/admin/promissory/reject/{pn_id}', [AdminDashboardController::class, 'reject'])->name('admin.promissory.reject');
    Route::get('/admin/manage-records', [ManageRecordsController::class, 'manageRecords'])->name('admin.manage-records');
    Route::get('/admin/promissory-table', [ManageRecordsController::class, 'promissoryTable'])->name('admin.promissory.table');
    Route::get('/admin/manage-users', [ManageUserController::class, 'index'])->name('admin.manage-users');
    Route::get('/admin/payment-tracking', [PaymentTrackingController::class, 'index'])->name('admin.payment-tracking');
    Route::post('/evaluation/{id}/approve-by-admin', [EvaluationController::class, 'approvedByAdmin'])->name('evaluation.approve-by-admin');
    Route::get('/admin/analytics', [AnalyticsController::class, 'index'])->name('admin.analytics');
    Route::get('/admin/student-subledger/{student_id}', [AdminDashboardController::class, 'StudentSubledger'])->name('admin.subledger');
    Route::get('/admin/subledger-show/{student_id}', [SubledgerShowController::class, 'index'])->name('admin.subledger-show');
    Route::get('/admin/promissorynote-show/{pn_id}', [ManageRecordsController::class, 'show'])->name('admin.promissorynotes-show');
    Route::post('/admin/promissorynotes-archive/{pn_id}/archive', [ManageRecordsController::class, 'archive'])->name('admin.promissorynotes-archive');
    Route::post('/admin/promissorynotes-restore/{pn_id}/restore', [ManageRecordsController::class, 'restore'])->name('admin.promissorynotes-restore');
    Route::get('/admin/archived-notes', [ManageRecordsController::class, 'archivedNotes'])->name('admin.archived-notes');
    Route::get('/admin/manage-record', [ManageRecordsController::class, 'manageRecord'])->name('admin.manage-record');
    Route::get('/admin/archived-notes/download/{pn_id}', [AdminDashboardController::class, 'downloadArchivedNote'])->name('admin.archived-notes.download');
    Route::post('/admin/promissorynotes/{pn_id}/record-payment', [PromissoryNoteController::class, 'recordPayment'])->name('admin.promissorynotes.recordPayment');
    Route::get('/admin/subledger-create', [SubledgerCreateController::class, 'index'])->name('admin.subledger-create');
    Route::post('/admin/subledger-create', [SubledgerCreateController::class, 'store'])->name('admin.subledger.create');
    Route::get('/admin/users/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/promissorynote/{pn_id}/deny', [AdminDashboardController::class, 'deny'])->name('admin.promissorynote.deny');
    Route::get('/admin/notifications', [AdminDashboardController::class, 'notificationsView'])->name('admin.notifications');
    Route::get('/admin/admin-notification-view', [NotificationController::class, 'index'])->name('admin.notification-view');
    Route::post('/payment-tracking/{pn_id}/record-payment', [PaymentTrackingController::class, 'recordPayment'])->name('payment-tracking.recordPayment');
    Route::post('/admin/notifications/mark-read', [AdminDashboardController::class, 'markNotificationsRead'])->name('admin.notifications.markRead');
    Route::post('/admin/notifications/mark-read-single/{id}', [AdminDashboardController::class, 'markSingleNotificationRead']);
    Route::get('/admin/signature/{pn_id}', [PromissoryNoteController::class, 'adminViewSignature'])->name('admin.signature.view');
    Route::get('/admin/attachments/download/{id}', [PromissoryNoteController::class, 'downloadAttachment'])->name('admin.attachments.download');
    Route::get('/admin/notifications-bell', [AdminDashboardController::class, 'notificationsBell'])->name('admin.notifications.bell');
    Route::get('/admin/records-table-partial', [ManageRecordsController::class, 'recordsTablePartial'])->name('admin.records-table-partial');
    Route::get('/admin/manage-users-data', [ManageUserController::class, 'userTablePartial']);
    Route::get('/admin/payment-tracking-table', [PaymentTrackingController::class, 'paymentTrackingTablePartial']);
    Route::get('/admin/analytics-data', [AnalyticsController::class, 'getAnalyticsData']);


});




//Route::get('/test-mail', function () {
   // Mail::raw('This is a test email from Laravel using Testmail.app!', function ($message) {
        //$message->to('cj2fu.test@inbox.testmail.app')
               // ->subject('Test Email');
   // });
   // return 'Test email sent!';
//});
