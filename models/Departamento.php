<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamento".
 *
 * @property integer $id_departamento
 * @property string $departamento
 *
 * @property Atribuicao[] $atribuicaos
 * @property Funcionario[] $funcionarios
 */
class Departamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['departamento'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_departamento' => Yii::t('app', 'Id Departamento'),
            'departamento' => Yii::t('app', 'Departamento'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtribuicaos()
    {
        return $this->hasMany(Atribuicao::className(), ['id_departamento' => 'id_departamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFuncionarios()
    {
        return $this->hasMany(Funcionario::className(), ['id_departamento' => 'id_departamento']);
    }
}
