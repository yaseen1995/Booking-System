<?php
namespace Acme\controllers;

use Acme\Models\Customer;
use Acme\Models\FirstProcess;
use Acme\Auth\LoggedIn;



class AuthenticationController
{



    public function getShowLoginPage()
    {
        include(__DIR__ . "/../../views/login.html");
        //echo $this->twig->render('login.html');
    }

    public function postShowLoginPage()
    {

      $okay = true;
      $email = $_REQUEST['email']; // getting email from the form in login.html
      $password = $_REQUEST['password']; // getting the password from the from in login.html

      // look up customer in customer database
      $customer = Customer::where('email', '=', $email) // verifying if email is valid. Checking if the email in the database is equal to the email that is written on the login.html form
                ->first(); // Gets the first value

              if($customer != null) { // If the email is valid
                //validate credentials
                if(! password_verify($password, $customer->password)){ // Verifies of password is equal to the password set in the database

                  $okay = false; // If it is not equal, okay is retunred as false
                }

              } else {
                $okay = false; // If email is not valid, okay is equaled to false
              }

              if($email == null){
                $okay = false;

              }
              if($customer->active == 0){
                $okay = false;

              }

              if($okay) { // If it is successful, a session is created for the logged in user
                $_SESSION['customer'] = $customer; // Setting the session
                $_SESSION['firstprocess'] = FirstProcess::all()->last();

                header("Location: /"); // User is thereatfer redirected to the home page
                exit();
              }
              else {

                $msg = "<strong> Invalid Login! </strong>"; // message for incorrct data
                $_SESSION['msg'] = $msg; // storing session variable to a session which is set in the login page
                header("Location: /login"); // The page is redirected back to the login page if login credentials fail
                exit();
              }



    }

              public function getLogout()
              {
                unset($_SESSION['customer']);
                session_destroy();
                header("Location: /login");
                exit();

    }

    public function getTestCustomer()
    {

        dump(LoggedIn::customer()->first_name);
    }


}
