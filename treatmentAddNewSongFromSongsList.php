<?php


try{
    $pdo = new PDO('mysql:host=localhost;dbname=exam_pdo', 'root', '');
    if (isset($_POST['artist_id']) && isset($_POST['title']) && isset($_POST['time']) && isset($_POST['published_at'])){
        $query = "INSERT INTO song (artist_id, title, time, published_at) VALUES (:artist_id, :title, :time, :published_at)";

        $resultats = $pdo->prepare($query);
        $resultats->execute([
            ':artist_id' => $_POST["artist_id"],
            ':title' => $_POST["title"],
            ':time' => $_POST["time"],
            ':published_at' => $_POST["published_at"]
        ]);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

header('location: songs_list.php');