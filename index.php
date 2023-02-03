<?php
include "php/dbconfig.php";
include "php/head.php";
?>
    <main>
        <h2 class="title">Listings</h2>
        <div class="inputs">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal" id="add"><span>Add</span><i
                        class="fa-solid fa-plus"></i></button>
            <form action="index.php" method="get">
                <label for="type" style="display: none">type</label>
                <select name="type" id="type">
                    <option value="0">Filter by type</option>
                    <option value="For Sale">For Sale</option>
                    <option value="For Rent">For Rent</option>
                </select>
                <div class="inputs-container">
                    <div class="range">
                        <label for="range_min">Min:</label>
                        <input type="number" name="min" id="range_min" value="0">
                    </div>
                    <div class="range">
                        <label for="range_max">Max:</label>
                        <input type="number" name="max" id="range_max" value="3000000000">
                    </div>
                    <button type="submit" class="btn btn-primary" id="search"><i
                                class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input type="text" name="check" value="true" style="display: none">
            </form>
        </div>
        <div class="cards d-flex flex-wrap justify-content-lg-around justify-content-md-around">
            <?php
            if (isset($_GET["check"])) {
                $max = ( $_GET["max"]);
                $min = ( $_GET["min"]);
                $type = $_GET["type"];
                if (isset($_GET["max"]) && isset($_GET["min"]) && $_GET["type"] != 0) {
                    $statement = $conn->prepare("SELECT * FROM `annonces` WHERE annonce_type = '$type' AND annonce_price BETWEEN $min AND $max");
                } else {
                    $statement = $conn->prepare("SELECT * FROM `annonces` WHERE annonce_price BETWEEN $min AND $max");
                }
                $statement->execute();
                $result = $statement->fetchAll();
                createCard($result);
            } else {
                $statement = $conn->prepare("SELECT * FROM `annonces`");
                $statement->execute();
                $result = $statement->fetchAll();
                createCard($result);
            }
            ?>
        </div>
        <?php include "php/modals.php"?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <script src="script/script.js"></script>
    <script>
        <?php
        if (isset($_GET["check"])) {
            echo "
            document.querySelector('#range_min').value = " . $_GET["min"] . ";
            document.querySelector('#range_max').value = " . $_GET["max"] . ";
            document.querySelector('option[value=\"" . $_GET["type"] . "\"]').setAttribute('selected','');
            ";
        }
        ?>
    </script>
    </body>
    </html>
<?php
function createCard($data){
    if ($data != null){
        foreach ($data as $row) {
            echo '
            <div class="card-container ">
           <div class="card" data-id="' . $row["annonce_id"] . '"onclick=\'show(' . json_encode($row) . ')\' data-bs-toggle="modal" data-bs-target="#modal">
               <img src="pictures/' . $row["annonce_image"] . '" class="card-img-top" alt="' . $row["annonce_title"] . '">
               <div class="card-body">
                   <h4 class="card-title">' . $row["annonce_title"] . '</h4>
                   <div class="tags">
                       <div class="tag">' . $row["annonce_type"] . '</div>
                       <div class="tag">' . $row["annonce_area"] . 'm²</div>
                       <div class="tag">' . $row["annonce_date"] . '</div>
                   </div>
                   <div class="adresse">' . $row["annonce_adresse"] . '</div>
                   <p class="price" >$' . number_format($row["annonce_price"], 2) . '</p>
               </div>
           </div>
       </div>';
        }
    }else {
        echo "<div class='notFound d-flex flex-column gap-2'>
                <i class='fa-solid fa-house-circle-xmark'></i>
                <h2>Sorry there is no matching annonces at the moment</h2>
               </div>";
    }
}

