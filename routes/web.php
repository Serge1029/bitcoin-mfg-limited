<?php

// ************************************ ADMIN SECTION **********************************************

Route::prefix('admin')->group(function() {

  //------------ ADMIN LOGIN SECTION ------------

  Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login', 'Admin\LoginController@login')->name('admin.login.submit');
  Route::get('/forgot', 'Admin\LoginController@showForgotForm')->name('admin.forgot');
  Route::post('/forgot', 'Admin\LoginController@forgot')->name('admin.forgot.submit');
  Route::get('/logout', 'Admin\LoginController@logout')->name('admin.logout');

  //------------ ADMIN LOGIN SECTION ENDS ------------

  //------------ ADMIN NOTIFICATION SECTION ------------

  // User Notification
  Route::get('/user/notf/show', 'Admin\NotificationController@user_notf_show')->name('user-notf-show');
  Route::get('/user/notf/count','Admin\NotificationController@user_notf_count')->name('user-notf-count');
  Route::get('/user/notf/clear','Admin\NotificationController@user_notf_clear')->name('user-notf-clear');
  // User Notification Ends

  // Order Notification
  Route::get('/order/notf/show', 'Admin\NotificationController@order_notf_show')->name('order-notf-show');
  Route::get('/order/notf/count','Admin\NotificationController@order_notf_count')->name('order-notf-count');
  Route::get('/order/notf/clear','Admin\NotificationController@order_notf_clear')->name('order-notf-clear');
  // Order Notification Ends

  // Product Notification
  Route::get('/product/notf/show', 'Admin\NotificationController@product_notf_show')->name('product-notf-show');
  Route::get('/product/notf/count','Admin\NotificationController@product_notf_count')->name('product-notf-count');
  Route::get('/product/notf/clear','Admin\NotificationController@product_notf_clear')->name('product-notf-clear');
  // Product Notification Ends

  // Product Notification
  Route::get('/conv/notf/show', 'Admin\NotificationController@conv_notf_show')->name('conv-notf-show');
  Route::get('/conv/notf/count','Admin\NotificationController@conv_notf_count')->name('conv-notf-count');
  Route::get('/conv/notf/clear','Admin\NotificationController@conv_notf_clear')->name('conv-notf-clear');
  // Product Notification Ends

  //------------ ADMIN NOTIFICATION SECTION ENDS ------------

  //------------ ADMIN DASHBOARD & PROFILE SECTION ------------
  Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
  Route::get('/profile', 'Admin\DashboardController@profile')->name('admin.profile');
  Route::post('/profile/update', 'Admin\DashboardController@profileupdate')->name('admin.profile.update');
  Route::get('/password', 'Admin\DashboardController@passwordreset')->name('admin.password');  
  Route::post('/password/update', 'Admin\DashboardController@changepass')->name('admin.password.update');
  //------------ ADMIN DASHBOARD & PROFILE SECTION ENDS ------------

  //------------ ADMIN ORDER SECTION ------------
  Route::get('/orders/datatables/{slug}', 'Admin\OrderController@datatables')->name('admin-order-datatables'); //JSON REQUEST
  Route::get('/orders', 'Admin\OrderController@index')->name('admin-order-index');
  Route::get('/orders/pending', 'Admin\OrderController@pending')->name('admin-order-pending');
  Route::get('/orders/completed', 'Admin\OrderController@completed')->name('admin-order-completed');
  Route::get('/orders/declined', 'Admin\OrderController@declined')->name('admin-order-declined');
  Route::get('/order/{id}/show', 'Admin\OrderController@show')->name('admin-order-show');
  Route::get('/order/{id1}/status/{status}', 'Admin\OrderController@status')->name('admin-order-status');
  Route::post('/order/email/', 'Admin\OrderController@emailsub')->name('admin-order-emailsub');

  //------------ ADMIN USER SECTION ------------

  Route::get('/users/datatables', 'Admin\UserController@datatables')->name('admin-user-datatables'); //JSON REQUEST
  Route::get('/users', 'Admin\UserController@index')->name('admin-user-index');
  Route::get('/users/edit/{id}', 'Admin\UserController@edit')->name('admin-user-edit');
  Route::post('/users/edit/{id}', 'Admin\UserController@update')->name('admin-user-update');
  Route::get('/users/delete/{id}', 'Admin\UserController@destroy')->name('admin-user-delete');
  Route::get('/user/{id}/show', 'Admin\UserController@show')->name('admin-user-show');
  Route::get('/users/ban/{id1}/{id2}', 'Admin\UserController@ban')->name('admin-user-ban');

  Route::get('/users/withdraws/datatables', 'Admin\UserController@withdrawdatatables')->name('admin-withdraw-datatables'); //JSON REQUEST
  Route::get('/users/withdraws', 'Admin\UserController@withdraws')->name('admin-withdraw-index');
  Route::get('/user//withdraw/{id}/show', 'Admin\UserController@withdrawdetails')->name('admin-withdraw-show');
  Route::get('/users/withdraws/accept/{id}', 'Admin\UserController@accept')->name('admin-withdraw-accept');
  Route::get('/user//withdraws/reject/{id}', 'Admin\UserController@reject')->name('admin-withdraw-reject');
  // WITHDRAW SECTION ENDS

  //------------ ADMIN USER SECTION ENDS ------------

  //------------ ADMIN TRANSACTION SECTION ------------

  Route::get('/trans/datatables', 'Admin\DashboardController@transDatatables')->name('admin-trans-datatables'); //JSON REQUEST
  Route::get('/transactions', 'Admin\DashboardController@transIndex')->name('admin-trans-index'); //JSON REQUEST

  //------------ ADMIN TRANSACTION SECTION ENDS ------------



  //------------ ADMIN CATEGORY SECTION ENDS------------


  //------------ ADMIN PRODUCT SECTION ------------

  Route::get('/plans/datatables', 'Admin\ProductController@datatables')->name('admin-prod-datatables'); //JSON REQUEST
  Route::get('/plans', 'Admin\ProductController@index')->name('admin-prod-index');
  Route::get('/plans/informations', 'Admin\ProductController@info')->name('admin-prod-info');

  // CREATE SECTION
  Route::get('/plans/create', 'Admin\ProductController@create')->name('admin-prod-create');
  Route::post('/plans/store', 'Admin\ProductController@store')->name('admin-prod-store');
  // CREATE SECTION

  // EDIT SECTION
  Route::get('/plans/edit/{id}', 'Admin\ProductController@edit')->name('admin-prod-edit');  
  Route::post('/plans/edit/{id}', 'Admin\ProductController@update')->name('admin-prod-update');  
  // EDIT SECTION ENDS


  // DELETE SECTION  
  Route::get('/plans/delete/{id}', 'Admin\ProductController@destroy')->name('admin-prod-delete'); 
  // DELETE SECTION ENDS  

  //------------ ADMIN PRODUCT SECTION ENDS------------



  //------------ ADMIN BLOG SECTION ------------

  Route::get('/blog/datatables', 'Admin\BlogController@datatables')->name('admin-blog-datatables'); //JSON REQUEST
  Route::get('/blog', 'Admin\BlogController@index')->name('admin-blog-index');
  Route::get('/blog/create', 'Admin\BlogController@create')->name('admin-blog-create');
  Route::post('/blog/create', 'Admin\BlogController@store')->name('admin-blog-store');
  Route::get('/blog/edit/{id}', 'Admin\BlogController@edit')->name('admin-blog-edit');
  Route::post('/blog/edit/{id}', 'Admin\BlogController@update')->name('admin-blog-update');  
  Route::get('/blog/delete/{id}', 'Admin\BlogController@destroy')->name('admin-blog-delete'); 
  
  Route::get('/blog/category/datatables', 'Admin\BlogCategoryController@datatables')->name('admin-cblog-datatables'); //JSON REQUEST
  Route::get('/blog/category', 'Admin\BlogCategoryController@index')->name('admin-cblog-index');
  Route::get('/blog/category/create', 'Admin\BlogCategoryController@create')->name('admin-cblog-create');
  Route::post('/blog/category/create', 'Admin\BlogCategoryController@store')->name('admin-cblog-store');
  Route::get('/blog/category/edit/{id}', 'Admin\BlogCategoryController@edit')->name('admin-cblog-edit');
  Route::post('/blog/category/edit/{id}', 'Admin\BlogCategoryController@update')->name('admin-cblog-update');  
  Route::get('/blog/category/delete/{id}', 'Admin\BlogCategoryController@destroy')->name('admin-cblog-delete'); 

  //------------ ADMIN BLOG SECTION ENDS ------------

  //------------ ADMIN USER MESSAGE SECTION ------------

  Route::get('/messages/datatables', 'Admin\MessageController@datatables')->name('admin-message-datatables');
  Route::get('/messages', 'Admin\MessageController@index')->name('admin-message-index');
  Route::get('/message/{id}', 'Admin\MessageController@message')->name('admin-message-show');
  Route::get('/message/load/{id}', 'Admin\MessageController@messageshow')->name('admin-message-load');
  Route::post('/message/post', 'Admin\MessageController@postmessage')->name('admin-message-store');
  Route::get('/message/{id}/delete', 'Admin\MessageController@messagedelete')->name('admin-message-delete');   
  Route::post('/user/send/message', 'Admin\MessageController@usercontact')->name('admin-send-message');

  //------------ ADMIN USER MESSAGE SECTION ENDS ------------

  //------------ ADMIN SLIDER SECTION ------------

  Route::get('/slider/datatables', 'Admin\SliderController@datatables')->name('admin-sl-datatables'); //JSON REQUEST
  Route::get('/slider', 'Admin\SliderController@index')->name('admin-sl-index');
  Route::get('/slider/create', 'Admin\SliderController@create')->name('admin-sl-create');
  Route::post('/slider/create', 'Admin\SliderController@store')->name('admin-sl-store');
  Route::get('/slider/edit/{id}', 'Admin\SliderController@edit')->name('admin-sl-edit');
  Route::post('/slider/edit/{id}', 'Admin\SliderController@update')->name('admin-sl-update');  
  Route::get('/slider/delete/{id}', 'Admin\SliderController@destroy')->name('admin-sl-delete'); 

  //------------ ADMIN SLIDER SECTION ENDS ------------

  //------------ ADMIN SERVICE SECTION ------------

  Route::get('/service/datatables', 'Admin\ServiceController@datatables')->name('admin-service-datatables'); //JSON REQUEST
  Route::get('/service', 'Admin\ServiceController@index')->name('admin-service-index');
  Route::get('/service/create', 'Admin\ServiceController@create')->name('admin-service-create');
  Route::post('/service/create', 'Admin\ServiceController@store')->name('admin-service-store');
  Route::get('/service/edit/{id}', 'Admin\ServiceController@edit')->name('admin-service-edit');
  Route::post('/service/edit/{id}', 'Admin\ServiceController@update')->name('admin-service-update');  
  Route::get('/service/delete/{id}', 'Admin\ServiceController@destroy')->name('admin-service-delete'); 

  //------------ ADMIN SERVICE SECTION ENDS ------------


  //------------ ADMIN PORTFOLIO SECTION ------------

Route::get('/portfolio/datatables', 'Admin\PortfolioController@datatables')->name('admin-portfolio-datatables');
Route::get('/portfolio', 'Admin\PortfolioController@index')->name('admin-portfolio-index');
Route::get('/portfolio/create', 'Admin\PortfolioController@create')->name('admin-portfolio-create');
Route::post('/portfolio/create', 'Admin\PortfolioController@store')->name('admin-portfolio-store');
Route::get('/portfolio/edit/{id}', 'Admin\PortfolioController@edit')->name('admin-portfolio-edit');
Route::post('/portfolio/edit/{id}', 'Admin\PortfolioController@update')->name('admin-portfolio-update');
Route::get('/portfolio/delete/{id}', 'Admin\PortfolioController@destroy')->name('admin-portfolio-delete');

  //------------ ADMIN PORTFOLIO SECTION ENDS ------------


  //------------ ADMIN MEMBER SECTION ------------

Route::get('/member/datatables', 'Admin\MemberController@datatables')->name('admin-member-datatables');
Route::get('/member', 'Admin\MemberController@index')->name('admin-member-index');
Route::get('/member/create', 'Admin\MemberController@create')->name('admin-member-create');
Route::post('/member/create', 'Admin\MemberController@store')->name('admin-member-store');
Route::get('/member/edit/{id}', 'Admin\MemberController@edit')->name('admin-member-edit');
Route::post('/member/edit/{id}', 'Admin\MemberController@update')->name('admin-member-update');
Route::get('/member/delete/{id}', 'Admin\MemberController@destroy')->name('admin-member-delete');

  //------------ ADMIN MEMBER SECTION ENDS ------------




  //------------ ADMIN PRESENTATION SECTION ------------

Route::get('/vpresentation/datatables', 'Admin\VpresentationController@datatables')->name('admin-vpresentation-datatables');
Route::get('/vpresentation', 'Admin\VpresentationController@index')->name('admin-vpresentation-index');
Route::get('/vpresentation/create', 'Admin\VpresentationController@create')->name('admin-vpresentation-create');
Route::post('/vpresentation/create', 'Admin\VpresentationController@store')->name('admin-vpresentation-store');
Route::get('/vpresentation/edit/{id}', 'Admin\VpresentationController@edit')->name('admin-vpresentation-edit');
Route::post('/vpresentation/edit/{id}', 'Admin\VpresentationController@update')->name('admin-vpresentation-update');
Route::get('/vpresentation/delete/{id}', 'Admin\VpresentationController@destroy')->name('admin-vpresentation-delete');


  //------------ ADMIN PRESENTATION SECTION ENDS ------------

  //------------ ADMIN REVIEW SECTION ------------

  Route::get('/review/datatables', 'Admin\ReviewController@datatables')->name('admin-review-datatables'); //JSON REQUEST
  Route::get('/review', 'Admin\ReviewController@index')->name('admin-review-index');
  Route::get('/review/create', 'Admin\ReviewController@create')->name('admin-review-create');
  Route::post('/review/create', 'Admin\ReviewController@store')->name('admin-review-store');
  Route::get('/review/edit/{id}', 'Admin\ReviewController@edit')->name('admin-review-edit');
  Route::post('/review/edit/{id}', 'Admin\ReviewController@update')->name('admin-review-update');  
  Route::get('/review/delete/{id}', 'Admin\ReviewController@destroy')->name('admin-review-delete'); 

  //------------ ADMIN REVIEW SECTION ENDS ------------

  //------------ ADMIN GENERAL SETTINGS SECTION ------------

  Route::get('/general-settings/logo', 'Admin\GeneralSettingController@logo')->name('admin-gs-logo');
  Route::get('/general-settings/favicon', 'Admin\GeneralSettingController@fav')->name('admin-gs-fav');
  Route::get('/general-settings/loader', 'Admin\GeneralSettingController@load')->name('admin-gs-load');
  Route::get('/general-settings/banner', 'Admin\GeneralSettingController@banner')->name('admin-gs-banner');
  Route::get('/general-settings/service', 'Admin\GeneralSettingController@service')->name('admin-gs-service');
  Route::get('/general-settings/contents', 'Admin\GeneralSettingController@contents')->name('admin-gs-contents');
  Route::get('/general-settings/footer', 'Admin\GeneralSettingController@footer')->name('admin-gs-footer');
  Route::get('/general-settings/error', 'Admin\GeneralSettingController@error')->name('admin-gs-error');
  Route::get('/general-settings/breadcumb', 'Admin\GeneralSettingController@breadcumb')->name('admin-gs-breadcumb');
  Route::get('/general-settings/affilate', 'Admin\GeneralSettingController@affilate')->name('admin-gs-affilate');

  
  Route::group(['middleware'=>'admininistrator'],function(){

  //------------ ADMIN GENERAL SETTINGS JSON SECTION ------------

  // General Setting Section

  Route::get('/general-settings/disqus/{status}', 'Admin\GeneralSettingController@isdisqus')->name('admin-gs-isdisqus'); 
  Route::get('/general-settings/admin/loader/{status}', 'Admin\GeneralSettingController@isadminloader')->name('admin-gs-is-admin-loader'); 
  Route::get('/general-settings/loader/{status}', 'Admin\GeneralSettingController@isloader')->name('admin-gs-isloader'); 
  Route::get('/general-settings/talkto/{status}', 'Admin\GeneralSettingController@talkto')->name('admin-gs-talkto');

  // Payment Setting Section

  Route::get('/general-settings/guest/{status}', 'Admin\GeneralSettingController@guest')->name('admin-gs-guest');
  Route::get('/general-settings/paypal/{status}', 'Admin\GeneralSettingController@paypal')->name('admin-gs-paypal');
  Route::get('/general-settings/stripe/{status}', 'Admin\GeneralSettingController@stripe')->name('admin-gs-stripe');
  Route::get('/general-settings/blockchain/{status}', 'Admin\GeneralSettingController@blockchain')->name('admin-gs-blockchain');
  Route::get('/general-settings/coinpayment/{status}', 'Admin\GeneralSettingController@coinpayment')->name('admin-gs-coinpayment');
  Route::get('/general-settings/gateways/{status}/{column}', 'Admin\GeneralSettingController@gatewayStatus')->name('admin-gs-gatewaysts');
  Route::get('/general-settings/cod/{status}', 'Admin\GeneralSettingController@cod')->name('admin-gs-cod');

  //  Comment Section

  Route::get('/general-settings/comment/{status}', 'Admin\GeneralSettingController@comment')->name('admin-gs-iscomment'); 


  //  Language Section

  Route::get('/general-settings/language/{status}', 'Admin\GeneralSettingController@language')->name('admin-gs-islanguage'); 

  //  Currency Section

  Route::get('/general-settings/currency/{status}', 'Admin\GeneralSettingController@currency')->name('admin-gs-iscurrency'); 

  //  Affilte Section

  Route::get('/general-settings/affilate/{status}', 'Admin\GeneralSettingController@isaffilate')->name('admin-gs-isaffilate'); 

  Route::get('/general-settings/email-verify/{status}', 'Admin\GeneralSettingController@isemailverify')->name('admin-gs-is-email-verify'); 

  //------------ ADMIN GENERAL SETTINGS JSON SECTION ENDS------------

  Route::post('/general-settings/update/all', 'Admin\GeneralSettingController@generalupdate')->name('admin-gs-update');

  //------------ ADMIN GENERAL SETTINGS SECTION ENDS ------------

});

  //------------ ADMIN FAQ SECTION ------------

  Route::get('/faq/datatables', 'Admin\FaqController@datatables')->name('admin-faq-datatables'); //JSON REQUEST
  Route::get('/faq', 'Admin\FaqController@index')->name('admin-faq-index');
  Route::get('/faq/create', 'Admin\FaqController@create')->name('admin-faq-create');
  Route::post('/faq/create', 'Admin\FaqController@store')->name('admin-faq-store');
  Route::get('/faq/edit/{id}', 'Admin\FaqController@edit')->name('admin-faq-edit');
  Route::post('/faq/update/{id}', 'Admin\FaqController@update')->name('admin-faq-update');
  Route::get('/faq/delete/{id}', 'Admin\FaqController@destroy')->name('admin-faq-delete');

  //------------ ADMIN FAQ SECTION ENDS ------------


  //------------ ADMIN FEATURE SECTION ------------

  Route::get('/feature/datatables', 'Admin\FeatureController@datatables')->name('admin-feature-datatables'); //JSON REQUEST
  Route::get('/feature', 'Admin\FeatureController@index')->name('admin-feature-index');
  Route::get('/feature/create', 'Admin\FeatureController@create')->name('admin-feature-create');
  Route::post('/feature/create', 'Admin\FeatureController@store')->name('admin-feature-store');
  Route::get('/feature/edit/{id}', 'Admin\FeatureController@edit')->name('admin-feature-edit');
  Route::post('/feature/update/{id}', 'Admin\FeatureController@update')->name('admin-feature-update');
  Route::get('/feature/delete/{id}', 'Admin\FeatureController@destroy')->name('admin-feature-delete');

  //------------ ADMIN FEATURE SECTION ENDS ------------


  //------------ ADMIN PAGE SETTINGS SECTION ------------
// Page Setting Section

  Route::get('/general-settings/contact/{status}', 'Admin\GeneralSettingController@iscontact')->name('admin-gs-iscontact');
  Route::get('/general-settings/faq/{status}', 'Admin\GeneralSettingController@isfaq')->name('admin-gs-isfaq'); 

  Route::get('/page-settings/transaction', 'Admin\PageSettingController@trans')->name('admin-ps-trans');
  Route::get('/page-settings/banner', 'Admin\PageSettingController@banner')->name('admin-ps-banner');
  Route::get('/page-settings/contact', 'Admin\PageSettingController@contact')->name('admin-ps-contact');
  Route::get('/page-settings/customize', 'Admin\PageSettingController@customize')->name('admin-ps-customize');
  Route::get('/page-settings/big-save', 'Admin\PageSettingController@big_save')->name('admin-ps-big-save');
  Route::get('/page-settings/best-seller', 'Admin\PageSettingController@best_seller')->name('admin-ps-best-seller');
  Route::get('/page-settings/video', 'Admin\PageSettingController@video')->name('admin-ps-video');
  Route::get('/page-settings/blog', 'Admin\PageSettingController@blog')->name('admin-ps-blog');
  Route::get('/page-settings/homecontact', 'Admin\PageSettingController@homecontact')->name('admin-ps-homecontact');
  Route::post('/page-settings/update/all', 'Admin\PageSettingController@update')->name('admin-ps-update');
  Route::post('/page-settings/update/home', 'Admin\PageSettingController@homeupdate')->name('admin-ps-homeupdate');
  //------------ ADMIN PAGE SETTINGS SECTION ENDS ------------

  //------------ ADMIN PAGE SECTION ------------  

  Route::get('/page/datatables', 'Admin\PageController@datatables')->name('admin-page-datatables'); //JSON REQUEST
  Route::get('/page', 'Admin\PageController@index')->name('admin-page-index');
  Route::get('/page/create', 'Admin\PageController@create')->name('admin-page-create');
  Route::post('/page/create', 'Admin\PageController@store')->name('admin-page-store');
  Route::get('/page/edit/{id}', 'Admin\PageController@edit')->name('admin-page-edit');
  Route::post('/page/update/{id}', 'Admin\PageController@update')->name('admin-page-update');
  Route::get('/page/delete/{id}', 'Admin\PageController@destroy')->name('admin-page-delete');
  Route::get('/page/header/{id1}/{id2}', 'Admin\PageController@header')->name('admin-page-header');
  Route::get('/page/footer/{id1}/{id2}', 'Admin\PageController@footer')->name('admin-page-footer');

  //------------ ADMIN PAGE SECTION ENDS------------  

  Route::group(['middleware'=>'admininistrator'],function(){

  //------------ ADMIN EMAIL SETTINGS SECTION ------------
  Route::get('/email-templates/datatables', 'Admin\EmailController@datatables')->name('admin-mail-datatables');
  Route::get('/email-templates', 'Admin\EmailController@index')->name('admin-mail-index');
  Route::get('/email-templates/{id}', 'Admin\EmailController@edit')->name('admin-mail-edit');
  Route::post('/email-templates/{id}', 'Admin\EmailController@update')->name('admin-mail-update');
  Route::get('/email-config', 'Admin\EmailController@config')->name('admin-mail-config');
  Route::get('/groupemail', 'Admin\EmailController@groupemail')->name('admin-group-show');
  Route::post('/groupemailpost', 'Admin\EmailController@groupemailpost')->name('admin-group-submit');
  Route::get('/issmtp/{status}', 'Admin\GeneralSettingController@issmtp')->name('admin-gs-issmtp');

  //------------ ADMIN EMAIL SETTINGS SECTION ENDS ------------

  //------------ ADMIN PAYMENT SETTINGS SECTION ------------

// Payment Informations  

  Route::get('/payment-informations', 'Admin\GeneralSettingController@paymentsinfo')->name('admin-gs-payments');


// Currency Settings

  Route::get('/general-settings/set-currency', 'Admin\GeneralSettingController@currency')->name('admin-gs-currency');


  //------------ ADMIN PAYMENT SETTINGS SECTION ENDS------------

  //------------ ADMIN SOCIAL SETTINGS SECTION ------------

  Route::get('/social', 'Admin\SocialSettingController@index')->name('admin-social-index');
  Route::post('/social/update', 'Admin\SocialSettingController@socialupdate')->name('admin-social-update');
  Route::post('/social/update/all', 'Admin\SocialSettingController@socialupdateall')->name('admin-social-update-all');
  Route::get('/social/facebook', 'Admin\SocialSettingController@facebook')->name('admin-social-facebook');
  Route::get('/social/google', 'Admin\SocialSettingController@google')->name('admin-social-google');
  Route::get('/social/facebook/{status}', 'Admin\SocialSettingController@facebookup')->name('admin-social-facebookup');
  Route::get('/social/google/{status}', 'Admin\SocialSettingController@googleup')->name('admin-social-googleup');



  //------------ ADMIN SOCIAL SETTINGS SECTION ENDS------------

  //------------ ADMIN LANGUAGE SETTINGS SECTION ------------

  Route::get('/languages/datatables', 'Admin\LanguageController@datatables')->name('admin-lang-datatables'); //JSON REQUEST
  Route::get('/languages', 'Admin\LanguageController@index')->name('admin-lang-index');
  Route::get('/languages/create', 'Admin\LanguageController@create')->name('admin-lang-create');
  Route::get('/languages/edit/{id}', 'Admin\LanguageController@edit')->name('admin-lang-edit');
  Route::post('/languages/create', 'Admin\LanguageController@store')->name('admin-lang-store');
  Route::post('/languages/edit/{id}', 'Admin\LanguageController@update')->name('admin-lang-update');
  Route::get('/languages/status/{id1}/{id2}', 'Admin\LanguageController@status')->name('admin-lang-st');
  Route::get('/languages/delete/{id}', 'Admin\LanguageController@destroy')->name('admin-lang-delete');

  //------------ ADMIN LANGUAGE SETTINGS SECTION ENDS ------------

  //------------ ADMIN SEOTOOL SETTINGS SECTION ------------

  Route::get('/seotools/analytics', 'Admin\SeoToolController@analytics')->name('admin-seotool-analytics');
  Route::post('/seotools/analytics/update', 'Admin\SeoToolController@analyticsupdate')->name('admin-seotool-analytics-update');
  Route::get('/seotools/keywords', 'Admin\SeoToolController@keywords')->name('admin-seotool-keywords');
  Route::post('/seotools/keywords/update', 'Admin\SeoToolController@keywordsupdate')->name('admin-seotool-keywords-update');
  Route::get('/products/popular/{id}','Admin\SeoToolController@popular')->name('admin-prod-popular');
  //------------ ADMIN SEOTOOL SETTINGS SECTION ------------

  //------------ STAFF SECTION ------------
  Route::get('/staff/datatables', 'Admin\StaffController@datatables')->name('admin-staff-datatables');
  Route::get('/staff', 'Admin\StaffController@index')->name('admin-staff-index');
  Route::get('/staff/create', 'Admin\StaffController@create')->name('admin-staff-create');
  Route::post('/staff/create', 'Admin\StaffController@store')->name('admin-staff-store');
  Route::get('/staff/edit/{id}', 'Admin\StaffController@show')->name('admin-staff-show'); 
  Route::get('/staff/delete/{id}', 'Admin\StaffController@destroy')->name('admin-staff-delete'); 

  //------------ STAFF SECTION ENDS------------


});
  //------------ ADMIN SUBSCRIBERS SECTION ------------

  Route::get('/subscribers/datatables', 'Admin\SubscriberController@datatables')->name('admin-subs-datatables'); //JSON REQUEST
  Route::get('/subscribers', 'Admin\SubscriberController@index')->name('admin-subs-index');
  Route::get('/subscribers/download', 'Admin\SubscriberController@download')->name('admin-subs-download');  

  //------------ ADMIN SUBSCRIBERS ENDS ------------

});


