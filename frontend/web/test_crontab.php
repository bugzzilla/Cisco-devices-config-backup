<?php

    	exec('crontab -l', $resp, $return_var);
    	print_r($resp);
    	print_r($return_var);