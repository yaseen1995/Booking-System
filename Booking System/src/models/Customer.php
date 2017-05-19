<?php namespace Acme\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Customer extends Eloquent
{

  public function firstprocesses()
  {
    return $this->hasMany('Acme\models\FirstProcess');

  }


}
