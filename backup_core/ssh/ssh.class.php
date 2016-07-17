<?php

	include_once ( __DIR__ . '/../inc/misc.php');

	class ssh {

		private $connection;
		private $stdio;
		private $ssh_host;
		private $ssh_port;
		private $ssh_auth_user;
		private $ssh_auth_pass;

		public $ssh_shell_term_type = 'xterm';
		public $ssh_shell_width = 160;
		public $ssh_shell_height = 1000;

		public function __construct($ssh_auth_user, $ssh_auth_pass, $ssh_host, $ssh_port = _DEFAULT_SSH_PORT_) {

			$this->ssh_host = $ssh_host;
			$this->ssh_port = $ssh_port;
			$this->ssh_auth_user = $ssh_auth_user;
			$this->ssh_auth_pass = $ssh_auth_pass;
		}

		public function connect() {

			// Connect
			if (!($this->connection = ssh2_connect($this->ssh_host, $this->ssh_port))) {
				throw new Exception('Cannot connect to server');
			}

			// Authorization
			if (!ssh2_auth_password($this->connection, $this->ssh_auth_user, $this->ssh_auth_pass )) {
				throw new Exception('Autentication rejected by server');
			}

			// Create Shell
			if (!($this->stdio = @ssh2_shell($this->connection, $this->ssh_shell_term_type, null, $this->ssh_shell_width, $this->ssh_shell_height, SSH2_TERM_UNIT_CHARS))) {
				throw new Exception('Failed to acquire SHELL');
			}

			// Flush stdin after login
			$data = "";
			while(true && isset($this->stdio)) {
				while ($line = fgets($this->stdio)) {
					$data .= $line;
					if (strstr($line, ">"))
						return $data;
				}
			}
			return $data;
        }

		public function exec($cmd) {
			$data = "";
			fwrite($this->stdio, $cmd . PHP_EOL);
			while( true && isset($this->stdio)) {
				while ($line = fgets($this->stdio)) {
					$data .= $line;
					if(substr_count($line,"#")==1 || strstr($line,">") || strstr($line,"d:") || strstr($line,"]?")) {
						return $data;
					}
				}
			}
			return $data;
		}

		public function disconnect() {
			if ($this->stdio) fclose($this->stdio);
			$this->connection = null;
		}

		public function __destruct() {
			$this->disconnect();
		}

	}