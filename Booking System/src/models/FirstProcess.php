<?php namespace Acme\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class FirstProcess extends Eloquent
{

  public function customers()
  {
    return $this->hasOne('Acme\models\Customer');

  }

}
