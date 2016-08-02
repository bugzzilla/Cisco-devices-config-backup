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
					'crontab' => 'Backup job example: /usr/bin/php /var/www/html/cisco-backup/backup_core/run_backup.php <template_id> <devices_per_backup_thread> | logger -i',
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
		
		public function saveCroneTab($cron) {
			if ($cron) {
				$responce ='';
				$return_var = -1;
				
				exec("echo '".str_replace("\r", "",$cron)."' | crontab -", $responce, $return_var);
				
			}
		}
		
}