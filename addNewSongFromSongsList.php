<?php

include 'header.php';

$pdo = new PDO('mysql:host=localhost;dbname=exam_pdo','root','');

$query = "SELECT * FROM artist";

$results = $pdo->prepare($query);

$results->execute();

$artists = $results->fetchAll(PDO::FETCH_ASSOC);


?>


<div class="container">
    <div class="row">
        <div class="col-4">
            <form method="post" action="treatmentAddNewSongFromSongsList.php">
<!--                <div class="form-group">-->
<!--                    <label for="artistId">Artist Id</label>-->
<!--                    <input type="number" class="form-control mt-2" id="artistId" name="artist_id">-->
<!--                </div>-->

                <div class="mb-3">
                    <label for="author" class="form-label <?php if(isset($_GET['id'])){ echo 'd-none';} ?>">Song's Artist</label>
                    <select <?php if(isset($_GET['id'])){ echo 'class="d-none"';} ?> name="artist_id" id="author">
                        <?php
                        foreach ($artists as $artist) {
                            echo '<option value=" ' . $artist['id'] . ' ">' . $artist['name'] . '</option>';
                        }
                        ?>
                    </select>
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
                    <label for="published_At">Published_At</label>
                    <input type="date" class="form-control mt-2" id="published_At" name="published_at">
                </div>
                <button type="submit" class="btn btn-primary my-2">Ajouter</button>
            </form>
        </div>
    </div>
</div>