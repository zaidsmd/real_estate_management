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
           <div class="card"data-id="'.$row["annonce_id"].'"onclick=\'show('.json_encode($row).')\'>
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
    <div class="centerPoint">
        <dialog id="modal">
            <div class="modal-cnt">
                <div class="modal-img">
                    <img src="https://photos.zillowstatic.com/fp/6fba0ee9ec00fa7f5bbb00659b714e31-cc_ft_1536.webp"
                         alt="">
                </div>
                <div class="modal-body">
                    <h4 class="title">647m² house with garage</h4>
                    <div class="tags">
                        <div class="tag">For Sale</div>
                        <div class="tag">647m²</div>
                        <div class="tag">2023-02-31</div>
                    </div>
                    <div class="adresse">2441 S Fraser Street, Aurora</div>
                    <p class="modal-desc">
                        Located on a sunny, east-facing lot in Aurora’s Chaddsford neighborhood, this contemporary home
                        balances modern updates and timeless charm. Tons of natural light, a fresh neutral palette and
                        beautiful hardwood floors seamlessly connect the main living spaces. The gas fireplace acts as
                        the focal point to the inviting living room and the formal dining room is ideal for
                        entertaining. The updated galley kitchen includes butcherblock counters, new cabinetry and easy
                        access to the backyard through the large sliding glass door.
                    </p>
                    <p class="price">$475,000.00</p>
                    <div class="buttons">
                        <button class="btn btn-primary " type="button" id="delete">Delete</button>
                        <button class="btn btn-primary" id="edit" >Edit</button>
                    </div>
                    <button id="close"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
        </dialog>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script >
    function show(data) {
        document.querySelector('#modal').showModal()
        document.querySelector('.modal-img img').src= data["annonce_image"];
        document.querySelector('#modal .title').innerHTML= data["annonce_title"];
        document.querySelector('#modal .tag:first-child').innerHTML= data["annonce_type"];
        document.querySelector('#modal .tag:last-child').innerHTML= data["annonce_date"];
        document.querySelector('#modal .tag:nth-child(2)').innerHTML= data["annonce_date"];
        document.querySelector('#modal .adresse').innerHTML= data["annonce_adresse"];
        document.querySelector('#modal .modal-desc').innerHTML= data["annonce_description"];
    }
    document.querySelector('#close').addEventListener('click',e=>{
        document.querySelector('#modal').close();
    })
</script>
</body>
</html>