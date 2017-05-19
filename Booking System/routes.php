<?php


// Home route
$router -> map('GET', '/', 'Acme\Controllers\HomeController@getShowHomePage', 'home');


// register routes
$router -> map('GET', '/register', 'Acme\Controllers\RegisterController@getShowRegisterPage', 'register');

$router -> map('POST', '/register', 'Acme\Controllers\RegisterController@postShowRegisterPage', 'register_post');

$router -> map('GET', '/success', 'Acme\Controllers\RegisterController@getShowSuccessPage', 'success');

$router -> map('GET', '/welcome-email', 'Acme\Controllers\RegisterController@getShowWelcomeEmailPage', 'welcome-email');

$router -> map('GET', '/verify-account', 'Acme\Controllers\RegisterController@getVerifyCustomerAccount', 'verify-account');

$router -> map('GET', '/account-activated', 'Acme\Controllers\RegisterController@getCustomerActivateAccount', 'account-activated');


//if(Acme\Auth\LoggedIn::customer()) // check the LoggedIn class in Auth {

    // The diffrent booking system processes will be under here, to protect their respective routes. For security purposes.

//}

// Login and out routes
$router -> map('GET', '/login', 'Acme\Controllers\AuthenticationController@getShowLoginPage', 'login');
$router -> map('POST', '/login', 'Acme\Controllers\AuthenticationController@postShowLoginPage', 'login_post');
$router -> map('GET', '/logout', 'Acme\Controllers\AuthenticationController@getLogout', 'logout');

// About Bowling route
//$router -> map('GET', '/about', 'Acme\Controllers\AboutController@getShowAboutPage', 'about');

// Change the above route when it is inputted

$router -> map('GET', '/testemail', function() {

  Acme\Email\SendEmail::sendEmail('yas@here.com', 'My test Subject', 'My message', 'someone@there.com');

  echo "Sent Email!";

});

//test routes
$router -> map('GET', '/testcustomer', 'Acme\Controllers\AuthenticationController@getTestCustomer', 'testcustomer');

// Error route
$router -> map('GET', '/page-not-found', 'Acme\Controllers\PageController@getShow404error', '404error');

// First Process route
$router -> map('GET', '/firstProcess', 'Acme\Controllers\FirstProcessController@getShowFirstProcess', 'firstProcess');
$router -> map('POST', '/firstProcess', 'Acme\Controllers\FirstProcessController@postShowFirstProcess', 'firstProcess_post');

// Player Names route
$router -> map('GET', '/playernames', 'Acme\Controllers\PlayerNamesController@getShowPlayerNames', 'playerNames');
$router -> map('POST', '/playernames', 'Acme\Controllers\PlayerNamesController@postShowRegisterPage', 'playerNames_post');

//Bowling choices routes
$router -> map('GET', '/bowlingchoice', 'Acme\Controllers\BowlingChoiceController@getShowBowlingChoice', 'bowlingchoice');
$router -> map('POST', '/bowlingchoice', 'Acme\Controllers\BowlingChoiceController@postShowBowlingChoice', 'bowlingchoice_post');

//Display Booking page
$router -> map('GET', '/displayBooking', 'Acme\Controllers\DisplayBookingController@getShowDisplayPage', 'displayBooking');
$router -> map('POST', '/displayBooking', 'Acme\Controllers\DisplayBookingController@postShowDisplayPage', 'displayBooking_post');

$router -> map('GET', '/aboutUs', 'Acme\Controllers\AboutUsController@getShowAboutUsPage', 'aboutUs');


//View page
$router -> map('GET', '/viewBooking', 'Acme\Controllers\ViewBookingController@getShowViewPage', 'viewBooking');

$router -> map('GET', '/page-not-found', 'Acme\Controllers\ViewBookingController@getShowPageNotFound', 'pageNotFound');


// Wrong page route (Redirect to error route)
$router -> map('GET', '/[*]', 'Acme\Controllers\PageController@getShowPage', 'generic_page');
