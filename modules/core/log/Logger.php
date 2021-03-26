<?php

namespace core\log;

use Yii;
use yii\base\Component;
use yii\base\Exception;

/**
 * 动态表日志, 根据表名不同,自动创建表以及增加日志
 * 
 * 首先需要在一个配置文件中配置好需要的表和对应的类
 * 
 * return [
 *      'customer_visit' => [
 *          'class'  => 'customer\logger\VisitLog',
 *          'prefix' => 'log_customer_visit',
 *      ],
 *      'admin_visit' => [
 *          'class' => 'admin\logger\ActionLog',
 *          'prefix' => 'log_admin_action',
 *      ],
 * ];
 * 
 *  然后再应用配置中配置
 *    'components' => [
 *         'logger' => [
 *              'class' => 'core\log\Logger',
 *              'tableConfig' => [
 *                   'filename' => '@common/config/logger/tables', 
 *              ],
 *         ],
 *    ]
 * 
 *  然后可以记录 customer 访问日志
 *   Yii::$app->logger->log('customer_visit', [
 *       'xxx' => 'xxx',
 *       'yyy' => 'zzz', 
 *   ]);
 * 
 * 
 *  记录 action 日志
 *   Yii::$app->logger->log('admin_visit', [
 *       'action' => Yii::$app->controller->route,
 *       'remark' => '访问了啥啥啥',
 *   ]); 
 * 
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Logger extends Component
{

    /**
     * @var array 配置类
     */
    public $tableConfig = [
        'filename' =>  '@common/config/main/logger'
    ];


    /**
     * @var array 日志表的配置
     */
    protected $_config;


    /**
     * 获取配置信息
     *
     * @return Config
     */
    public function getConfig()
    {
        if(is_null($this->_config)) {
            $config = $this->tableConfig;
            if(!isset($config['class'])) {
                $config['class'] = Config::class;
            }
            $config['logger'] = $this;
            $this->_config = Yii::createObject($config);
        }
        return $this->_config;
    }




    /**
     * 记录日志
     *
     * @param string $key 设置的日志 key 名称
     * @param array $data 日志数据
     * @return bool
     */
    public function log($key, $data)
    {
        $table = $this->getConfig()->getTable($key);
        return $table->save($data);
    }




    /**
     * 更新日志条目, 虽然并不是很需要,但是也提供了这个方法
     *
     * @param string $key  日志 id 
     * @param string|array $condition 条件
     * @param array $data  需要更新的数据
     * @return bool
     */
    public function update($key, $condition, $data)
    {
        $table = $this->getConfig()->getTable($key);
        return $table->save($data, $condition);
    }



}