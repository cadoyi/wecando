<?php

namespace wxapi\pub\menu;

use Yii;
use wxapi\pub\base\Component;

/**
 * 自定义菜单处理
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class MenuServer extends Component
{


    /**
     * 创建自定义菜单
     *
     * @param array $menus 自定义菜单条目
     * @return \wxapi\pub\base\Result
     */
    public function create( $menus )
    {
        $creator = $this->server->createObject(MenuCreate::class);
        return $creator->run( $menus );
    }



    /**
     * 删除自定义菜单
     *
     * @return \wxapi\pub\base\Result
     */
    public function delete()
    {
        $deletor = $this->server->createObject(MenuDelete::class);
        return $deletor->run();
    }





    /**
     * 获取自定义菜单配置
     *
     * @return \wxapi\pub\base\Result
     */
    public function get()
    {
        $gettor = $this->server->createObject(MenuGet::class);
        return $gettor->run();
    }




    /**
     * 获取当前自定义菜单配置项
     *
     * @return \wxapi\pub\base\Result
     */
    public function current()
    {
        $query = $this->server->createObject(MenuQuery::class);
        return $query->run();
    }


}