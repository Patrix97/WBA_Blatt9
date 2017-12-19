<?php
/**
 * Script to query a MySQL database. This script is not safe against SQL-injection. 
 * Please do not use it for real applications.
 *
 * PHP version 5.6
 *
 * @category None
 * @package  None
 * @author   Ludger Martin <ludger.martin@hs-rm.de>
 * @license  Apache License 2.0 http://www.apache.org/licenses/LICENSE-2.0
 * @version  1.0 
 * @link     none
 */
// configuration
$database = 'wba...';
$dbuser = 'wba...';
$dbpassword = 'password';

// handle query algorithm
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        // initialize database
        $db = new PDO("mysql:host=localhost;dbname=$database", $dbuser, $dbpassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->prepare('SET NAMES utf8');
        $stmt->execute();
        $stmt = $db->prepare('SET CHARACTER SET utf8');
        $stmt->execute();

        // handle post body
        $body = file_get_contents('php://input');
        
        // execute database query
        $stmt = $db->prepare($body);
        $stmt->execute();
        if (preg_match('/SELECT.*FROM/iu', $body)) {
            $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        } else {
            $result = true;
        }
        // encode to json
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    } catch (Exception $e) {
        // error handling
        header('HTTP/1.0 500 Internal Server Error');
        echo $e->getMessage();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // print documentation  
    echo '<DOCTYPE html>
<html>
<head>
    <title>MySQL Web Service</title>
</head>
<body>
    <h1>MySQL Web Service</h1>
    <p>To call this service use the <em>post</em>-method. 
       Provide the MySQL-query in the post body. The result will be
       JSON-encoded with <em>utf-8</em> encoding.
    </p>
    <p>This script is not safe against SQL-injection. 
       Please do not use it for real applications.
    </p>
</body>
</html>';
} else {
    // no other function is implemented
    header('HTTP/1.0 501 Not Implemented');
}