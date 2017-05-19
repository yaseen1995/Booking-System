<?php

use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{
  public function up()
  {

        $customers = $this->table('customers');
        $customers->addColumn('first_name', 'string')
                ->addColumn('last_name', 'string')
                ->addColumn('address', 'string')
                ->addColumn('city', 'string')
                ->addColumn('postcode', 'string')
                ->addColumn('county', 'string')
                ->addColumn('contact_no', 'biginteger')
                ->addColumn('email', 'string')
                ->addColumn('password', 'string')
                ->addColumn('active', 'integer', ['default' => '0'])
                ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
                ->addColumn('updated_at', 'datetime', ['null' => true])
                ->save();

  }

  public function down()
  {
    $this->dropTable('customers');
  }



}
