<?php
namespace Acme\controllers;

use Respect\Validation\Validator as Validator;
use Acme\Models\FirstProcess;
use Acme\Models\Customer;
use Acme\Models\PlayerName;
use Acme\Models\BowlingChoice;
use Acme\Auth\LoggedIn;



class BowlingChoiceController
{



  public function __contsruct()
  {

  }


    public function getShowBowlingChoice()
    {
      include __DIR__ . '/../../views/bowlingchoice.html';

    }

    public function  postShowBowlingChoice(){

      $customer = new Customer;

      $bowlingChoice = new BowlingChoice;

      $firstProcess = new FirstProcess; // User extends eloqouent so can use its methods
      $playerNames = new PlayerName;


      $playerNames = PlayerName::all()->last()->id;



      //$bowlingChoice->playernames_id = LoggedIn::customer()->id;

      $bowlingChoice->playernames_id = $playerNames;

    //  $firstProcess->customer_id = LoggedIn::customer()->id;


        $bowlingChoice->standard = 7;
        $bowlingChoice->special = 10;
        $bowlingChoice->chicken_burger = $_REQUEST['chicken_burger']; // 3
        $bowlingChoice->cheese_burger = $_REQUEST['cheese_burger']; // 3
        $bowlingChoice->chips = $_REQUEST['chips']; // 2
        $bowlingChoice->coke = $_REQUEST['coke']; // 1
        $bowlingChoice->pepsi = $_REQUEST['pepsi']; // 1
        $bowlingChoice->fanta = $_REQUEST['fanta']; // 1
        $bowlingChoice->seven_up = $_REQUEST['seven_up']; // 1

        $no_of_people = $firstProcess->no_of_people;

        $total = 0;


        //$people = FirstProcess::orderBy('no_of_people', 'desc')->first();

        $people = FirstProcess::all()->last(); // gets the last record to pull no_of_people field

        //dd($people);

        //($people->no_of_people);

        if(!isset($_REQUEST['value'])){
          $msg =  "<strong>Please choose a bowling choice</strong>";
                            $_SESSION['msg'] = $msg;
                            header("Location: /bowlingchoice");
                            exit();

        }

         if ($_REQUEST['chicken_burger'] == null) {

            $bowlingChoice->chicken_burger = 0;

        }


        else if($_REQUEST['chicken_burger'] > 0) {

          $bowlingChoice->chicken_burger = $_REQUEST['chicken_burger'] * 3;

           $total = $total + $bowlingChoice->chicken_burger;
        }


         if ($_REQUEST['cheese_burger'] == null) {

            $bowlingChoice->cheese_burger = 0;

        }

        else if($_REQUEST['cheese_burger'] > 0) {

          $bowlingChoice->cheese_burger = $_REQUEST['cheese_burger'] * 3;

          $total = $total + $bowlingChoice->cheese_burger;
        }


         if ($_REQUEST['chips'] == null) {

            $bowlingChoice->chips = 0;

        }

        else if($_REQUEST['chips'] > 0) {

          $bowlingChoice->chips = $_REQUEST['chips'] * 2;

          $total = $total + $bowlingChoice->chips;
        }

         if ($_REQUEST['coke'] == null) {

            $bowlingChoice->coke = 0;

        }

        else if($_REQUEST['coke'] > 0) {

          $bowlingChoice->coke = $_REQUEST['coke'] * 1;

          $total = $total + $bowlingChoice->coke;
        }


         if ($_REQUEST['pepsi'] == null) {

            $bowlingChoice->pepsi = 0;

        }

        else if($_REQUEST['pepsi'] > 0) {

          $bowlingChoice->pepsi = $_REQUEST['pepsi'] * 1.5;

          $total = $total + $bowlingChoice->pepsi;
        }


         if ($_REQUEST['fanta'] == null) {

            $bowlingChoice->fanta = 0;

        }

         if ($_REQUEST['seven_up'] == null) {

            $bowlingChoice->seven_up = 0;

        }


         if ($_REQUEST['value'] == $bowlingChoice->standard) {

              $total = $total + $people->no_of_people * 7;
              $bowlingChoice->special = 0;

          }

          else if ($_REQUEST['value'] == $bowlingChoice->special) {

              $total = $total + $people->no_of_people * 10;
              $bowlingChoice->standard = 0;

        }

       // Try to fix the above later

          $bowlingChoice->total = $total;


  if($_REQUEST['submit'] == "submit 1") {


    $bowlingChoice->save();
    header("Location: /displayBooking");
    exit(); // add this back after

  }

  else if($_REQUEST['submit'] == "submit 2") {

    PlayerName::all()->last()->delete();
    $bowlingChoice->delete();
    $people->delete();
    header("Location: /");
    exit(); // add this back after
}






        // If special deal, retrieve the total players inputted through a query.
        // multiply the number by £10 (£3 from meal), store it in database as total in this Bowlingchoice table
        //Then move on to the next stage which is the beverages for extra
        // If it is normal bowling, add £7 per person per booking,




    }

  }
