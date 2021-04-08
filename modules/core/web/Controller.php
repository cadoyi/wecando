<?php

namespace core\web;


use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller as WebController;

/**
 * web 控制器
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Controller extends WebController
{


    /**
     * 返回 404 错误
     *
     * @return void
     */
    public function notFound()
    {
        throw new NotFoundHttpException('Page not found');
    }

    /**
     * ajax 成功返回
     *
     * @param array $data
     * @return array
     */
    protected function _success($data = [])
    {
        return $this->ajax(0, 'OK', $data);
    }


    /**
     * ajax 失败返回
     *
     * @param int|array $code
     * @param array $data
     * @return void
     */
    protected function _error($code, $data = [])
    {
        if (is_numeric($code)) {
            $errcode = $code;
            $errmsg = '服务器繁忙, 请稍后再试';
        } else {
            $errcode = $code[0];
            $errmsg = $code[1];
        }
        return $this->ajax($errcode, $errmsg, $data);
    }


    /**
     * ajax 响应
     *
     * @return array
     */
    public function ajax($code, $message, $data = [])
    {
        $ajax = [
            'errcode' => $code,
            'errmsg'  => $message,
        ];
        if (!empty($data)) {
            $ajax['data'] = $data;
        }
        return $this->asJson($data);
    }

}