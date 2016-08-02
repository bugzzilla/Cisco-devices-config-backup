<?php

	require_once(__DIR__.'/backup_controller/backup_controller.class.php');

    if (count ($argv) <3) die ("Usage: run_backup.php <template_id> <devices_per_backup_thread>\n");

	$cntr = new backup_controller($argv[1], $argv[2]);
	$cntr->run();

	echo "---------------------------------------------------------------\n";
?>