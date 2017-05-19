<?php

namespace Acme\Auth;

use Acme\Models\Customer;
use Acme\Models\FirstProcess;



class LoggedIn {


    public static function customer()
    {
      if (isset($_SESSION['customer']))
      {
        $customer = $_SESSION['customer'];
        return $customer;
      } else {
        return false;
      }
    }

    public static function firstprocess()
    {
      if (isset($_SESSION['firstprocess']))
      {
        $firstprocess = $_SESSION['firstprocess'];
        return $firstprocess;
      } else {
        return false;
      }
    }
}
