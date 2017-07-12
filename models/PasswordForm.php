<?php

namespace app\models;



use kartik\password\StrengthValidator;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class PasswordForm extends Model
{
    //Define public variable

    public $old_password;
    public $new_password;
    public $repeat_password;


    public function rules() {
        return [
            [['old_password', 'new_password', 'repeat_password'], 'required'],
            [['new_password', 'repeat_password'], StrengthValidator::className(), 'preset'=>'normal'],
            [['repeat_password'], 'compare', 'compareAttribute'=>'new_password','message'=>"As senhas não as mesmas!" ]

        ];
    }


    public function attributeLabels()
    {
        return [
            'old_password' => 'Senha Atual',
            'new_password' => 'Nova Senha',
            'repeat_password' => 'Confirmar Senha',
        ];
    }

}
