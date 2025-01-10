<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// Route::get('/chat', function () {
//     return view('main.ChatPage');
// });

// only guest can go to register
Route::get('/register', [HobbyController::class, 'showRegisterPage'])->middleware('guest')->name('registerPage.view');
Route::post('/register', [UserController::class, 'register'])->name('registerPage.register');

// only unpaid can go to registration payment
Route::get('/registration-payment/{user_id}', [PaymentController::class, 'showRegistrationPaymentPage'])->middleware('unpaid')->name('registrationPaymentPage.view');
Route::post('/registration-payment/{user_id}', [PaymentController::class, 'processRegistrationPayment'])->name('registrationPaymentPage.process');
Route::post('/overpaid', [PaymentController::class, 'handleOverpayment'])->name('registrationPaymentPage.overpayment');

// only guest can go to login
Route::get('/login', function() {return view('main.LoginPage');})->middleware('guest')->name('login');
Route::post('/login', [UserController::class, 'login'])->name('loginPage.login');
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth')->name('loginPage.logout');

Route::get('/', [UserController::class, 'showHomePage'])->name('homePage.view');

Route::post('/add-friend/{receiver_id}', [FriendRequestController::class, 'sendFriendRequest'])->middleware('auth')->name('homePage.send');

Route::get('/friend-request', [FriendRequestController::class, 'showFriendRequestPage'])->middleware('auth')->name('friendRequestPage.view');
Route::put('/friend-request/unsend/{receiver_id}', [FriendRequestController::class, 'unsendFriendRequest'])->middleware('auth')->name('friendRequestPage.unsend');
Route::put('/friend-request/accept/{sender_id}', [FriendRequestController::class, 'acceptFriendRequest'])->middleware('auth')->name('friendRequestPage.accept');

Route::get('/chat', [FriendRequestController::class, 'showChatPage'])->middleware('auth')->name('chatPage.view');
Route::get('/chat/{receiver_id}', [MessageController::class, 'showChatDetailPage'])->middleware('auth')->name('chatDetailPage.view');
Route::post('/chat/{receiver_id}', [MessageController::class, 'sendMessage'])->middleware('auth')->name('chatDetailPage.send');

Route::get('/notifications', [NotificationController::class, 'showNotificationPage'])->middleware('auth')->name('notificationPage.view');

Route::get('/user/{user_id}/profile', [UserController::class, 'showUserProfilePage'])->middleware('auth')->name('profilePage.view');
Route::get('/myProfile', [UserController::class, 'showMyProfilePage'])->middleware('auth')->name('myProfile.view');

Route::get('/avatar', [AvatarController::class, 'index'])->middleware('auth')->name('avatarPage.view');
Route::post('/avatar/{avatar_id}', [AvatarController::class, 'buy'])->middleware('auth')->name('avatarPage.buy');
Route::post('/useAvatar/{avatar_id}', [AvatarController::class, 'use'])->middleware('auth')->name('avatarPage.use');

Route::post('/topup', [PaymentController::class, 'topup'])->middleware('auth')->name('topUp');

Route::get('locale/{lang}', [LocalizationController::class, 'setLang'])->name('setLang');

Route::get('/search', [UserController::class, 'search'])->name('homePage.search');