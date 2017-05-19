<?php
namespace Acme\controllers;


class AboutUsController

{

        public function __contsruct()
        {

        }



    public function getShowAboutUsPage()
    {
        include(__DIR__ . "/../../views/aboutus.html");
        //echo $this->twig->render('login.html');
    }

  }
