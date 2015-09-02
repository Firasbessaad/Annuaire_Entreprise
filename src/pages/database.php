<?php

// We will use PDO to execute database stuff. 
// This will return the connection to the database and set the parameter
// to tell PDO to raise errors when something bad happens
function getDbConnection() {
  $db = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER . ";charset=utf8", DB_USER, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
  return $db;
}

// This is the 'search' function that will return all possible rows starting with the keyword sent by the user
function serachForKeyword($keyword) {
  
    $db = getDbConnection();
    $stmt = $db->prepare("SELECT name_en as country FROM `words` WHERE name_en LIKE ? ORDER BY country");

    $keyword = $keyword . '%';
    $stmt->bindParam(1, $keyword, PDO::PARAM_STR, 100);

    $isQueryOk = $stmt->execute();
  
    $results = array();
    
    if ($isQueryOk) {
      $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } else {
      
      trigger_error('Error executing statement.', E_USER_ERROR);
    }

    $db = null; 

    return $results;
}
function serachForcompany($company) {
  
    $db = getDbConnection();
    $stmt = $db->prepare("SELECT name_en as country FROM `company` WHERE name_en LIKE ? ORDER BY country");

    $company = $company . '%';
    $stmt->bindParam(1, $company, PDO::PARAM_STR, 100);

    $isQueryOk = $stmt->execute();
  
    $results = array();
    
    if ($isQueryOk) {
      $results = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } else {
      
      trigger_error('Error executing statement.', E_USER_ERROR);
    }

    $db = null; 

    return $results;
}
