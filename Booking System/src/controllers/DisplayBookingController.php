<?php
namespace Acme\controllers;

use Respect\Validation\Validator as Validator;
use Acme\Models\FirstProcess;
use Acme\Models\PlayerName;
use Acme\Models\Customer;
use Acme\Models\BowlingChoice;
use Acme\Models\DisplayBooking;
use Acme\Auth\LoggedIn;




class DisplayBookingController
{

  public function __contsruct()
  {


  }

    public function getShowDisplayPage()
    {
      include __DIR__ . '/../../views/displayBooking.html';

    }


    public function  postShowDisplayPage(){

      $customer = new Customer;

      $firstProcess = new FirstProcess;

      $playerName = new playerName;

      $bowlingChoice = new BowlingChoice;

      $DisplayBooking = new DisplayBooking;


      $DisplayBooking->customer_id = LoggedIn::customer()->id;


      $customers = LoggedIn::customer();
      $FirstProcesses = FirstProcess::all()->last();
      $playerNames = PlayerName::all()->last();
      $bowlingChoices = BowlingChoice::all()->last();




            if($_REQUEST['submit'] == "submit 1") {


              $DisplayBooking->first_name = $customers->first_name;
              $DisplayBooking->last_name = $customers->last_name;
              $DisplayBooking->address = $customers->address;

              $DisplayBooking->date = $FirstProcesses->date;
              $DisplayBooking->no_of_games = $FirstProcesses->no_of_games;
              $DisplayBooking->no_of_people = $FirstProcesses->no_of_people;
              $DisplayBooking->total = $bowlingChoices->total;

              $DisplayBooking->save();

              header("Location: /");

            }

            else if($_REQUEST['submit'] == "submit 2") {

              $FirstProcesses->delete();
              $playerNames->delete();
              $bowlingChoices->delete();

              header("Location: /");
            }



      //  $firstProcess->save();
        //header("Location: /playernames");
      //  exit(); // add this back after


    }

  }
