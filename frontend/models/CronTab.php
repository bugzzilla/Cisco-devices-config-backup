<?php

namespace frontend\models;

use yii\base\Model;

class CronTab extends Model {
	
		public $crontab;
		public $cron_result;		
	
		public function rules()
		{
			return [
					[['crontab', 'cron_result'], 'string'],
			];
		}
		
		public function attributeLabels()
		{
			return [
					'crontab' => 'Backup job example: /usr/bin/php /var/www/html/cisco-backup/backup_core/run_backup.php <template_id> <devices_per_backup_thread> | logger -i',
					'cron_result' => '',					
			];
		}
		
		public function loadCrontab() {
			
			$responce ='';
			$return_var = -1;
			
			exec('crontab -l', $responce, $return_var);
			if (($return_var === 0) & (is_array($responce))) {
				$this->crontab = implode(PHP_EOL, $responce);
				$this->cron_result = '';
			} else {
				$this->crontab = '';
				$this->cron_result = 'Error while loading crontab';
			}
		}
		
		public function saveCroneTab($cron) {

			$responce ='';
			$return_var = -1;
			$this->cron_result = '';
				
			exec("echo '".str_replace("\r", "",$cron)."' | crontab -", $responce, $return_var);
				
			if ($return_var > 0) {
				$this->cron_result = 'Save error, check cron syntax';					
			} else {
				$this->cron_result = 'Saved successfully';
			}
		}
		
}
