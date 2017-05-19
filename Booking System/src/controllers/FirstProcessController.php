<?php
namespace Acme\controllers;

use Respect\Validation\Validator as Validator;
use Acme\Models\FirstProcess;
use Acme\Models\Customer;
use Acme\Auth\LoggedIn;





class FirstProcessController
{



  public function __contsruct()
  {


  }


    public function getShowFirstProcess()
    {
      include __DIR__ . '/../../views/firstProcess.html';


    }

    public function  postShowFirstProcess(){

      $customer = new Customer;

      $firstProcess = new FirstProcess; // User extends eloqouent so can use its methods

      $firstProcess->customer_id = LoggedIn::customer()->id;


        $firstProcess->no_of_people = $_REQUEST['no_of_people'];
        $firstProcess->date = $_REQUEST['date'];
        $firstProcess->time = $_REQUEST['time'];
        $firstProcess->no_of_games =  $_REQUEST['no_of_games'];



    //  $totalDate = FirstProcess::where('date')->get();
    //  $totalTime = FirstProcess::where('time')->get();

      $okay = false;




      if($firstProcess->time == "09:00" || $firstProcess->time == "10:00" ||
        $firstProcess->time == "11:00"  || $firstProcess->time == "12:00" ||
        $firstProcess->time == "13:00"  || $firstProcess->time == "14:00" ||
        $firstProcess->time == "15:00"  || $firstProcess->time == "16:00" ||
        $firstProcess->time == "17:00"  || $firstProcess->time == "18:00" ||
        $firstProcess->time == "19:00"  || $firstProcess->time == "20:00" ||
        $firstProcess->time == "21:00"  && $firstProcess->no_of_people != ""
        && $firstProcess->date != ""
        && $firstProcess->time != ""
        && $firstProcess->no_of_games != "")

                              {

                              $okay = true;

                                }


                       if($_REQUEST['submit'] == "submit 2") {

                        $okay = true;
                        $firstProcess->delete();
                        header("Location: /");
                        exit(); // add this back after
                      }


                                  if($okay == false) {

                                  $msg =  "<strong>Choose an appropirate date and timing with the number of games and people to play. Minimum 3 people</strong>";
                                                        $_SESSION['msg'] = $msg;
                                                        header("Location: /firstProcess");
                                                        exit();
                                                    }


                    if($_REQUEST['submit'] == "submit 1") {

                      $okay = false;
                      $firstProcess->save();
                      header("Location: /playernames");
                      exit(); // add this back after

                    }





}




    }
