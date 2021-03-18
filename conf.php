<?php
    /**
     *  Conf DB yoopi
     */
        #usuario
        $userDB='root');
        #password
        $passDB'dbkey';
        #DBname
        $nameDB='yoopi';
        #define('nameDB','yoopi');
        #host
        $hostDB='localhost';
        #define('hostDB','localhost');
        
        #db
        $DB= Pnew PDO("mysql:host=$hostDB; dbname=$nameDB",$userDB,$passDB,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
?>