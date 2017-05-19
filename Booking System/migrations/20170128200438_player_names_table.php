<?php

use Phinx\Migration\AbstractMigration;

class PlayerNamesTable extends AbstractMigration
{
  public function up()
  {

        $players = $this->table('playernames');
        $players->addColumn('firstprocess_id', 'integer')
                ->addForeignKey('firstprocess_id', 'first_processes', 'id', ['delete' => 'cascade', 'update' => 'cascade'])
                ->addColumn('playerone', 'string')
                ->addColumn('playertwo', 'string',   array('null' => true))
                ->addColumn('playerthree', 'string', array('null' => true))
                ->addColumn('playerfour', 'string',  array('null' => true))
                ->addColumn('playerfive', 'string',  array('null' => true))
                ->addColumn('playersix', 'string',   array('null' => true))
                ->addColumn('playerseven', 'string', array('null' => true))
                ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
                ->addColumn('updated_at', 'datetime', ['null' => true])
                ->save();

  }

  public function down()
  {
    $this->dropTable('playernames');
  }
}
