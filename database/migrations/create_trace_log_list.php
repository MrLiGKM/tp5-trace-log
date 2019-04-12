<?php

use think\migration\Migrator;
use think\migration\db\Column;

class CreateTraceLogList extends Migrator
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
        $table = $this->table('trace_log_list');
        $table->addColumn('method', 'string', ['limit' => 6, 'default' => '', 'comment' => '请求方法'])
            ->addColumn('type', 'integer', ['limit' => 1, 'default' => 0, 'comment' => '日志类型'])
            ->addColumn('route', 'string' , ['limit' => 255, 'default' => '', 'comment' => '请求地址'])
            ->addColumn('position', 'string', ['limit' => 255, 'default' => '', 'comment' => '调用方法位置'])
            ->addColumn('line', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '调用方法位置行数'])
            ->addColumn('ip', 'string', ['limit' => 15, 'default' => '', 'comment' => '请求ip'])
            ->addColumn('update_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '更新时间'])
            ->addColumn('create_time', 'integer', ['limit' => 11, 'default' => 0, 'comment' => '记录时间'])
            ->addIndex(['type'])
            ->addIndex(['ip'])
            ->create();
    }

    /**
     * 提供回滚的删除用户表方法
     */
    public function down(){
        $this->dropTable('trace_log_list');
    }
}
