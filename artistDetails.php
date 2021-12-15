<?php

include 'header.php';

if(isset($_GET['id'])){
    $artistId = $_GET['id'];
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=exam_pdo', 'root', '');

        $query = 'SELECT * FROM song WHERE artist_id=:artist_id';
        $resultats = $pdo->prepare($query);
        $resultats->execute([
            ':artist_id' => $artistId
        ]);

        $rows = $resultats->fetchAll(PDO::FETCH_ASSOC);

        $queryName = 'SELECT artist.id, artist.name FROM artist WHERE artist.id=:artist_id';
        $result = $pdo->prepare($queryName);
        $result->execute([
            ':artist_id' => $artistId
        ]);

        $row = $result->fetch(PDO::FETCH_ASSOC);

        $queryName = 'SELECT artist.id, artist.name FROM artist JOIN song ON song.artist_id=artist.id WHERE artist.id=:artist_id';
        $result = $pdo->prepare($queryName);
        $result->execute([
            ':artist_id' => $artistId
        ]);

        $name = $result->fetch(PDO::FETCH_ASSOC);

        ?>
        <div class="container w-50 p-0 mt-5">
            <div class="card bg-info pt-5">
                <h1 class="text-center my-5"><?php echo $name['name'] ?></h1>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <?php
                        if(!empty($rows)){
                        ?>
                        <tr>
                            <th class="text-dark">Title</th>
                            <th class="text-dark">Time(in seconds)</th>
                            <th class="text-dark">Published At</th>
                            <th class="text-dark">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($rows as $item){
                            ?>
                                <tr>
                                    <td class="text-dark"><?php echo $item['title'] ?></td>
                                    <td class="text-dark"><?php echo $item['time'] ?></td>
                                    <td class="text-dark"><?php echo $item['published_at'] ?></td>
                                        <!-- Button modal -->
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id'] ?>">
                                            Delete this song
                                        </button>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-secondary">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">WARNING!!!</h5>
                                                </div>
                                                <div class="modal-body" style="color:black">
                                                    Do you really want to delete this song?
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-success" href="artistDetails.php?id=<?php echo $rows['id'] ?>">No</a>
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-danger" href="deleteSong.php?id=<?php echo $row['id'] ?>">Yes, I'm sure</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<p>L\'artiste ' . $name['name'] . ' n\'a pas de musique.</p>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <a href="addSong.php?id=<?php echo $row['id'] ?>" class="btn btn-success">Add a song</a>
            </div>

        <?php

    } catch (Exception $e) {
        echo $e->getMessage();
    }

} else {
    header('location: index.php');
}



