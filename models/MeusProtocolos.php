<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "atribuicao".
 *
 * @property integer $id_atribuicao
 * @property string $data_atribuicao
 * @property integer $id_departamento
 * @property integer $id_protocolo
 *
 * @property Departamento $idDepartamento
 * @property Protocolo $idProtocolo
 */
class MeusProtocolos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'atribuicao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_atribuicao'], 'safe'],
            [['id_departamento', 'id_protocolo'], 'required'],
            [['id_departamento', 'id_protocolo'], 'integer'],
            [['id_departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamento::className(), 'targetAttribute' => ['id_departamento' => 'id_departamento']],
            [['id_protocolo'], 'exist', 'skipOnError' => true, 'targetClass' => Protocolo::className(), 'targetAttribute' => ['id_protocolo' => 'id_protocolo']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_atribuicao' => Yii::t('app', 'Atribuicao'),
            'data_atribuicao' => Yii::t('app', 'Atribuido em'),
            'id_departamento' => Yii::t('app', 'Departamento'),
            'id_protocolo' => Yii::t('app', 'Id Protocolo'),
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
    public function getIdProtocolo()
    {
        return $this->hasOne(Protocolo::className(), ['id_protocolo' => 'id_protocolo']);
    }
}
