<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "funcionario".
 *
 * @property integer $id_funcionario
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $token
 * @property string $email
 * @property string $nome
 * @property string $cargo
 * @property integer $acesso
 * @property boolean $ativo
 * @property integer $id_departamento
 *
 * @property Departamento $idDepartamento
 * @property Protocolo[] $protocolos
 */
class Funcionario extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'funcionario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'email', 'id_departamento'], 'required'],
            [['acesso', 'id_departamento'], 'integer'],
            [['ativo'], 'boolean'],
            [['username', 'password', 'auth_key', 'token', 'email', 'nome', 'cargo'], 'string', 'max' => 255],
            [['auth_key'], 'unique'],
            [['email'], 'unique'],
            [['token'], 'unique'],
            [['username'], 'unique'],
            [['id_departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['id_departamento' => 'id_departamento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_funcionario' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Usuário'),
            'password' => Yii::t('app', 'Senha'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'token' => Yii::t('app', 'Token'),
            'email' => Yii::t('app', 'Email'),
            'nome' => Yii::t('app', 'Nome'),
            'cargo' => Yii::t('app', 'Cargo'),
            'acesso' => Yii::t('app', 'Acesso'),
            'ativo' => Yii::t('app', 'Ativo'),
            'id_departamento' => Yii::t('app', 'Departamento'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDepartamento()
    {
        return $this->hasOne(Departamento::className(), ['id_departamento' => 'id_departamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProtocolos()
    {
        return $this->hasMany(Protocolo::className(), ['id_funcionario' => 'id_funcionario']);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return new static(self::findOne(['id_funcionario'=>$id]));
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        if (self::findOne(['token' => $token]))
            return new static(self::findOne(['token' => $token]));
        else    return null;

    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return new static(self::findOne(['username'=> $username]));

    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id_funcionario;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
}
