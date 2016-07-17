<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Templates;

/**
 * TemplatesSearch represents the model behind the search form about `frontend\models\Templates`.
 */
class TemplatesSearch extends Templates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_id', 'ssh_port'], 'integer'],
            [['template_name', 'cisco_secret', 'ssh_username', 'ssh_password', 'device_config', 'storage'], 'safe'],
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
        $query = Templates::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pagesize' => 20],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'template_id' => $this->template_id,
            'ssh_port' => $this->ssh_port,
        ]);

        $query->andFilterWhere(['like', 'template_name', $this->template_name])
            ->andFilterWhere(['like', 'cisco_secret', $this->cisco_secret])
            ->andFilterWhere(['like', 'ssh_username', $this->ssh_username])
            ->andFilterWhere(['like', 'ssh_password', $this->ssh_password])
            ->andFilterWhere(['like', 'device_config', $this->device_config])
            ->andFilterWhere(['like', 'storage', $this->storage]);

        return $dataProvider;
    }
}
