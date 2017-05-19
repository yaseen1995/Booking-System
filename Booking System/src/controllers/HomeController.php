<?php
namespace Acme\controllers;

use Respect\Validation\Validator as Validator;
use Acme\Models\User;

class HomeController
{

  protected $loader;
  protected $twig;

  public function __contsruct()
  {}


    public function getShowHomePage()
    {
      include __DIR__ . '/../../views/home.html';

    }
    
  }
