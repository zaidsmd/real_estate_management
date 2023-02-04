<?php
//I will leave a comment in every important part of code so u can just skip the long html parts without being afraid of not understanding the code
include "php/dbconfig.php"; //connect to database;
include "php/head.php"; // include html head and navbar
?>
    <main>
        <h2 class="title">Listings</h2>
        <div class="inputs">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal" id="add"><span>Add</span><i
                        class="fa-solid fa-plus"></i></button>
            <form id="search-form" action="index.php" method="get">
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
            // it is necessary to check is it search or first load to know what data to get from DB;
            if (isset($_GET["check"])) {
                $max = ($_GET["max"]);
                $min = ($_GET["min"]);
                $type = $_GET["type"];
                // here I had to check all inputs to get the right data;
                if ($_GET["type"] != 0) {
                    if ($max != '') {
                        if ($min == ''){
                            $min = 0;
                        }
                        $statement = $conn->prepare("SELECT * FROM `annonces` WHERE annonce_type = '$type' AND annonce_price BETWEEN '$min' AND '$max' ORDER BY annonce_date DESC");
                        $statement->execute();
                        $result = $statement->fetchAll();
                        createCard($result);
                    }else {
                        $statement = $conn->prepare("SELECT * FROM `annonces` WHERE annonce_type = '$type' ORDER BY annonce_date DESC");
                        $statement->execute();
                        $result = $statement->fetchAll();
                        createCard($result);
                    }
                } else {
                    if ($max != '') {
                        if ($min == ''){
                            $min = 0;
                        }
                        $statement = $conn->prepare("SELECT * FROM `annonces` WHERE annonce_price BETWEEN '$min' AND '$max' ORDER BY annonce_date DESC");
                        $statement->execute();
                        $result = $statement->fetchAll();
                        createCard($result);
                    }else {
                        $statement = $conn->prepare("SELECT * FROM `annonces` ORDER BY `annonce_date` DESC");
                        $statement->execute();
                        $result = $statement->fetchAll();
                        createCard($result);
                    }

                }
            } else {
                //here is normal page load without any actions getting the data and use the create function to create the cards
                $statement = $conn->prepare("SELECT * FROM `annonces` ORDER BY `annonce_date` DESC");
                $statement->execute();
                $result = $statement->fetchAll();
                createCard($result);
            }
            ?>
        </div>
        <?php include "php/modals.php" ?>
    </main>
<?php
include "php/scripts.php" // including all javascript scripts
?>
    </body>
    </html>
<?php
//######### Functions ###########
//just one function that take the data fetched from DB and loop on it creating html cards with data
function createCard($data)
{
    // I had to check if there is data bcs we have search data too,
    // if there is no matching data requested the user should know, so he doesn't think that the website is broken;
    if ($data != null) {
        foreach ($data as $row) {
            //you can notice that there is onclick function that takes the all data of the card and pass it to the js to be used onclick to affiche all data
            echo '
            <div class="card-container ">
           <div class="card" data-id="' . $row["annonce_id"] . '"onclick=\'show(' . json_encode($row). ')\' data-bs-toggle="modal" data-bs-target="#modal">
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
    } else {
        echo "<div class='notFound d-flex flex-column gap-2'>
                <i class='fa-solid fa-house-circle-xmark'></i>
                <h2>Sorry there is no matching annonces at the moment</h2>
               </div>";
    }
}