Route::get('admin/check/movescript', 'Admin\DashboardController@movescript')->name('admin-move-script');
Route::get('admin/generate/backup', 'Admin\DashboardController@generate_bkup')->name('admin-generate-backup');
Route::get('admin/activation', 'Admin\DashboardController@activation')->name('admin-activation-form');
Route::post('admin/activation', 'Admin\DashboardController@activation_submit')->name('admin-activate-purchase');
Route::get('admin/clear/backup', 'Admin\DashboardController@clear_bkup')->name('admin-clear-backup');

Route::post('the/genius/ocean/2441139', 'Front\FrontendController@subscription');
Route::get('finalize', 'Front\FrontendController@finalize');
// ************************************ ADMIN SECTION ENDS**********************************************


// ************************************ USER SECTION **********************************************

Route::prefix('user')->group(function() {

  // User Dashboard
  Route::get('/dashboard', 'User\UserController@index')->name('user-dashboard');
  Route::get('/transactions', 'User\UserController@trans')->name('user-trans'); 
  // User Login
  
  Route::get('/login', 'User\LoginController@showLoginForm')->name('user.login');
  Route::post('/login', 'User\LoginController@login')->name('user.login.submit');
  // User Login End

  // User Register
  Route::post('/register', 'User\RegisterController@register')->name('user-register-submit');
  Route::get('/register/verify/{token}', 'User\RegisterController@token')->name('user-register-token');  
  // User Register End

  // User Reset 
  Route::get('/reset', 'User\UserController@resetform')->name('user-reset');
  Route::post('/reset', 'User\UserController@reset')->name('user-reset-submit');
  // User Reset End

  // User Profile 
  Route::get('/profile', 'User\UserController@profile')->name('user-profile'); 
  Route::post('/profile', 'User\UserController@profileupdate')->name('user-profile-update'); 
  // User Profile Ends

  // User Forgot
  Route::get('/forgot', 'User\ForgotController@showforgotform')->name('user-forgot');
  Route::post('/forgot', 'User\ForgotController@forgot')->name('user-forgot-submit');  
  // User Forgot Ends

  // Witdraw Section
  Route::get('/withdraw', 'User\WithdrawController@index')->name('user-wwt-index');
  Route::get('/withdraw/create', 'User\WithdrawController@create')->name('user-wwt-create');
  Route::post('/withdraw/create', 'User\WithdrawController@store')->name('user-wwt-store');
  // Witdraw Section Ends

// User Orders

  Route::get('/invests', 'User\OrderController@orders')->name('user-invests'); 
  Route::get('/investment/{id}', 'User\OrderController@order')->name('user-order');
  Route::get('/payouts', 'User\OrderController@payouts')->name('user-payouts'); 


// User Orders Ends


//Choose Plan

  Route::get('/plan','User\PlanController@planChoose')->name('user.plan');

//Choose Plan Ends


  Route::get('/affilate/code', 'User\UserController@affilate_code')->name('user-affilate-code');

  // User Notification

  Route::get('/notf/show', 'User\NotificationController@user_notf_show')->name('customer-notf-show');
  Route::get('/notf/count','User\NotificationController@user_notf_count')->name('customer-notf-count');
  Route::get('/notf/clear','User\NotificationController@user_notf_clear')->name('customer-notf-clear');

  // User Notification Ends




// User Admin Send Message

  Route::get('admin/messages', 'User\MessageController@adminmessages')->name('user-message-index');
  Route::get('admin/message/{id}', 'User\MessageController@adminmessage')->name('user-message-show');
  Route::post('admin/message/post', 'User\MessageController@adminpostmessage')->name('user-message-store');
  Route::get('admin/message/{id}/delete', 'User\MessageController@adminmessagedelete')->name('user-message-delete1');   
  Route::post('admin/user/send/message', 'User\MessageController@adminusercontact')->name('user-send-message');
  Route::get('admin/message/load/{id}', 'User\MessageController@messageload')->name('user-message-load');
// User Admin Send Message Ends

  // User Logout
  Route::get('/logout', 'User\LoginController@logout')->name('user-logout');
  // User Logout Ends

});

