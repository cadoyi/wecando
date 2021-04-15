<?php

namespace wxapi\pub\user\tags;

use Yii;
use yii\helpers\Json;
use wxapi\pub\base\Component;

/**
 * 删除用户标签
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/User_Tag_Management.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class TagDelete extends Component
{

    /**
     * URL 路径
     */
    const URL_PATH = '/cgi-bin/tags/delete';



    /**
     * 执行删除操作
     *
     * @return \wxapi\pub\base\Result
     */
    public function run( $id )
    {
        $url = $this->buildUrl();

        $content = Json::encode([
            'tag' => [
                'id' => $id,
            ]
        ]);

        $this->createRequest()
             ->setMethod('POST')
             ->setUrl($url)
             ->setContent($content)
             ->send();

        return $this->result;
    }

    


}