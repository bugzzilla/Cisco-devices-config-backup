<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Backups;

/**
 * BackupsSearch represents the model behind the search form about `frontend\models\Backups`.
 */
class BackupsSearch extends Backups
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['backup_id', 'devices_device_id', 'jobs_job_id', 'config_datetime', 'storage_datetime', 'storage'], 'safe'],
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
    	
    	$query = Backups::find();
    	
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

        $query->joinWith('devicesDevice');        

        $query->andFilterWhere([
            'backup_id' => $this->backup_id,
        ]);

        $query->andFilterWhere(['like', 'jobs_job_id', $this->jobs_job_id])
              ->andFilterWhere(['like', 'storage', $this->storage]);
        
		$query->andFilterWhere(['or',
									['like','devices.device_address', $this->devices_device_id],
									['like','devices.device_hostname', $this->devices_device_id]
		]);
            
        if ($this->config_datetime) $query->andFilterWhere(['like', 'config_datetime', Yii::$app->formatter->asDatetime($this->config_datetime,'y-MM-dd')]); 
        if ($this->storage_datetime) $query->andFilterWhere(['like', 'storage_datetime', Yii::$app->formatter->asDatetime($this->storage_datetime,'y-MM-dd')]);        
           
        return $dataProvider;
    }
}
