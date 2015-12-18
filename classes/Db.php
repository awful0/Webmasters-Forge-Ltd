<?php

namespace app\classes;

class Db {

    /********* Подключаемся к БД и выполняем запрос *********/
    
    protected $dbh;

    public function __construct(){

        $config = include __DIR__ . '/../config/db.php';
        $dsn = 'mysql:dbname=' . $config['dbname'] . ';host=' . $config['host'];
		$this->dbh = new \PDO($dsn, $config['user'], $config['password']);

    }


    public function execute($sql, $params=[], $ins=0){

        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($params);
        return ($ins) ? $result : $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    
}