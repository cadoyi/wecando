<?php

namespace wxapi\pub\user\tags;

use Yii;
use wxapi\pub\base\Component;



/**
 * 列出已经创建的标签
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/User_Tag_Management.html
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class TagList extends Component
{

    /**
     *  URL 路径
     */
    const URL_PATH = '/cgi-bin/tags/get';



    /**
     * 查询创建的所有 tag
     *
     * @return \wxapi\pub\base\Result
     *    {   
     *       "tags":[
     *             {       
     *                 "id":1,       
     *                 "name":"每天一罐可乐星人",      
     *                 "count":0 //此标签下粉丝数
     *              },
     *              {   
     *                  "id":2,   
     *                  "name":"星标组",   
     *                  "count":0
     *              },
     *              {   
     *                   "id":127,  
     *                   "name":"广东",  
     *                   "count":5 
     *              }   
     *          ] 
     *     } 
     * 
     */
    public function run()
    {
        $url = $this->buildUrl();

        $this->createRequest()
             ->setMethod('GET')
             ->setUrl($url)
             ->send();
        return $this->result;
    }
    

}