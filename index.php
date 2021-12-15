<?php
include 'header.php';



try{
$pdo = new PDO('mysql:host=localhost;dbname=exam_pdo','root','');

$query = "SELECT * FROM artist";

$results = $pdo->prepare($query);

$results->execute();

$artists = $results->fetchAll(PDO::FETCH_ASSOC);

?>
    <div class="container w-70 mt-3">
        <table class="table table-striped table-primary table-hover">
            <thead>
            <tr>
                <th class="text-dark">Name</th>
                <th class="text-dark">Age</th>
                <th class="text-dark">Action</th>
            </tr>
            </thead>
            <tbody>
    <?php
    foreach($artists as $artist){
    ?>
                <tr>
                    <td class="text-dark"><?php echo $artist['name'] ?></td>
                    <td class="text-dark"><?php echo $artist['age'] ?></td>
                    <td class="text-dark">
                        <a href="artistDetails.php?id=<?php echo $artist['id'] ?>" class="text-decoration-none btn btn-primary">View more...</a>
                    </td>
                    <td class="text-dark">
                        <a href="modifyArtist.php?id=<?php echo $artist['id'] ?>" class="text-decoration-none btn btn-secondary">Edit</a>
                    </td>

                    <!-- Button modal -->
                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $artist['id'] ?>">
                        Delete artist
                        </button>
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?php echo $artist['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content bg-secondary">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">WARNING!!!</h5>
                                </div>
                                <div class="modal-body" style="color:black">
                                    Do you really want to delete this artist?
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" href="deleteArtist.php?id=<?php echo $artist['id'] ?>">Yes, I'm sure</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div>
            <a href="addArtist.php" class="btn btn-success mt-5">Add an artist</a>
        </div>
        <div>
            <a href="songs_list.php" class="btn btn-success mt-5">Songs list</a>
        </div>
    </div>


<?php

} catch (Exception $e) {
echo $e->getMessage();
}