<?php

	require_once('./backup_controller/backup_controller.class.php');

    if (count ($argv) <3) die ("Usage: test_backup.php <template_id> <devices_per_backup_thread>\n");

	$cntr = new backup_controller($argv[1], $argv[2]);
	$cntr->run();

?>