<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Protocolo;

/**
 * ProtocoloSearch represents the model behind the search form about `app\models\Protocolo`.
 */
class ProtocoloSearch extends Protocolo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_protocolo', 'id_funcionario'], 'integer'],
            [['descricao', 'cpf', 'cnpj', 'responsavel', 'email', 'telefone', 'prioridade', 'titulo', 'data_abertura', 'data_ultima_atualizacao', 'data_fechamento', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Protocolo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_protocolo' => $this->id_protocolo,
            'data_abertura' => $this->data_abertura,
            'data_ultima_atualizacao' => $this->data_ultima_atualizacao,
            'data_fechamento' => $this->data_fechamento,
            'id_funcionario' => $this->id_funcionario,
        ]);

        $query->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'cpf', $this->cpf])
            ->andFilterWhere(['like', 'cnpj', $this->cnpj])
            ->andFilterWhere(['like', 'responsavel', $this->responsavel])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telefone', $this->telefone])
            ->andFilterWhere(['like', 'prioridade', $this->prioridade])
            ->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
