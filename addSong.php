<?php

include 'header.php';
try {
    $id=$_GET['id'];

    $pdo = new PDO('mysql:host=localhost;dbname=exam_pdo', 'root', '');

    $query = 'SELECT artist.id, artist.name FROM artist JOIN song ON artist.id=song.artist_id WHERE artist.id=:artist_id';
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
            <form method="post" action="treatmentAddSong.php?id=<?php echo $id ?>">
                <div class="form-group hidden d-none">
                    <input type="number" class="form-control mt-2" id="artistId" name="artistId" value="<?php $row['id'] ?>" placeholder="<?php $row['id'] ?>">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control mt-2" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="number" class="form-control mt-2" id="time" name="time">
                </div>
                <div class="form-group">
                    <label for="published_at">Published_at</label>
                    <input type="date" class="form-control mt-2" id="published_at" name="published_at">
                </div>
                <button type="submit" class="btn btn-primary my-2">Ajouter</button>
            </form>
        </div>
    </div>
</div>

