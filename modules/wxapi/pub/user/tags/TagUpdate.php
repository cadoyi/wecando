<?php

namespace wxapi\pub\user\tags;


use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Component;


/**
 * 更新标签名
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/User_Tag_Management.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class TagUpdate extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/tags/update';



    /**
     * 更新操作
     *
     * @param string $name 新的名称
     * @param string $id   标签 ID
     * @return bool
     */
    public function run($name, $id)
    {
        $url = $this->buildUrl();

        $content = Json::encode([
           'tag' => [
               'id'   => $id,
               'name' => $name,
           ]
        ]);
        $this->createRequest()
             ->setMethod('POST')
             ->setUrl($url)
             ->setContent($content)
             ->send();

        return !$this->hasError();
    }

}