// ************************************ USER SECTION ENDS**********************************************



// ************************************ FRONT SECTION **********************************************

  Route::get('/', 'Front\FrontendController@index')->name('front.index');
  Route::get('/crypto/setdata', 'Front\FrontendController@setdata')->name('front.setdata');
  Route::get('/currency/{id}', 'Front\FrontendController@iscurrency')->name('front.currency');
  Route::get('/language/{id}', 'Front\FrontendController@language')->name('front.language');

  // BLOG SECTION
  Route::get('/blog','Front\FrontendController@blog')->name('front.blog');
  Route::get('/blog/{id}','Front\FrontendController@blogshow')->name('front.blogshow');
  Route::get('/blog/category/{slug}','Front\FrontendController@blogcategory')->name('front.blogcategory');
  Route::get('/blog/tag/{slug}','Front\FrontendController@blogtags')->name('front.blogtags');  
  Route::get('/blog-search','Front\FrontendController@blogsearch')->name('front.blogsearch');
  Route::get('/blog/archive/{slug}','Front\FrontendController@blogarchive')->name('front.blogarchive');
  // BLOG SECTION ENDS

  // FAQ SECTION  
  Route::get('/faq','Front\FrontendController@faq')->name('front.faq');
  // FAQ SECTION ENDS

  // CONTACT SECTION  
  Route::get('/contact','Front\FrontendController@contact')->name('front.contact');
  Route::post('/contact','Front\FrontendController@contactemail')->name('front.contact.submit');
  Route::get('/contact/refresh_code','Front\FrontendController@refresh_code');
  // CONTACT SECTION  ENDS



  // CHECKOUT SECTION  
  Route::get('/order/{id}','Front\CheckoutController@checkout')->name('front.checkout');
  Route::get('/order/payment/return', 'Front\PaymentController@payreturn')->name('payment.return');
  Route::get('/order/payment/cancle', 'Front\PaymentController@paycancle')->name('payment.cancle');
  Route::post('/order/payment/notify', 'Front\PaymentController@notify')->name('payment.notify');

  Route::post('/paypal-submit', 'Front\PaymentController@store')->name('paypal.submit');
  Route::post('/stripe-submit', 'Front\StripeController@store')->name('stripe.submit');

