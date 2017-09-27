<?php
use Migrations\AbstractMigration;

class Options extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $this->table('options', ['id' => false, 'primary_key' => ['id']])
            ->addColumn('id', 'uuid', [
                'null' => false,
            ])
            ->addColumn('opt_key', 'string', [
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('opt_value', 'text', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('opt_autoload', 'boolean', [
                'default' => 0,
                'null' => true,
            ])
            ->addIndex(['opt_key'], [
                'unique' => true,
            ])
            ->create();
    }
}
