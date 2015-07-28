<?php
/**
 * Created by PhpStorm.
 * User: Traci
 * Date: 7/27/2015
 * Time: 9:14 PM
 */


/**
 * Created by PhpStorm.
 * User: Traci
 * Date: 7/23/2015
 * Time: 7:40 PM
 */

//  url,   user,   pw,   name of database

$db = new mysqli("localhost", "root", "root", "blog");
if ($db->connect_errno) {
    echo "Failed to connect to MySQL :(<br>";
    echo $db->connect_error;
    exit();
}