Route::post('/blockchain-submit', 'Front\BlockChainController@deposit')->name('blockchain.submit');
Route::post('/blockchain/notify', 'Front\BlockChainController@chaincallback')->name('blockchain.notify');
Route::get('/invest/bitcoin', 'Front\BlockChainController@blockInvest')->name('blockchain.invest');

Route::post('/coinpay-submit', 'Front\CoinPaymentController@deposit')->name('coinpay.submit');
Route::post('/coinpay/notify', 'Front\CoinPaymentController@coincallback')->name('coinpay.notify');
Route::get('/invest/coinpay', 'Front\CoinPaymentController@blockInvest')->name('coinpay.invest');

Route::post('/blockio-submit', 'Front\BlockIOController@deposit')->name('blockio.submit');
Route::post('/blockio/notify', 'Front\BlockIOController@blockiocallback')->name('blockio.notify');
Route::get('/invest/blockio', 'Front\BlockIOController@blockioInvest')->name('blockio.invest');

Route::post('/vougepay-submit', 'Front\VougePayController@deposit')->name('vougepay.submit');
Route::post('/vougepay/notify', 'Front\VougePayController@vougePaycallback')->name('vougepay.notify');

Route::post('/coingate-submit', 'Front\CoinGateController@deposit')->name('coingate.submit');
Route::post('/coingate/notify', 'Front\CoinGateController@coingetCallback')->name('coingate.notify');
  // CHECKOUT SECTION ENDS

  // SUBSCRIBE SECTION

  Route::post('/subscriber/store', 'Front\FrontendController@subscribe')->name('front.subscribe');

  // SUBSCRIBE SECTION ENDS
  
  // LOGIN WITH FACEBOOK OR GOOGLE SECTION  
  Route::get('auth/{provider}', 'User\SocialRegisterController@redirectToProvider')->name('social-provider');
  Route::get('auth/{provider}/callback', 'User\SocialRegisterController@handleProviderCallback');
  // LOGIN WITH FACEBOOK OR GOOGLE SECTION ENDS

// CRON JOB LINK
  Route::get('users/payments/double', 'Front\FrontendController@payDouble');
// CRON JOB LINK ENDS

  // PAGE SECTION
  Route::get('/{slug}','Front\FrontendController@page')->name('front.page');
  // PAGE SECTION ENDS
  


  
// ************************************ FRONT SECTION ENDS**********************************************
