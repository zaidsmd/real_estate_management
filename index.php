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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
              crossorigin="anonymous">
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
            <li class="active"><a><img src="img/listings.png" alt="icon"> <span>Listings</span></a></li>
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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal" id="add"><span>Add</span><i
                        class="fa-solid fa-plus"></i></button>
            <form action="index.php" method="get">
                <select name="type" id="type">
                    <option value="0">Filter by type</option>
                    <option value="For Sale">For Sale</option>
                    <option value="For Rent">For Rent</option>
                </select>
                <div class="range">
                    <label for="range_min">Min:</label>
                    <input type="number" name="min" id="range_min" value="0">
                </div>
                <div class="range">
                    <label for="range_max">Max:</label>
                    <input type="number" name="max" id="range_max" value="3000000000">
                </div>
                <input type="text" name="check" value="true" style="display: none">
                <button type="submit" class="btn btn-primary" id="search"><i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="cards d-flex flex-wrap">
            <?php
            if (isset($_GET["check"])) {
                $max = $_GET["max"];
                $min = $_GET["min"];
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
        <div id="modal" class="modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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
                            Located on a sunny, east-facing lot in Aurora’s Chaddsford neighborhood, this contemporary
                            home
                            balances modern updates and timeless charm. Tons of natural light, a fresh neutral palette
                            and
                            beautiful hardwood floors seamlessly connect the main living spaces. The gas fireplace acts
                            as
                            the focal point to the inviting living room and the formal dining room is ideal for
                            entertaining. The updated galley kitchen includes butcherblock counters, new cabinetry and
                            easy
                            access to the backyard through the large sliding glass door.
                        </p>
                        <p class="price">$475,000.00</p>
                        <div class="buttons">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#del-modal"  type="button" id="delete">Delete</button>
                            <button class="btn btn-primary" id="edit" data-bs-toggle="modal" data-bs-target="#modify-modal">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="del-modal" class="modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    <div class="modal-body">
                        <h4 class="title">Do you really want to delete this annonce ?</h4>
                        <form action="delete.php" method="post">
                            <input type="text" name="annonce_id" id="annonce_id" style="display: none">
                            <button data-bs-dismiss="modal" type="button" class="btn btn-primary">Cancel</button>
                            <input type="submit" name="delete" id="Delete" class="btn btn-primary" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="modify-modal" class="modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    <div class="modal-body">
                        <h4 class="title">Edit the annonce</h4>
                        <p>Please fill every input all inputs are required.</p>
                        <form action="edit.php" method="post" enctype="multipart/form-data">
                            <div class="input-group">
                                <div class="input">
                                    <label for="title_modify">Annonce title</label>
                                    <input type="text" id="title_modify" maxlength="40" name="title">
                                </div>
                                <div class="input">
                                    <label for="adresse_modify">Annonce adresse</label>
                                    <input type="text" maxlength="50" id="adresse_modify" name="adresse">
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input">
                                    <label for="area_modify">Annonce area(m²)</label>
                                    <input type="text" maxlength="11" id="area_modify" name="area">
                                </div>
                                <div class="input">
                                    <label for="price_modify">Annonce price</label>
                                    <input type="text" maxlength="11" id="price_modify" name="price">
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input">
                                    <label for="type_modify">Annonce type</label>
                                    <select name="type" id="type_modify">
                                        <option value="For Sale">For Sale</option>
                                        <option value="For Rent">For Rent</option>
                                    </select>
                                </div>
                                <div class="input">
                                    <label for="image_modify">Annonce image (jpg-png-jpeg)</label>
                                    <input type="file" id="image_modify" name="image">
                                </div>
                            </div>
                            <div class="input">
                                <label for="description_modify">Annonce description</label>
                                <textarea name="description"  maxlength="800" id="description_modify" rows="5"></textarea>
                            </div>
                            <input type="text" name="annonce_id" id="modify_id">
                            <input class="btn btn-primary" type="submit" value="Edit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="add-modal" class="modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    <div class="modal-body">
                        <h4 class="title">Add new annonce</h4>
                        <p>Please fill every input all inputs are required.</p>
                        <form action="add.php" method="post" enctype="multipart/form-data">
                            <div class="input-group">
                                <div class="input">
                                    <label for="title_add">Annonce title</label>
                                    <input type="text" id="title_add" maxlength="40" name="title">
                                </div>
                                <div class="input">
                                    <label for="adresse_add">Annonce adresse</label>
                                    <input type="text" maxlength="50" id="adresse_add" name="adresse">
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input">
                                    <label for="area_add">Annonce area(m²)</label>
                                    <input type="text" maxlength="11" id="area_add" name="area">
                                </div>
                                <div class="input">
                                    <label for="price_add">Annonce price</label>
                                    <input type="text" maxlength="11" id="price_add" name="price">
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input">
                                    <label for="type_add">Annonce type</label>
                                    <select name="type" id="type_add">
                                        <option value="For Sale">For Sale</option>
                                        <option value="For Rent">For Rent</option>
                                    </select>
                                </div>
                                <div class="input">
                                    <label for="image_add">Annonce image (jpg-png-jpeg)</label>
                                    <input type="file" id="image_add" name="image">
                                </div>
                            </div>
                            <div class="input">
                                <label for="description_add">Annonce description</label>
                                <textarea name="description"  maxlength="800" id="description_add" rows="5"></textarea>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Add">
                        </form>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <script>
        function show(data) {
            let dataArray = {"annonce_id":data.annonce_id};
            document.querySelector('.modal-img img').src = "pictures/"+data["annonce_image"];
            document.querySelector('#modal .title').innerHTML = data["annonce_title"];
            document.querySelector('#modal .tag:first-child').innerHTML = data["annonce_type"];
            document.querySelector('#modal .tag:last-child').innerHTML = data["annonce_date"];
            document.querySelector('#modal .tag:nth-child(2)').innerHTML = data["annonce_area"]+"m²";
            document.querySelector('#modal .adresse').innerHTML = data["annonce_adresse"];
            document.querySelector('#modal .modal-desc').innerHTML = data["annonce_description"];
            if (data["annonce_type"] == "For Rent") {
                document.querySelector('#modal .price').innerHTML = (new Intl.NumberFormat('en-US',{style:'currency', currency: 'USD'}).format(data["annonce_price"]))+"/month";
            }else {
                document.querySelector('#modal .price').innerHTML = (new Intl.NumberFormat('en-US',{style:'currency', currency: 'USD'}).format(data["annonce_price"]));
            }
            document.querySelector('#modal #delete').dataset.id = data["annonce_id"];
            document.querySelector('#modal #delete').setAttribute('onclick','deleteModal(this.dataset.id)');
            document.querySelector('#modal #edit').dataset.id = data["annonce_id"];
            document.querySelector('#modal #edit').setAttribute('onclick','modify_modal('+JSON.stringify(data)+')');
        }
        function deleteModal(id){
            document.querySelector('#del-modal #annonce_id').value = id;
        }
        function modify_modal(data){
            document.querySelector('#modify-modal #modify_id').value = data["annonce_id"];
            document.querySelector('#modify-modal #adresse_modify').value= data["annonce_adresse"];
            document.querySelector('#modify-modal #area_modify').value= data["annonce_area"];
            document.querySelector('#modify-modal #price_modify').value= +data["annonce_price"];
            document.querySelector('#modify-modal #description_modify').value= data["annonce_description"];
            document.querySelector('#modify-modal #title_modify').value= data["annonce_title"];
            if (data["annonce_type"] == "For Rent") {
                document.querySelector('#modify-modal option[value="For Rent"]').setAttribute('selected','');
            }
        }
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
function createCard($data)
{
    foreach ($data as $row) {
        echo '
            <div class="card-container col-3">
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
}

