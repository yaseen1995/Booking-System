<?php

use Phinx\Migration\AbstractMigration;

class BowlingChoices extends AbstractMigration
{

    public function up()
    {

      $bowlingchoices = $this->table('BowlingChoices');
      $bowlingchoices->addColumn('playernames_id', 'integer')
              ->addForeignKey('playernames_id', 'playernames', 'id', ['delete' => 'cascade', 'update' => 'cascade'])
              ->addColumn('standard', 'integer')
              ->addColumn('special', 'integer')
              ->addColumn('chicken_burger', 'integer',  array('null' => true))
              ->addColumn('cheese_burger', 'integer',   array('null' => true))
              ->addColumn('chips', 'integer',           array('null' => true))
              ->addColumn('coke', 'integer',            array('null' => true))
              ->addColumn('pepsi', 'integer',           array('null' => true))
              ->addColumn('fanta', 'integer',           array('null' => true))
              ->addColumn('seven_up', 'integer',        array('null' => true))
              ->addColumn('total', 'integer')
              ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'datetime', ['null' => true])
              ->save();



    }


    public function down()
    {
        $this->dropTable('BowlingChoices');
    }
}
