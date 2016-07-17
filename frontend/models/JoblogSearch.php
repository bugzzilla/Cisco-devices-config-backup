<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Joblog;

/**
 * JoblogSearch represents the model behind the search form about `frontend\models\Joblog`.
 */
class JoblogSearch extends Joblog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['internal_id', 'job_id', 'job_started', 'job_stopped', 'job_status', 'templates_template_id'], 'safe'],
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
        $query = Joblog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 20,
            ],

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('templatesTemplate');
        
        // grid filtering conditions

        $query->andFilterWhere(['like', 'job_id', $this->job_id])
            ->andFilterWhere(['like', 'templates.template_name', $this->templates_template_id])
            ->andFilterWhere(['like', 'job_status', $this->job_status]);

       if ($this->job_started) $query->andFilterWhere(['like', 'job_started', Yii::$app->formatter->asDatetime($this->job_started,'y-MM-dd')]);
       if ($this->job_stopped) $query->andFilterWhere(['like', 'job_stopped', Yii::$app->formatter->asDatetime($this->job_stopped,'y-MM-dd')]);
            
            
        return $dataProvider;
    }
}
