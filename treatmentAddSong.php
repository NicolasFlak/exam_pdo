<?php


try{
    $id=$_GET['id'];
    var_dump($id);
    $pdo = new PDO('mysql:host=localhost;dbname=exam_pdo', 'root', '');
    if (isset($_GET['id']) && isset($_POST['title']) && isset($_POST['time']) && isset($_POST['published_at'])){
        $query = "INSERT INTO song (id, title, time, published_at) VALUES (:id, :title, :time, :published_at)";
        var_dump($id);
        $resultats = $pdo->prepare($query);
        $resultats->execute([
            ':id' => $id,
            ':title' => $_POST["title"],
            ':time' => $_POST["time"],
            ':published_at' => $_POST["published_at"]
        ]);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

header('location: artistDetails.php?id=$id');