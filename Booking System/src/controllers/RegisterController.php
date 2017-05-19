<?php
namespace Acme\controllers;

use Acme\Models\Customer;
use Acme\Models\CustomersPending;
use Respect\Validation\Validator as Validator;
use Acme\Email\SendEmail;


class registerController
{


    public function getShowRegisterPage()
    {
        include(__DIR__ . "/../../views/register.html");

    }

    public function getShowSuccessPage()
    {
        include(__DIR__ . "/../../views/success.html");

    }

    public function getShowWelcomeEmailPage()
    {
        include(__DIR__ . "/../../views/welcome-email.html");

    }

    public function postShowRegisterPage()
    {
        $user = new Customer; // User extends eloqouent so can use its methods
        $okay = true;


        $verify_email = "";
        $verify_password = "";


        $user->first_name = $_REQUEST['first_name']; // The request comes from the register.php file. it reads the data through the REQUEST function.
          $user->last_name = $_REQUEST['last_name'];
          $user->address = $_REQUEST['address'];
          $user->city = $_REQUEST['city'];
          $user->postcode = $_REQUEST['postcode'];
          $user->county = $_REQUEST['county'];
          $user->contact_no = $_REQUEST['contact_no'];
          $user->email = $_REQUEST['email'];
          $verify_email = $_REQUEST['verify_email']; // We do not want to store this data, simply jus for validation checks.
          $user->password = $_REQUEST['password'];
          $verify_password = $_REQUEST['verify_password'];

          //Verify e.g if statements, and create sessions for all the new database data added here such as postcode, countty etc!!!




        if (($user->first_name == "")
        || ($user->last_name == "")
        || ($user->email == "")
        || ($user->password == "")
        || ($verify_email == "")
        || ($verify_password == "")) {
            $okay = false;
        }

        if ($user->email != $verify_email) {
            $emal =  "<strong>Both emails do not match, please try again.</strong>";
            $_SESSION['emal'] = $emal;
            header("Location: /register");
            exit();
        }

        $results = $user::where('email', '=', $_REQUEST['email'])->get();

        foreach ($results as $item) {

          $invalidEmail =  "<strong>" . $_REQUEST['email'] . "<strong> ". "   <strong>already exists.</strong>";
          $_SESSION['invalidEmail'] = $invalidEmail;
          header("Location: /register");
          exit();
        }

        // try if this works after grizzlers


        if ($user->password != $verify_password) {
            $pass =  "<strong>Both Passwords do not match, please try again.</strong>";
            $_SESSION['pass'] = $pass;
            header("Location: /register");
            exit(); // Exit does not let the bad data post in to the Database.
          }


          if (strlen($user->email) == 0) {
              $email_add =  "<strong>Must enter an email address</strong>";
              $_SESSION['email_add'] = $email_add;
              $okay = false;
          }

          if (strlen($user->password) == 0) {
              $first_pass =  "<strong>Must enter a password</strong>";
              $_SESSION['first_pass'] = $first_pass;
              $okay = false;
          }


        if (strlen($user->first_name) < 3) {
            $f_name =  "<strong>You must enter atleast three characters for your first name!</strong>";
            $_SESSION['f_name'] = $f_name;
            $okay = false;
        }

        if (strlen($user->last_name) < 3) {
            $l_name =  "<strong>You must enter atleast three characters for your last name!</strong>";
            $_SESSION['l_name'] = $l_name;
            $okay = false;
        }


        if (strlen($user->password) < 8) {
            if (strlen($user->password) == 0 && strlen($user->verify_password) == 0) {
                header("Location: /register");
                exit();
            }

            $pass_length =  "<strong>Password must be atleast 8 characters long</strong>";
            $_SESSION['pass_length'] = $pass_length;
            header("Location: /register");
            exit(); // Exit does not let the bad data post in to the Database.
        }


        if (Validator::email()->validate($_REQUEST['email']) == false) {
            if (strlen($user->email) == 0 && strlen($user->verify_email) == 0) {
                header("Location: /register");
                exit();
            }

            $email_error =  "<strong>Email must be a valid email</strong>";
            $_SESSION['email_error'] = $email_error;
            header("Location: /register");
            exit(); // Exit does not let the bad data post in to the Database.

          }

        if ($okay == false) {
            $msg =  "<strong>You missed some of the form data. Please re-enter and try again.</strong>";
            $_SESSION['msg'] = $msg;
            header("Location: /register");
            exit();
        }


          $user->password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);



        $user->save(); // Can use save because it is the eleqouent class method and User extends it.


        $token = md5(uniqid(rand(), true)) . md5(uniqid(rand(), true));
        $customer_pending = new CustomersPending;
        $customer_pending->token = $token;
        $customer_pending->customer_id = $user->id;
        $customer_pending->save();


        $message = "<p>Welcome new Customer!

                  please  <a href=http://localhost:8080/verify-account?token=$token>click here to activate </a> your account


                    </p>
                  <hr>
                  <p>
                  Bowling Leisure Centre.<br>
                  0116 2541376

                  <a href=\http://www.example.com </a>

                  </p>

        ";

        ['token' => $token];




        SendEmail::SendEmail($user->email, "Welcome Customer", $message, getenv('SMTP_FROM'));
        header("Location: /success");
        exit();

    }

    public function getVerifyCustomerAccount()
    {
      $customer_id = 0;
      $token = $_GET['token'];

      $customer_pending = CustomersPending::where('token', '=', $token)->get(); // token in database, equalling to the variable

      foreach ($customer_pending as $item) {
        $customer_id = $item->customer_id;

      }

      if ($customer_id > 0) {

        $customer = Customer::find($customer_id);
        $customer->active = 1;
        $customer->save();


      CustomersPending::where('token', '=', $token)->delete();

      header("Location: /account-activated");
      exit();

    }

      else{

      header("Location: /page-not-found");
      exit();
    }


    }

    public function getCustomerActivateAccount()
    {
      include(__DIR__ . "/../../views/account-activated.html");


    }



}
