<?php

namespace customer\models\account;

use Yii;
use customer\models\User;

/**
 * 密码账户基类
 * 
 * @author zhangyang <zhangyang@cadoyi.com>
 */
class PasswordAccount extends Account
{



    /**
     * 验证密码
     * 
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }




    /**
     * 设置密码
     *
     * @return void
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }





    /**
     * 创建用户
     *
     * @param string $username  用户名
     * @return $this
     */
    public static function create($username, $password = null, $user = null)
    {
        if(!$password) {
            $password = Yii::$app->security->generateRandomString(18);
        }
        if(empty($user)) {
            $user = new User();
            if(empty($user->nickname)) {
                $pos = strpos($username, '@');
                if($pos > 0) {
                    $user->nickname = substr($username, 0, $pos);
                } else {
                    $user->nickname = $username;
                }                
            }
            $user->save();
        }
        $self = new static([
            'username' => $username,
            'password' => $password,
            'user'     => $user,
        ]);
        $self->save();
        return $self;
    }

}