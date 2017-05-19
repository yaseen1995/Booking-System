<?php
namespace Acme\controllers;

use Respect\Validation\Validator as Validator;

class BaseController
{

  protected $loader;
  protected $twig;

  public function __construct()
  {

    $this->loader = new \Twig_Loader_Filesystem(__DIR__ . "/../../views"); // creates in the views Directory to access all the controllers
    $this->twig = new \Twig_Environment($this->loader,[
      'cache' => false, 'debug' => true // The configuration for using Twig
    ]);
  }
}
