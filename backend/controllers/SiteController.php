<?php
namespace backend\controllers;


use Yii;
use common\models\LoginForm;

/**
 * 入口页控制器
 */
class SiteController extends Controller
{


    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [
                'allow' => true,
                'actions' => ['error'],
            ],
            [
                'allow' => true,
            ]
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }



    /**
     * 显示首页
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


}
