<?php
namespace Acme\controllers;

use Respect\Validation\Validator as Validator;
use Acme\Models\FirstProcess;
use Acme\Models\PlayerName;
use Acme\Models\Customer;
use Acme\Models\BowlingChoice;
use Acme\Models\DisplayBooking;
use Acme\Auth\LoggedIn;



class ViewBookingController
{

  public function __contsruct()
  {


  }

    public function getShowViewPage()
    {
      include(__DIR__ . "/../../views/viewBooking.html");

    }








  }
