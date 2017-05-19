<?php
namespace Acme\controllers;

use Acme\Models\Customer;
use Acme\Models\playerName;
use Acme\Models\FirstProcess;
use Respect\Validation\Validator as Validator;
use Acme\Auth\LoggedIn;



class PlayerNamesController
{


    public function getShowPlayerNames()
    {
        include(__DIR__ . "/../../views/PlayerNames.html");

    }


    public function postShowRegisterPage()
    {
        $customer = new Customer;
        $playerNames = new PlayerName;

        $FirstProcesses = FirstProcess::all()->last()->id;



        $playerNames->firstprocess_id = $FirstProcesses;
        //$playerNames->firstprocess_id = LoggedIn::customer()->id;


        $playerNames->playerone = $_REQUEST['playerone'];
        $playerNames->playertwo = $_REQUEST['playertwo'];
        $playerNames->playerthree = $_REQUEST['playerthree'];
        $playerNames->playerfour = $_REQUEST['playerfour'];
        $playerNames->playerfive = $_REQUEST['playerfive'];
        $playerNames->playersix = $_REQUEST['playersix'];
        $playerNames->playerseven = $_REQUEST['playerseven'];




         if($_REQUEST['submit'] == "submit 2") {

          FirstProcess::all()->last()->delete();
          $playerNames->delete();
          header("Location: /");
          exit(); // add this back after
      }


        if($playerNames->playerone == "") {

          $msg =  "<strong>Enter name for atleast Player 1, then you can enter the rest at the centre.</strong>";
                                        $_SESSION['msg'] = $msg;
                                        header("Location: /playernames");
                                        exit();
        }

        if($_REQUEST['submit'] == "submit 1") {


          $playerNames->save();
          header("Location: /bowlingchoice");
          exit(); // add this back after

        }




    }




}
