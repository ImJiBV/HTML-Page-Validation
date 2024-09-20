<?php

function OpenConn()
    {
        $server = 'localhost';
        $user = 'root';
        $pass = 'iEA7TUEJrRJgTSs8';
        $dbase = 'test_dbase';

        try {
            $dbconn = new PDO("mysql:host=$server;dbname=$dbase", $user, $pass);
            
            $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $dbconn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function CloseConn($dbconn){
        $dbconn -> close();
    }

?>
