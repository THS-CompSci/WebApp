<?php
$connection =null;
    function DBConnect($serverName,$serverUsername,$serverPassword,$dbName){
        global $connection;
        $connection=mysqli_connect($serverName,$serverUsername,$serverPassword,$dbName);
    }
    function createQuery($databaseQuery){
        global $connection;
        return mysqli_query($connection,$databaseQuery);
    }
    function getConnection(){
        global $connection;
        return $connection;
    }
?>