<?php

if(isset($_GET['id'])){

    try{
        $pdo = new PDO('mysql:host=localhost;dbname=exam_pdo', 'root', '');

        $query = 'DELETE FROM song WHERE artist_id=:artist_id';
        $resultats = $pdo->prepare($query);

        $resultats->execute([
            ':artist_id' => $_GET['id']
        ]);

        header('location:index.php');

    } catch (Exception $e) {
        echo $e->getMessage();
    }

}

header('location: index.php');