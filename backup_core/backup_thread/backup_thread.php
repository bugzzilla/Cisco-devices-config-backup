<?php

	require_once ('backup_thread.class.php');

	$backup_thread = new backup_thread($argv[1]);
	if ($backup_thread)	$backup_thread->run_backup();