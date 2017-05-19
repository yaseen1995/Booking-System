<?php

use Phinx\Migration\AbstractMigration;

class FirstProcessTable extends AbstractMigration
{
  public function up()
  {

        $firstProcesses = $this->table('first_processes');
        $firstProcesses->addColumn('customer_id', 'integer')
                ->addForeignKey('customer_id', 'customers', 'id', ['delete' => 'cascade', 'update' => 'cascade'])
                ->addColumn('date', 'string')
                ->addColumn('time', 'string')
                ->addColumn('no_of_games', 'integer')
                ->addColumn('no_of_people', 'integer')
                ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
                ->addColumn('updated_at', 'datetime', ['null' => true])
                ->save();

  }

  public function down()
  {
    $this->dropTable('first_processes');
  }
}
