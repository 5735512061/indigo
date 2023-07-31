<?php


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE';
});

Route::get('locale/{locale}',function($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});


// ลงทะเบียนแอดมิน
Route::get('/register','Auth\RegisterController@ShowRegisterForm');
Route::post('/register','Auth\RegisterController@register');

Route::group(['prefix' => ''], function(){
    Route::get('/','Frontend\\FrontendsController@index');
    Route::get('/about-us','Frontend\\FrontendsController@aboutUs');
    Route::get('/contact-us','Frontend\\FrontendsController@contactUs');
    Route::get('/promotion','Frontend\\FrontendsController@promotion');
    Route::get('/promotion-information/{id}','Frontend\\FrontendsController@promotionInformation');
    Route::get('/article-review','Frontend\\FrontendsController@articleReview');
    Route::get('/article-information/{id}','Frontend\\FrontendsController@articleInformation');
    Route::get('/package-tour/{type}','Frontend\\FrontendsController@packageTour');
    Route::get('/package-tour-information/{id}','Frontend\\FrontendsController@packageTourInformation');
});

// admin
Route::group(['prefix' => 'admin'], function(){
    // เข้าสู่ระบบแอดมิน
    Route::get('/login','Auth\LoginController@ShowLoginForm')->name('admin.login');
    Route::post('/login','Auth\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');

    Route::get('/change-password', 'Backend\ChangePasswordController@changePasswordIndex')->name('password.change');
    Route::post('/change-password', 'Backend\ChangePasswordController@changePassword')->name('password.update');
    Route::get('/change-profile/{id}', 'Backend\AdminsController@changeProfileIndex');
    Route::post('/change-profile', 'Backend\AdminsController@changeProfile');

    Route::get('/image-slide', 'Backend\AdminsController@imageSlide')->name('admin.home');
    Route::get('/create-slide', 'Backend\AdminsController@createSlide');
    Route::post('/create-slide', 'Backend\AdminsController@createSlidePost');
    Route::get('/slide-delete/{id}','Backend\\AdminsController@slideDelete');
    Route::post('/update-slide', 'Backend\AdminsController@updateSlide');

    Route::get('/image-logo', 'Backend\AdminsController@imageLogo');
    Route::get('/create-logo', 'Backend\AdminsController@createLogo');
    Route::post('/create-logo', 'Backend\AdminsController@createLogoPost');
    Route::get('/logo-delete/{id}','Backend\\AdminsController@logoDelete');
    Route::post('/update-logo', 'Backend\AdminsController@updateLogo');

    Route::get('/image-link', 'Backend\AdminsController@imageLink');
    Route::post('/create-image-link', 'Backend\AdminsController@imageLinkPost');

    Route::get('/contact', 'Backend\AdminsController@contact');
    Route::post('/create-contact', 'Backend\AdminsController@createContact');

    Route::get('/promotion', 'Backend\AdminsController@promotion');
    Route::get('/create-promotion', 'Backend\AdminsController@createPromotion');
    Route::post('/create-promotion', 'Backend\AdminsController@createPromotionPost');
    Route::get('/promotion-delete/{id}','Backend\\AdminsController@promotionDelete');
    Route::get('/promotion-image-multi-information/{id}','Backend\\AdminsController@promotionImageMultiInfor');
    Route::post('/update-promotion','Backend\\AdminsController@updatePromotion');
    Route::post('/update-promotion-image-multi','Backend\\AdminsController@updatePromotionImageMulti');
    Route::post('/upload-promotion-image-multi','Backend\\AdminsController@uploadPromotionImageMulti');
    Route::get('/promotion-image-multi-delete/{id}','Backend\\AdminsController@promotionImageMultiDelete');

    Route::get('/article', 'Backend\AdminsController@article')->name('admin.home');
    Route::get('/create-article', 'Backend\AdminsController@createArticle');
    Route::post('/create-article', 'Backend\AdminsController@createArticlePost');
    Route::get('/article-delete/{id}','Backend\\AdminsController@articleDelete');
    Route::get('/article-image-multi-information/{id}','Backend\\AdminsController@articleImageMultiInfor');
    Route::post('/update-article','Backend\\AdminsController@updateArticle');
    Route::post('/update-article-image-multi','Backend\\AdminsController@updateArticleImageMulti');
    Route::get('/edit-article/{id}','Backend\\AdminsController@editArticle');
    Route::post('/edit-article','Backend\\AdminsController@updateArticlePost');
    Route::post('/upload-article-image-multi','Backend\\AdminsController@uploadArticleImageMulti');
    Route::get('/article-image-multi-delete/{id}','Backend\\AdminsController@articleImageMultiDelete');

    Route::get('/review', 'Backend\AdminsController@review');
    Route::get('/create-review', 'Backend\AdminsController@createReview');
    Route::post('/create-review', 'Backend\AdminsController@createReviewPost');
    Route::get('/review-delete/{id}','Backend\\AdminsController@reviewDelete');
    Route::post('/update-review','Backend\\AdminsController@updateReview');

    Route::get('/manage-tour-type', 'Backend\AdminsController@manageTourType');
    Route::post('/create-tour-type', 'Backend\AdminsController@createTourType');
    Route::get('/tour-type-delete/{id}','Backend\\AdminsController@tourTypeDelete');
    Route::post('/update-tour-type','Backend\\AdminsController@updateTourType');

    Route::get('/tour', 'Backend\AdminsController@tour');
    Route::get('/create-tour', 'Backend\AdminsController@createTour');
    Route::post('/create-tour', 'Backend\AdminsController@createTourPost');
    Route::get('/tour-delete/{id}','Backend\\AdminsController@tourDelete');
    Route::get('/tour-image-multi-information/{id}','Backend\\AdminsController@tourImageMultiInfor');
    Route::post('/update-tour','Backend\\AdminsController@updateTour');
    Route::post('/update-tour-image-multi','Backend\\AdminsController@updateTourImageMulti');
    Route::post('/upload-tour-image-multi','Backend\\AdminsController@uploadTourImageMulti');
    Route::get('/tour-image-multi-delete/{id}','Backend\\AdminsController@tourImageMultiDelete');

    Route::get('/tour-price', 'Backend\AdminsController@tourPrice');
    Route::post('/update-tour-price', 'Backend\AdminsController@updateTourPrice');
    Route::post('/update-tour-price-promotion', 'Backend\AdminsController@updateTourPricePromotion');
    Route::get('/tour-price-information/{id}', 'Backend\AdminsController@tourPriceInformation');
    Route::get('/tour-price-promotion-information/{id}', 'Backend\AdminsController@tourPricePromotionInformation');

});