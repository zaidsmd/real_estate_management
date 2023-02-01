<?php
include "dbconfig.php"
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a5fdcae6a3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>House Miner</title>
</head>
<body>
<nav>
    <div id="logo">
        <img src="img/homehashtag.png" alt="">
        <h5>House Miner</h5>
    </div>
    <ul>
        <li><a><img src="img/home.png" alt="icon"> <span>Home</span></a></li>
        <li><a><img src="img/boards.png" alt="icon"> <span>Boards</span></a></li>
        <li class="active"  ><a><img src="img/listings.png" alt="icon"> <span>Listings</span></a></li>
        <li><a><img src="img/setting2.png" alt="icon"> <span>Settings</span></a></li>
    </ul>
    <div id="profile">
        <img src="img/profile.png" alt="profile">
        <span>User</span>
    </div>
</nav>
<main>
    <h2 class="title">Listings</h2>
    <div class="inputs">
        <button class="btn btn-primary" id="add"><span>Add</span><i class="fa-solid fa-plus"></i></button>
        <select name="type" id="type">
            <option value="0">Filter by type</option>
            <option value="S">For Sale</option>
            <option value="R">For Rent</option>
        </select>
        <div class="range">
            <label for="range_min">Min:</label>
            <input type="number" name="min" id="range_min">
        </div>
        <div class="range">
            <label for="range_max">Max:</label>
            <input type="number" name="max" id="range_max">
        </div>
        <button class="btn btn-primary" id="search"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div class="cards d-flex flex-wrap">
        <?php
        $statement =$conn->prepare("SELECT * FROM `annonces`");
        $statement->execute();
        $result = $statement->fetchAll();
        foreach ($result as $row){
            echo '
            <div class="card-container col-3">
           <div class="card">
               <img src="'.$row["annonce_image"].'" class="card-img-top" alt="'.$row["annonce_title"].'">
               <div class="card-body">
                   <h4 class="card-title">'.$row["annonce_title"].'</h4>
                   <div class="tags">
                       <div class="tag">'.$row["annonce_type"].'</div>
                       <div class="tag">'.$row["annonce_area"].'m²</div>
                       <div class="tag">'.$row["annonce_date"].'</div>
                   </div>
                   <div class="adresse">'.$row["annonce_adresse"].'</div>
                   <p class="price" >$'.number_format($row["annonce_price"],2,'.',',').'</p>
               </div>
           </div>
       </div>';
        }
        ?>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script>
    <?php
        echo "console.log(".json_encode($result).")";
    ?>;
</script>
</body>
</html>