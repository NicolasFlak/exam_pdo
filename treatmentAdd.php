<?php


try{
    $pdo = new PDO('mysql:host=localhost;dbname=exam_pdo', 'root', '');
    if (isset($_POST['name']) && isset($_POST['age'])){
        $query = "INSERT INTO artist(name, age) VALUES (:name, :age)";

        $resultats = $pdo->prepare($query);
        $resultats->execute([
            ':name' => $_POST["name"],
            ':age' => $_POST["age"]
        ]);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

header('location: index.php');