<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "protocolo".
 *
 * @property integer $id_protocolo
 * @property string $descricao
 * @property string $cpf
 * @property string $cnpj
 * @property string $responsavel
 * @property string $email
 * @property string $telefone
 * @property string $prioridade
 * @property string $titulo
 * @property string $data_abertura
 * @property string $data_ultima_atualizacao
 * @property string $data_fechamento
 * @property string $codigo_busca
 * @property string $status
 * @property integer $id_funcionario
 *
 * @property Anexo[] $anexos
 * @property Atribuicao[] $atribuicaos
 * @property FollowUp[] $followUps
 * @property Funcionario $idFuncionario
 */
class Protocolo extends \yii\db\ActiveRecord
{
    public $tipo_pessoa;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'protocolo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'titulo', 'data_abertura', 'data_ultima_atualizacao', 'id_funcionario'], 'required'],
            [['data_abertura', 'data_ultima_atualizacao', 'data_fechamento'], 'safe'],
            [['id_funcionario'], 'integer'],
            [['descricao', 'cpf', 'cnpj', 'responsavel', 'email', 'telefone', 'prioridade', 'titulo', 'status'], 'string', 'max' => 255],
            [['id_funcionario'], 'exist', 'skipOnError' => true, 'targetClass' => Funcionario::className(), 'targetAttribute' => ['id_funcionario' => 'id_funcionario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_protocolo' => Yii::t('app', 'Nº Protocolo'),
            'descricao' => Yii::t('app', 'Descrição'),
            'cpf' => Yii::t('app', 'CPF'),
            'cnpj' => Yii::t('app', 'CNPJ'),
            'responsavel' => Yii::t('app', 'Solicitante'),
            'email' => Yii::t('app', 'E-mail'),
            'telefone' => Yii::t('app', 'Contato'),
            'prioridade' => Yii::t('app', 'Prioridade'),
            'titulo' => Yii::t('app', 'Título'),
            'data_abertura' => Yii::t('app', 'Data de abertura'),
            'data_ultima_atualizacao' => Yii::t('app', 'Data da última atualização'),
            'data_fechamento' => Yii::t('app', 'Data de fechamento'),
            'status' => Yii::t('app', 'Status'),
            'id_funcionario' => Yii::t('app', 'Responsável'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnexos()
    {
        return $this->hasMany(Anexo::className(), ['id_protocolo' => 'id_protocolo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtribuicaos()
    {
        return $this->hasMany(Atribuicao::className(), ['id_protocolo' => 'id_protocolo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFollowUps()
    {
        return $this->hasMany(FollowUp::className(), ['id_protocolo' => 'id_protocolo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFuncionario()
    {
        return $this->hasOne(Funcionario::className(), ['id_funcionario' => 'id_funcionario']);
    }

    /**
     * @inheritdoc
     * @return ProtocoloQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProtocoloQuery(get_called_class());
    }
}
