<?php

namespace frontend\models;

use yii\base\Model;

class CronTab extends Model {
	
		public $crontab;
	
		public function rules()
		{
			return [
					[['crontab'], 'string'],
			];
		}
		
		public function attributeLabels()
		{
			return [
					'crontab' => 'Crontab',
			];
		}
		
		public function loadCrontab() {
			
			$responce ='';
			$return_var = -1;
			
			exec('crontab -l', $responce, $return_var);
			if (($return_var == 0) & (is_array($responce))) {
				$this->crontab = implode("\n", $responce);
			}
		}
		
}