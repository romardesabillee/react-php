<?php
require_once 'config.php';
require_once 'DB.php';

$dbInstance = DB::getInstance();

// GET ALL DATA
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    // $statement = $dbInstance->db->prepare("select * from todo");
    $statement = $dbInstance->db->prepare(
        "SELECT * FROM todo t left join todo_details td on t.id = td.todo_id"
    );
    $statement->execute();
    $result = $statement->fetchAll();
    echo json_encode($result);

}else if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // CREATE DATA
    $statement = $dbInstance->db->prepare(
        "insert into todo (title, description) values (:title, :description)");
    $statement->execute([
        ':title' => $fe_data['title'],
        ':description' => $fe_data['description'],
    ]);

    // GET LAST INSERTED DATA
    $statement = $dbInstance->db->prepare("select * from todo where id = :id");
    $statement->execute([
        ':id' => $dbInstance->db->lastInsertId()
    ]);
    $result = $statement->fetchAll();
    echo json_encode($result[0]);
}


//update
// $statement = $pdo->prepare("select * from todo where id = :id");
// $statement->execute([':id' => 4]);
// $result = $statement->fetchAll();
// print_r($result[0]->title);

