<?php

	define('_PDO_DSN_', 'mysql:dbname=cisco_backup;host=localhost');
	define('_PDO_USERNAME_', 'root');
	define('_PDO_PASSWORD_', 'Qw!123456');
	define('_PDO_GET_DEVICES_TO_BACKUP_',"
			SELECT dev.device_id, dev.device_address, templ.cisco_secret, templ.ssh_username, templ.ssh_password, templ.ssh_port, templ.device_config, templ.storage, dev.device_hostname 
			FROM `devices` dev, `templates` templ 
			WHERE dev.templates_template_id=templ.template_id and dev.backup_status=1 and templ.template_id = :template_id");

	define('_PDO_GET_DEVICE_BACKUP_', "SELECT backup_id FROM `backups` WHERE devices_device_id = :device_id and config_datetime = :config_datetime");

	define('_PDO_INSERT_CONFIG_BACKUP_', "
			INSERT INTO `backups` (devices_device_id, jobs_job_id, config_datetime, storage_datetime, storage) 
			VALUES (:devices_device_id, :jobs_job_id, :config_datetime, :storage_datetime, :storage)");

	define('_PDO_INSERT_NEW_BACKUP_JOB_LOG_', "
			INSERT INTO `joblog` (job_id, templates_template_id, job_started, devices_to_backup, devices_per_backup_thread, backup_thread_count)
	        VALUES (:job_id, :templates_template_id, :job_started, :devices_to_backup, :devices_per_backup_thread, :backup_thread_count)");

	define('_PDO_UPDATE_NEW_BACKUP_JOB_LOG_', "UPDATE `joblog` SET job_stopped = :job_stopped, job_log = :job_log, job_status = :job_status WHERE job_id = :job_id");

	define('_PDO_UPDATE_DEVICE_HOSTNAME_', "UPDATE `devices` SET device_hostname=:device_hostname WHERE device_id=:device_id");

	define('_PDO_INSERT_NEW_THREAD_LOG_', "
			INSERT INTO `threadlog` (devices_device_id, jobs_job_id, backups_backup_id, backup_status) 
			VALUES (:devices_device_id, :jobs_job_id, :backups_backup_id, :backup_status)");