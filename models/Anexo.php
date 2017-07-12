<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "anexo".
 *
 * @property integer $id_anexo
 * @property string $caminho
 * @property integer $id_protocolo
 *
 * @property Protocolo $idProtocolo
 */
class Anexo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anexo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_protocolo'], 'required'],
            [['id_protocolo'], 'integer'],
            [['caminho'], 'string', 'max' => 255],
            [['id_protocolo'], 'exist', 'skipOnError' => true, 'targetClass' => Protocolo::className(), 'targetAttribute' => ['id_protocolo' => 'id_protocolo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_anexo' => 'Id Anexo',
            'caminho' => 'Caminho',
            'id_protocolo' => 'Id Protocolo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProtocolo()
    {
        return $this->hasOne(Protocolo::className(), ['id_protocolo' => 'id_protocolo']);
    }
}
