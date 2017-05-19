<?php

use Phinx\Migration\AbstractMigration;

class DisplayBookingsTable extends AbstractMigration
{
  public function up()
  {

    $displayBookings = $this->table('display_bookings');
    $displayBookings->addColumn('customer_id', 'integer')
            ->addForeignKey('customer_id', 'customers', 'id', ['delete' => 'cascade', 'update' => 'cascade'])
            ->addColumn('first_name', 'string')
            ->addColumn('last_name', 'string')
            ->addColumn('address', 'string')
            ->addColumn('date', 'string')
            ->addColumn('no_of_games', 'integer')
            ->addColumn('no_of_people', 'string')
            ->addColumn('total', 'integer')
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->save();

  }


  public function down()
  {
      $this->dropTable('display_bookings');
  }
}
