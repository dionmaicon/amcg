<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "follow_up".
 *
 * @property integer $id_follow_up
 * @property string $follow_up
 * @property string $data_ultima_atualizacao
 * @property integer $id_protocolo
 * @property integer $id_funcionario
 *
 * @property Protocolo $idProtocolo
 */
class FollowUp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'follow_up';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_ultima_atualizacao'], 'safe'],
            [['id_protocolo'], 'required'],
            [['id_protocolo'], 'integer'],
            [['follow_up'], 'string', 'max' => 255],
            [['id_protocolo'], 'exist', 'skipOnError' => true, 'targetClass' => Protocolo::className(), 'targetAttribute' => ['id_protocolo' => 'id_protocolo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_follow_up' => Yii::t('app', 'Código de Follow Up'),
            'follow_up' => Yii::t('app', 'Follow Up'),
            'data_ultima_atualizacao' => Yii::t('app', 'Data da última atualização'),
            'id_funcionario'=>'Código do Colaborador',
            'id_protocolo' => Yii::t('app', 'Nº Protocolo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProtocolo()
    {
        return $this->hasOne(Protocolo::className(), ['id_protocolo' => 'id_protocolo']);
    }

    /**
     * @inheritdoc
     * @return FollowUpQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FollowUpQuery(get_called_class());
    }
}
