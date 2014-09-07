<?php
/**
 * Created by PhpStorm.
 * User: HaiderHassan
 * Date: 9/3/14
 * Time: 9:52 PM
 */
header('Access-Control-Allow-Origin: *');
try {
    $conn = new PDO('mysql:host=localhost;dbname=houserentsystem;charset=utf8', 'root', 'admin');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
if($_POST['searchFilter']){
    $searchFilter = $_POST['searchFilter'];
    $stmt = $conn->prepare("SELECT roomName, roomNo FROM roomnames WHERE roomName LIKE ? OR roomNo LIKE ?");
    $stmt->execute(array('%'.$searchFilter.'%','%'.$searchFilter.'%' ));
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    if (empty($results)){
      print_r(json_encode(0));
    }
    else{
    print_r(json_encode($results));
    }
}
