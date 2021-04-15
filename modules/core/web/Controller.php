<?php

namespace core\web;


use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Controller as WebController;
use yii\filters\VerbFilter;
use yii\filters\AjaxFilter;
use yii\filters\AccessControl;
use yii\filters\AccessRule;

/**
 * web 控制器
 *
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class Controller extends WebController
{



    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // 访问控制
        $access = $this->access();
        if (!empty($access)) {
            $behaviors['access'] = array_merge([
                'class' => AccessControl::class,
                'ruleConfig' => [
                    'class' => AccessRule::class,
                    'allow' => true,
                ],
                'rules' => [],
            ], $access);
        }

        // 请求方法控制
        $verbs = $this->verbs();
        if (!empty($verbs)) {
            $behaviors['verbs'] = [
                'class' => VerbFilter::class,
                'actions' => $verbs,
            ];
        }

        // ajax 请求控制
        $ajax = $this->ajax();
        if (!empty($ajax)) {
            $behaviors['ajax'] = [
                'class' => AjaxFilter::class,
                'only' => $ajax,
            ];
        }
        return $behaviors;
    }



    /**
     * 访问权限管理, 这里设置 AccessControl 规则
     */
    public function access()
    {
        return [
            'rules' => $this->rules(),
        ];
    }



    /**
     * 基本的访问规则
     *
     * @return void
     */
    public function rules()
    {
        return [
            [
                'allow' => true,
            ],
        ];
    }



    /**
     * 列出对应的 action 和请求方法
     *
     * @return array
     */
    public function verbs()
    {
        return [];
    }




    /**
     * 列出只能使用 ajax 访问的方法名称
     *
     * @return array
     */
    public function ajax()
    {
        return [];
    }




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
        return $this->toAjax(0, 'OK', $data);
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
        return $this->toAjax($errcode, $errmsg, $data);
    }


    /**
     * ajax 响应
     *
     * @return array
     */
    public function toAjax($code, $message, $data = [])
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