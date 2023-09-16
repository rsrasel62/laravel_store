<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FontendController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GuestloginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\GuestLogin;
use App\Models\Tag;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//fontend
Route::get('/', [FontendController::class, 'fontend'])->name('fontend');
Route::post('/mail', [MailController::class, 'email'])->name('email');

Route::get('/category/post{category_id}', [FontendController::class, 'category_post'])->name('category.post');
Route::get('/author/post/{author_id}', [FontendController::class, 'author_post'])->name('author.post');
Route::get('/home/author/list', [FontendController::class, 'author_list'])->name('author.list');
Route::get('/home/about', [FontendController::class, 'about'])->name('about');
Route::get('/home/contact', [FontendController::class, 'contact'])->name('contact');
Route::post('/contact', [MailController::class, 'mess_contact'])->name('mess.contact');
Route::get('home/{slug}', [FontendController::class, 'details_post'])->name('details.post');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
//users

Route::get('/users', [UserController::class, 'users'])->name('users');

Route::get('/user/delete/{user_id}', [UserController::class, 'user_delete'])->name('user.delete');

Route::get('/edit/profile', [UserController::class, 'profile_edit'])->name('profile.edit');

Route::post('/profile/update', [UserController::class, 'profile_update'])->name('profile.update');

Route::post('/photo/update', [UserController::class, 'photo_update'])->name('photo.update');
Route::post('/check/delete', [UserController::class, 'check_delete'])->name('delete.check');
Route::get('/trash', [UserController::class, 'trash'])->name('trash');
Route::get('/restore/{user_id}', [UserController::class, 'restore'])->name('user.restore');
Route::get('/hard/delete/{user_id}', [UserController::class, 'hard_delete'])->name('hard.delete');
Route::post('/hard/all/delete', [UserController::class, 'hard_all_delete'])->name('all.check.delete');

//category

Route::get('/category', [CategoryController::class, 'category'])->name('category');

Route::post('/category/store', [CategoryController::class, 'category_store'])->name('category.store');

Route::get('/category/delete/{category_id}', [CategoryController::class, 'category_delete'])->name('category.delete');

Route::get('/category/edit/{category_id}', [CategoryController::class, 'category_edit'])->name('category.edit');

Route::post('/category/update', [CategoryController::class, 'category_update'])->name('category.update');

//tags
Route::get('/tags', [TagController::class, 'tag'])->name('tag');
Route::post('/tag/store', [TagController::class, 'tag_store'])->name('tag.store');
Route::get('/tag/delete/{tag_id}', [TagController::class, 'tag_delete'])->name('tag.delete');

//permission
Route::get('/role', [RoleController::class, 'role'])->name('role');
Route::post('/permission', [RoleController::class, 'permission_store'])->name('permission.store');
Route::post('/role/store', [RoleController::class, 'role_store'])->name('role.store');
Route::post('/assign/role', [RoleController::class, 'assign_role'])->name('assign.role');
Route::get('/role/remove/{user_id}', [RoleController::class, 'remove_role'])->name('remove.role');
Route::get('eidt/user/permission{user_id}', [RoleController::class, 'eidt_user_permission'])->name('eidt.user.permission');
Route::post('/update/permission', [RoleController::class, 'update_permission'])->name('update.permission');

//blog post:
Route::get('/post', [PostController::class, 'add_post'])->name('add.post');
Route::post('/blog/post/store', [PostController::class, 'post_store'])->name('post.store');
Route::get('/blog/post/view', [PostController::class, 'post'])->name('post');
Route::get('/blog/post/view/{post_id}', [PostController::class, 'view_post'])->name('view.post');
Route::get('/post/delete/{post_id}', [PostController::class, 'post_delete'])->name('post.delete');
Route::get('/post/edit/{post_id}', [PostController::class, 'post_edit'])->name('post.edit');
Route::post('/post/update}', [PostController::class, 'post_update'])->name('post.update');

Route::get('/home/add/about', [PostController::class, 'about_us'])->name('about.us');
Route::post('/add/about', [PostController::class, 'add_about'])->name('add.about');
Route::get('/about/delete/{about_id}', [PostController::class, 'delete_about'])->name('delete.us');

//guest register
Route::get('/guest/register', [GuestController::class, 'register_guest'])->name('guest.reg.me');
Route::post('/guest/store', [GuestController::class, 'guest_store'])->name('guest.store');
Route::get('/guest/login', [GuestController::class, 'login_guest'])->name('guest.login.me');

Route::post('/guest/login/req', [GuestloginController::class, 'guest_login_req'])->name('guest.login.req');
Route::get('/guest/logout', [GuestloginController::class, 'guest_logout'])->name('guest.logout');

//githubcontroller
Route::get('/github/redirect', [GithubController::class, 'github_redirect'])->name('github.redirect');
Route::get('/github/callback', [GithubController::class, 'github_callback'])->name('github.callback');

//googlecontroller
Route::get('/google/redirect', [GoogleController::class, 'github_redirect'])->name('google.redirect');
Route::get('/google/callback', [GoogleController::class, 'github_callback'])->name('google.callback');

//password Reset
Route::get('/guest/pass/reset', [GuestController::class, 'guest_pass_reset'])->name('guest.pass.reset');
Route::post('/guest/pass/reset/send', [GuestController::class, 'guest_pass_reset_send'])->name('guest.pass.reset.send');
Route::get('/guest/pass/reset/form/{token}', [GuestController::class, 'guest_pass_reset_form'])->name('guest.pass.reset.form');
Route::post('/guest/pass/reset/confirm', [GuestController::class, 'guest_pass_reset_confirm'])->name('guest.pass.reset.confirm');

//email verify
Route::get('/email/verirfy/confirm/{token}',[GuestController::class, 'email_verify'])->name('email.verify.confirm');
Route::get('/email/verirfy/req', [GuestController::class, 'email_verify_req'])->name('mail.verifi.req');
Route::post('/email/verirfy/again', [GuestController::class, 'mail_verifi_again'])->name('mail.verifi.again');

//guest acoout profile
Route::get('/guest/acccount/profile', [GuestloginController::class, 'guest_profile'])->name('guest.profile');
Route::post('/guest/acccount/profile/update', [GuestloginController::class, 'guest_profile_update'])->name('guest.profile.update');

//comment page
Route::post('/guest/comment/store', [CommentController::class, 'comment_store'])->name('comment.store');

