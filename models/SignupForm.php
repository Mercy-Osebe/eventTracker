<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password','password_repeat'], 'required'],
            // rememberMe must be a boolean value
            ['username', 'string','min'=>4,'max'=>16],
            // password is validated by validatePassword()
            ['password_repeat', 'compare','compareAttribute'=>'password'],
        ];
    }
        
    public function signup()
    {
        $user =new User();
        $user->username = $this->username;
        $user->password = \yii::$app->security->generatePasswordHash($this->password);
        $user->accessToken=\yii::$app->security->generateRandomString();
        $user->authKey = \yii::$app->security->generateRandomString();

        if($user->save()){
            return true;
        }

        \yii::error("User was not saved".VarDumper::dumpAsString($user->errors));
        return false;
    }
}
