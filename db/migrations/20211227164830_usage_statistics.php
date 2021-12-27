<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UsageStatistics extends AbstractMigration
{
    private string $tableName = 'usage_statistics';

    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table($this->tableName, ['signed' => false]);

        $table
            ->addColumn('device_name',   'string',   [ 'limit' => 512  ])
            ->addColumn('device_os',   'string',   [ 'limit' => 200  ])
            ->addColumn('device_ip', 'string', ['default' => '0' ])
            ->addColumn('referer', 'string', ['default' => ''])
            ->addColumn('requested_url', 'string',  [ 'limit' => 200 ])
            ->addColumn('created_at','datetime')
            ->create();
    }
}
