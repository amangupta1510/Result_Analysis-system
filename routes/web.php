<?php

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
// route to login and logout


  Route::prefix('/admin')->group(function() {
      Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin-form');
      Route::post('login', 'Auth\AdminLoginController@attemptlogin')->name('admin-login');
      Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin-logout');
      Route::get('/dashboard', 'AdminController@index')->name('admin-dashboard');
      Route::get('/profile', 'AdminController@profile')->name('admin-profile');
      Route::get('/', 'HomeController@indexb');
     //------------------------------------------------------Results---------------------------------------------------------
     Route::get('/results/', 'AdminResultController@paperlist')->name('admin-paper_list_result');
     Route::get('/results_page/', 'AdminResultController@paperlist_page')->name('admin-paper_list_result_page');
     Route::get('/pending_response/', 'AdminResultController@pending_response')->name('admin-pending_response');
     Route::POST('/update_response/', 'AdminResultController@update_response')->name('admin-update_response');
     Route::get('/p_result', 'AdminResultController@paperresult')->name('admin-paper_result');
     Route::get('/p_result_page', 'AdminResultController@paperresult_page')->name('admin-paper_result_page');
     Route::get('/send_result_of_paper', 'AdminResultController@send_result')->name('admin-send_result');
     Route::get('/result_analysis', 'AdminResultController@result_analysis')->name('admin-result_analysis');
     Route::POST('/deleteresult', 'AdminResultController@deleteresult')->name('admin-delete_result');
     Route::get('/resultshow/', 'AdminResultController@resultshow')->name('admin-resultshow');
     Route::get('/pl_summary', 'AdminResultController@pl_summary')->name('admin-paper_link_summary');
  });
