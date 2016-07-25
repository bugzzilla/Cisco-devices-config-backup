<?php

	include_once ( __DIR__ . '/../inc/pdo.php');
	include_once ( __DIR__ . '/../inc/misc.php');

	require_once ( __DIR__ . '/../cisco/cisco.class.php');

	class backup_thread {


		private $backup_job_file = "";
		private $backup_job = "";
		private $backup_job_id = "";		
		private $backup_id = 0;                
		private $pdo_connection = null;
		private $cisco_connection = null;

		public function __construct($backup_job_file) {

			$this->backup_job_file = $backup_job_file;
			$this->backup_job_id = strtok($this->backup_job_file,'.');
		
			// Chech for job file exists & read 
			if (file_exists(_BACKUP_JOB_PATH_.$this->backup_job_file)){
				$this->backup_job = explode(PHP_EOL, rtrim(file_get_contents(_BACKUP_JOB_PATH_ . $this->backup_job_file),PHP_EOL));
                // Job count = 0 
				if (count($this->backup_job) == 0) {
					$this->write_log(null,'ERROR_JOB_FILE_EMPTY');
					return;
				}
			// Job file not exists
			} else {
				$this->write_log(null,'ERROR_JOB_FILE_NOT_EXISTS');
				return;
			}

			// Connect to database
			try {
				$this->pdo_connection = new PDO(_PDO_DSN_, _PDO_USERNAME_, _PDO_PASSWORD_);
			} catch (PDOException $e) {
				$this->write_log(null,'ERROR_PDO_EXCEPTION: '.$e->getMessage());
				return;
			}
		}

		public function run_backup() {

			foreach ($this->backup_job as $device) {

				$device = explode('|', $device);
				$this->backup_id = 0;
				try {
					$this->cisco_connection = new cisco($device[2], $device[3], $device[4], $device[1], $device[5]);
					$config_url = strtok($device[6],':').":";
					$config_name = strtok(':');

					// Check device hostname, update if changed                                        
					if ($device[8] !== $this->cisco_connection->cisco_hostname) {
						$sth =$this->pdo_connection->prepare(_PDO_UPDATE_DEVICE_HOSTNAME_);
						$sth->execute(array(':device_hostname' => $this->cisco_connection->cisco_hostname, ':device_id' => $device[0]));
						$this->write_log($device,'NOTIFY_HOSTNAME_CHANGED '.$device[8].' => '.$this->cisco_connection->cisco_hostname);						
					}
					
					// cisco->dir()
					if (is_array($dir = $this->cisco_connection->dir($config_url))) {
						foreach ($dir as $item) {
							if ($item['name'] == $config_name) {
								// get device backup
								$sth = $this->pdo_connection->prepare(_PDO_GET_DEVICE_BACKUP_);
								$sth->execute(array(':device_id' => $device[0],':config_datetime' => $item['datetime']));
								$backup = $sth->fetchAll(PDO::FETCH_ASSOC);                                                            
								// if not found 
								if (count($backup) == 0) {
									$dest=_BACKUP_JOB_PATH_.$this->backup_job_file.'.text';
									// cisco->copy()
									if ($this->cisco_connection->copy($device[6],$device[7].$this->backup_job_file.'.text')) {
										// wait for readable 
										while (!is_readable($dest)) { }
										$sth = $this->pdo_connection->prepare(_PDO_INSERT_CONFIG_BACKUP_);
										$sth->execute(array(':devices_device_id' => $device[0],
															':config_datetime' => $item['datetime'],
															':storage_datetime' => date(_LOG_DATE_TIME_FORMAT_),
															':jobs_job_id' => $this->backup_job_id,												
															':storage' => file_get_contents($dest)));
										$this->backup_id = $this->pdo_connection->lastInsertId();
										$this->write_log($device, 'SUCCESS');
										unlink($dest);
									} else {
										$this->write_log($device, 'ERROR_CISCO_COPY');
									}
								} else {
									$this->backup_id = $backup[0]['backup_id'];
									$this->write_log($device,'SUCCESS_BACKUP_ALLREADY_EXISTS');
								}
								break;
							}
						}
					} else {
						$this->write_log($device, 'ERROR_CISCO_DIR');
					}
					$this->cisco_connection = null;

				} catch (Exception $e) {
					$this->write_log($device , 'ERROR_CISCO_EXCEPTION: '.$e->getMessage());
					return;
				}

			}
		}


		private function write_log($device, $status) {
			if ($device) {
				echo date(_LOG_DATE_TIME_FORMAT_).' : '.$status.' : '.$device[1].' : ['.$device[6].']'."\n";
				$sth = $this->pdo_connection->prepare(_PDO_INSERT_NEW_THREAD_LOG_);                            
				$sth->execute(array(':devices_device_id' => $device[0],
									':jobs_job_id' => $this->backup_job_id,
									':backups_backup_id' => $this->backup_id,
									':backup_status' => $status));                            
			} else echo date(_LOG_DATE_TIME_FORMAT_).' : '.$status."\n";
		}

		public function __destruct() {
			$this->pdo_connection = null;
			unlink(_BACKUP_JOB_PATH_ . $this->backup_job_file);
		}

}