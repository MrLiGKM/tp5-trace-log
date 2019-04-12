<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateTraceLogData extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        // create the table
        $table = $this->table('trace_log_data');
        $table->addColumn('log_id', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '日志记录id'])
            ->addColumn('params', 'string', ['limit' => 255, 'default' => '', 'comment' => '请求参数'])
            ->addColumn('message', 'text' , ['default' => '', 'comment' => '日志信息'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '记录时间'])
            ->addIndex(['log_id'])
            ->create();
    }

    /**
     * 提供回滚的删除用户表方法
     */
    public function down(){
        $this->dropTable('trace_log_list');
    }
}
