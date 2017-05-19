<?php
namespace Acme\controllers;
use Acme\Models\BowlingChoice;


class PageController {

  public function getShowPage()
  {
    $browser_title = "";
    $bowlingChoice = BowlingChoice::all()->last();

    if(strlen($browser_title) == 0 || $bowlingChoice->total == null ) {
      header("HTTP/1.0 404 Not Found");
      header("Location: /page-not-found");
      exit();
  }

}

  public function getShow404error()
  {
    include __DIR__ . '/../../views/page-not-found.html';

  }
}
