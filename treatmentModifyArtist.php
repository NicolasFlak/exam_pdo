
<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=exam_pdo', 'root', '');
    if (isset($_POST['name']) && isset($_POST['age'])) {
        $query = "UPDATE artist SET name=:name,age=:age WHERE `id`=:artist_id";

        $resultats = $pdo->prepare($query);
        $resultats->execute([
            ':artist_id' => $_POST['id'],
            ':name' => $_POST["name"],
            ':age' => $_POST["age"]
        ]);
        header('location: index.php');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}



