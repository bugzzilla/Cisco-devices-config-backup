<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Devices;

/**
 * DevicesSearch represents the model behind the search form about `frontend\models\Devices`.
 */
class DevicesSearch extends Devices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id'], 'integer'],
            [['device_hostname', 'device_address', 'templates_template_id', 'backup_status'], 'safe'],
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
        $query = Devices::find();

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

        $query->joinWith('templatesTemplate');
        // grid filtering conditions
        $query->andFilterWhere([
            'device_id' => $this->device_id,
        ]);

        $query->andFilterWhere(['like', 'device_hostname', $this->device_hostname])
              ->andFilterWhere(['like', 'device_address', $this->device_address])
              ->andFilterWhere(['like', 'backup_status', $this->backup_status])                
              ->andFilterWhere(['like', 'templates.template_name', $this->templates_template_id]);                

        return $dataProvider;
    }
}
