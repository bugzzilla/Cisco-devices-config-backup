<?php

    	file_put_contents('/tmp/cron.tmp.txt', '*/30 * * * * php /var/www/html/cisco-backup/backup_core/rub_backup.php 1 10 >> /var/log/cisco_backup.log');

    	//exec('/usr/bin/crontab /tmp/cron.tmp.txt', $resp, $return_var);
    	//print_r($resp);
    	//print_r($return_var);
    	 
    
    	exec('/usr/bin/crontab -u root -l', $resp, $return_var);
    	print_r($resp);
    	print_r($return_var);    	
    
    	exec('id', $resp, $return_var);
    	print_r($resp);
    	print_r($return_var);