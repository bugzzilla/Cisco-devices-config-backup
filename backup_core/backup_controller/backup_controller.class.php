<?php


    include_once ( __DIR__ . '/../inc/pdo.php');
    include_once ( __DIR__ . '/../inc/misc.php');

	class backup_controller {

        private $devices_per_backup_thread = null;
        private $devices_to_backup_count = 0;
        private $devices_to_backup = array();
        private $backup_thread_count = 1;
        private $pdo_connection;
        private $backup_job_id = "";
        private $backup_job_pdo_id = 0;

        public function __construct($template_id, $devices_per_backup_thread) {

            $backup_job_started = date(_LOG_DATE_TIME_FORMAT_);
            $this->backup_job_id = md5(microtime ());

            echo date(_LOG_DATE_TIME_FORMAT_).' Controller created, job ID '.$this->backup_job_id."\n";

            try {
                $this->pdo_connection = new PDO(_PDO_DSN_, _PDO_USERNAME_, _PDO_PASSWORD_);
            } catch (PDOException $e) {
                echo date(_LOG_DATE_TIME_FORMAT_).' ERROR_PDO_EXCEPTION: ' . $e->getMessage();
                return;
            }

            $sth = $this->pdo_connection->prepare(_PDO_GET_DEVICES_TO_BACKUP_);
            $sth->execute(array(':template_id' => $template_id));
            $this->devices_to_backup = $sth->fetchAll(PDO::FETCH_ASSOC);

            echo date(_LOG_DATE_TIME_FORMAT_).' Devices to backup: '.$this->devices_to_backup_count = count($this->devices_to_backup)."\n";
            echo date(_LOG_DATE_TIME_FORMAT_).' Devices per backup thread: '.$this->devices_per_backup_thread = $devices_per_backup_thread."\n";
            echo date(_LOG_DATE_TIME_FORMAT_).' Backup thread count: '.$this->backup_thread_count = ceil($this->devices_to_backup_count / $this->devices_per_backup_thread)."\n";

            $sth =$this->pdo_connection->prepare(_PDO_INSERT_NEW_BACKUP_JOB_LOG_);
            $sth->execute(array(':job_id' => $this->backup_job_id,
            		':job_started' => $backup_job_started,
            		':templates_template_id' => $template_id,
            		':devices_to_backup' => $this->devices_to_backup_count,
            		':devices_per_backup_thread' => $this->devices_per_backup_thread,
            		':backup_thread_count' => $this->backup_thread_count));
            $this->backup_job_pdo_id = $this->pdo_connection->lastInsertId();
            
            if ($this->devices_to_backup_count == 0) {
                echo date(_LOG_DATE_TIME_FORMAT_)." No devices to backup \n";
                return;
            }
            
        }

        public function run() {
            echo date(_LOG_DATE_TIME_FORMAT_)." Run executed\n";
            
            $i = 1;
            $job_id = 1;
            $st = "";

            foreach ($this->devices_to_backup as  $device) {
                $st .= implode('|', $device).PHP_EOL;
                if ($i == $this->devices_per_backup_thread) {
                    $backup_job = $this->backup_job_id.'.'.$job_id.'.job';
                    file_put_contents(_BACKUP_JOB_PATH_.$backup_job,$st);
                    $this->exec_job($backup_job);
                    $job_id++;
                    $i = 1;
                    echo _BACKUP_JOB_PATH_.$backup_job."\n";
                    $st="";
                } else  $i++;
            }
            if ($st) {
                $backup_job = $this->backup_job_id.'.'.$job_id.'.job';
                file_put_contents(_BACKUP_JOB_PATH_.$backup_job,$st);
                $this->exec_job($backup_job);
            }

            while ($this->search_runned_jobs(_BACKUP_JOB_PATH_.$this->backup_job_id.'.*.job')) {
                usleep(100000);
            }
        }

        public function search_runned_jobs($jobs_to_search){
            if(count(glob($jobs_to_search)) == 0) return false;
            else return true;
        }


        private function exec_job($backup_job) {

            $execute = 'nohup php ' . __DIR__ . '/../backup_thread/backup_thread.php '.$backup_job. ' >> '._BACKUP_JOB_PATH_.$this->backup_job_id.'.log 2>&1 &';
            echo date(_LOG_DATE_TIME_FORMAT_)." Execute: ".$execute."11\n";
            shell_exec($execute);
        }


        public function __destruct() {

            $backup_job_stopped= date(_LOG_DATE_TIME_FORMAT_);
            if ($this->pdo_connection) {
	            if (($this->devices_to_backup_count > 0) & (file_exists(_BACKUP_JOB_PATH_.$this->backup_job_id.'.log'))) {
		            $job_log = file_get_contents(_BACKUP_JOB_PATH_.$this->backup_job_id.'.log');
		            unlink(_BACKUP_JOB_PATH_.$this->backup_job_id.'.log');	            
	            	if (strpos($job_log, "ERROR")) 
			            $job_status = 0;
	            	else 
	            	$job_status = 1;
	            } elseif (($this->devices_to_backup_count == 0)) {
	            	$job_status = 0;
	            	$job_log = "THERE IS NOTHING TO BACKUP";
	            } elseif (!file_exists(_BACKUP_JOB_PATH_.$this->backup_job_id.'.log')) {
	            	$job_status = 0;
	            	$job_log = 'LOG FILE '._BACKUP_JOB_PATH_.$this->backup_job_id.'.log NOT EXISTS';
	            }
		        $sth =$this->pdo_connection->prepare(_PDO_UPDATE_NEW_BACKUP_JOB_LOG_);
		        $sth->execute(array(':internal_id' => $this->backup_job_pdo_id,
		               				':job_stopped' => $backup_job_stopped,
	            					':job_status' => $job_status,            		
		               				':job_log' => $job_log));
		        $this->pdo_connection = null;
            }	        
            echo $backup_job_stopped.' Controller stoped, job ID '.$this->backup_job_id."\n";
 
        }

    }