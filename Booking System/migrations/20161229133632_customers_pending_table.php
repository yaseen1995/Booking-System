<?php

use Phinx\Migration\AbstractMigration;

class CustomersPendingTable extends AbstractMigration
{

    public function change()
    {

      $customers_pending = $this->table('customers_pending');
      $customers_pending->addColumn('token', 'string')
              ->addColumn('customer_id', 'integer')
              ->addForeignKey('customer_id', 'customers', 'id', ['delete' => 'cascade', 'update' => 'cascade'])
              ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('updated_at', 'datetime', ['null' => true])
              ->save();

    }
}
