<?php

namespace admin\logs;

use Yii;
use core\log\Table;


/**
 * 管理员访问日志
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class VisitLog extends Table
{



    /**
     * @inheritDoc
     */
    public function createTable()
    {
        $this->_createTable([
            'id'     => 'int(11) not null primary key auto_increment',
            'action' => 'varchar(64) not null comment "操作"',
            'remark' => 'text',
            'created_at' => 'datetime not null',
        ]);

        $this->createIndex('action');
    }



    /**
     * 准备数据
     *
     * @param array $data  提供的数据
     * @return void
     */
    public function prepare($data)
    {
        return array_merge([
            'created_at' => date('Y-m-d H:i:s'),
        ], $data);
    }
    


}