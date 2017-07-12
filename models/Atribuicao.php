<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Atribuicao".
 *
 * @property integer $id_atribuicao
 * @property string $data_atribuicao
 * @property integer $id_departamento
 * @property integer $id_protocolo
 *
 * @property Departamento $idDepartamento
 * @property Protocolo $idProtocolo
 */
class Atribuicao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Atribuicao';
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
            'id_atribuicao' => Yii::t('app', 'Id Atribuicao'),
            'data_atribuicao' => Yii::t('app', 'Data Atribuicao'),
            'id_departamento' => Yii::t('app', 'Id Departamento'),
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

    /**
     * @inheritdoc
     * @return AtribuicaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AtribuicaoQuery(get_called_class());
    }
}
