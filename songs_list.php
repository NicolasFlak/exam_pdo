<?php
include 'header.php';
?>



<?php

try{
    $pdo = new PDO('mysql:host=localhost;dbname=exam_pdo','root','');

    if (isset($_POST['title'])){
        $query = "SELECT * FROM song JOIN artist ON song.artist_id = artist.id WHERE title LIKE :title";

        $resultats = $pdo->prepare($query);
        $resultats->execute([
            ':title' => '%'.$_POST["title"].'%'
        ]);

        $songs = $resultats->fetchAll(PDO::FETCH_ASSOC);

    } else {

        $query = "SELECT * FROM song JOIN artist ON song.artist_id = artist.id";

        $resultat = $pdo->prepare($query);

        $resultat->execute();

        $songs = $resultat->fetchAll(PDO::FETCH_ASSOC);

    }
        ?>
    <div class="container w-70 mt-3">

        <!-- Search form -->
        <form method="post" action="">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <input type="text" class="form-control mt-4" id="title" name="title" placeholder="Your search">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary my-2">Search</button>
            <?php
            if (isset($_POST['title'])){
                echo '<a href="songs_list.php" class="btn btn-danger">Cancel search</a>';
            }
            ?>
        </form>

        <!-- Table -->
        <table class="table table-striped table-primary table-hover">
            <thead>
            <tr>
                <th class="text-dark">Artist Name</th>
                <th class="text-dark">Title</th>
                <th class="text-dark">Time</th>
                <th class="text-dark">Published At</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($songs as $song){
                ?>
                <tr>
                    <td class="text-dark"><?php echo $song['name'] ?></td>
                    <td class="text-dark"><?php echo $song['title'] ?></td>
                    <td class="text-dark"><?php echo $song['time'] ?></td>
                    <td class="text-dark"><?php echo $song['published_at'] ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div>
            <a href="addNewSongFromSongsList.php" class="btn btn-secondary mt-5">Add a new song</a>
        </div>
        <div>
            <a href="index.php" class="btn btn-success mt-5">Return to the artists list</a>
        </div>
    </div>


        <?php

} catch (Exception $e) {
    echo $e->getMessage();
}