<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../checkingFunctions/fail.php';
include_once '../checkingFunctions/missingReqParams.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

$isAnId = filter_input(INPUT_GET, "id");

 if (isset($isAnId) && $method == 'GET') {
    include('./author_read_single.php');
} 

 else if ($method == 'GET') {
    include('./authors.php');

} 

else if ($method == 'PUT') {
    include('./updateAuthor.php');
}


else if ($method == 'DELETE') {
    include('./deleteAuthor.php');
}

if ($method == 'POST') {
    include('./createAuthor.php');
}
?>