<?php

include 'header.php';


try {
    $pdo = new PDO('mysql:host=localhost;dbname=exam_pdo', 'root', '');

    $query = 'SELECT * FROM artist WHERE id = :artist_id';
    $resultats = $pdo->prepare($query);

    $resultats->execute([
        ':artist_id' => $_GET['id']
    ]);

    $row = $resultats->fetch(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo $e->getMessage();
}


?>

<div class="container">
    <div class="row">
        <div class="col-4">

            <form method="post" action="treatmentModifyArtist.php">
                <div class="form-group">
                    <label for="name" style="color:white">Name</label>
                    <input type="text" class="form-control mt-2" id="name" name="name"
                           value="<?php echo $row['name'] ?>">
                </div>
                <div class="form-group">
                    <label for="age" style="color:white">Age</label>
                    <input type="number" class="form-control mt-2" id="age" name="age"
                           value="<?php echo $row['age'] ?>">
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control mt-2" id="type" name="id" value="<?php echo $row['id'] ?>">
                </div>
                <button type="submit" class="btn btn-primary my-2">Modifier</button>
            </form>

        </div>
    </div>
</div>

