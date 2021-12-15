<?php

include 'header.php';

?>


<div class="container">
    <div class="row">
        <div class="col-4">
            <form method="post" action="treatmentAdd.php">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control mt-2" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" class="form-control mt-2" id="age" name="age">
                </div>
                <button type="submit" class="btn btn-primary my-2">Ajouter</button>
            </form>
        </div>
    </div>
</div>

