<?php

class DB{

    private $connection;

    public function __construct($host = 'localhost', $user = 'root', $pass = '', $dbName = 'praca', $charset = 'utf8'){
        $this->connection = new mysqli($host,$user,$pass,$dbName);
        if ($this->connection->connect_error) {
			die('Błąd połączenia - ' . $this->connection->connect_error);
        }
        $this->connection->set_charset($charset);
    }
    public function select($arr_fields,$table){
            $fileds = implode($arr_fields,',');
            $result = $this->connection->query('SELECT '.$fileds.' FROM '.$table);
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    public function select_where($arr_fields,$table,$statement,$value){
            $fileds = implode($arr_fields,',');
            $result = $this->connection->query('SELECT '.$fileds.' FROM '.$table.' WHERE '.$statement.' = '.$value);
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        public function query($query) {
            if ($this->query = $this->connection->prepare($query)) {
                if (func_num_args() > 1) {
                    $x = func_get_args();
                    $args = array_slice($x, 1);
                    $types = '';
                    $args_ref = array();
                    foreach ($args as $k => &$arg) {
                        if (is_array($args[$k])) {
                            foreach ($args[$k] as $j => &$a) {
                                $types .= $this->_gettype($args[$k][$j]);
                                $args_ref[] = &$a;
                            }
                        } else {
                            $types .= $this->_gettype($args[$k]);
                            $args_ref[] = &$arg;
                        }
                    }
                    array_unshift($args_ref, $types);
                    call_user_func_array(array($this->query, 'bind_param'), $args_ref);
                }
                $this->query->execute();
                   if ($this->query->errno) {
                    die('Nieprawidłowe dane - ' . $this->query->error);
                   }
            } else {
                die('Nieprawidłowa kwerenda - ' . $this->connection->error);
            }
        }
}
