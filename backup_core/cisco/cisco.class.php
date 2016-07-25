		<?php

    require_once ( __DIR__ . '/../ssh/ssh.class.php');
	include_once ( __DIR__ . '/../inc/misc.php');

    class cisco {

        private $ssh_terminal = null;
        private $cisco_secret = '';
        private $cisco_level = 'user';

        public $cisco_hostname;
        public $cisco_banner;

        public function __construct($cisco_secret, $ssh_auth_user, $ssh_auth_pass, $ssh_host, $ssh_port = _DEFAULT_SSH_PORT_) {

            $this->cisco_secret = $cisco_secret;
            $this->ssh_terminal = new ssh($ssh_auth_user, $ssh_auth_pass, $ssh_host, $ssh_port);
            $data = explode(PHP_EOL, $this->ssh_terminal->connect());
            $this->cisco_hostname = rtrim($data[count($data)-1],">");
            unset($data[count($data)-1]);
            $this->cisco_banner = rtrim(implode(PHP_EOL, $data),"\r\n");
        }

        public function dir($url) {

            if ($this->enter_privileged()) {
                $data = $this->suppress_terminal_echo($this->ssh_terminal->exec("dir " . $url));
                if (!strstr($data, 'Invalid')) {
                    $dir = array();
                    $data = explode(PHP_EOL, $data);
                    array_splice($data, -2);
                    array_splice($data, 0, 2);
                    foreach ($data as $item) {
                        $item = array_values(array_filter(explode("\x20", $item)));
                        if (count($item) == 9)
                            $dir[] = array(	"type" => $item[1], 
                            				"name" => trim($item[8],"\r\n"), 
                            				"size" => $item[2], 
                            				"datetime" => date_create_from_format(_CISCO_DATE_TIME_FORMAT_, $item[4].' '.$item[3].' '.$item[5].' '.$item[6].' '.$item[7])->format(_LOG_DATE_TIME_FORMAT_));
                    }
                    return $dir;
                } else throw new Exception('Invalid input detected');
            } else throw new Exception('Access denied');
        }

        public function copy($source, $destination) {
            if ($this->enter_privileged()) {
                $data = $this->ssh_terminal->exec("copy " . $source . " " . $destination);
                $data .= $this->ssh_terminal->exec('');
                $data .= $this->ssh_terminal->exec('');
                if (strstr($data, "copied")) {
                    return true;
                } else return false;
            } else throw new Exception('Copy access denied');
        }

        public function show_running_config() {

            if ($this->enter_privileged())
                return $this->suppress_terminal_echo($this->ssh_terminal->exec('show running-config'));
            else throw new Exception('Access denied');
        }

        public function copy_running_config($destination) {

            if ($this->enter_privileged()) {
                return $this->suppress_terminal_echo($this->ssh_terminal->exec('show running-config | redirect ' . $destination));
            } else throw new Exception('Access denied');
        }


        public function enter_privileged() {
            if (!$this->cisco_level !== 'privileged') {
                $this->get_level();
                if ($this->cisco_level == 'user') {
                    $this->ssh_terminal->exec('enable');
                    if (strstr($this->ssh_terminal->exec($this->cisco_secret),'denied'))
                        throw new Exception('Failed to enter privileged mode');
                } elseif ($this->cisco_level == 'global') {
                    $this->ssh_terminal->exec('exit');
                } elseif ($this->cisco_level == 'interface') {
                    $this->ssh_terminal->exec('exit');
                    $this->ssh_terminal->exec('exit');
                }
                $this->cisco_level = 'privileged';
            }
            return true;
        }

        public function get_level() {

            $data = $this->ssh_terminal->exec('');
            if (strstr($data,'(config-if)#')) {
                $this->cisco_level = 'interface';
            } elseif (strstr($data,'(config)#')) {
                $this->cisco_level = 'global';
            } elseif (strstr($data,'#')) {
                $this->cisco_level = 'privileged';
            } elseif (strstr($data,'>')) {
                $this->cisco_level = 'user';
            }
        }

        public function suppress_terminal_echo($data) {

            $data = explode(PHP_EOL, $data);
            unset($data[0]);
            unset($data[count($data)]);
            return rtrim(implode(PHP_EOL, $data),"\r\n");
        }

    }

