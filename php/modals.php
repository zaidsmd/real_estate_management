<!--details Modal-->
<div id="modal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            <div class="modal-img">
                <img src=""
                     alt="">
            </div>
            <div class="modal-body">
                <h4 class="title"></h4>
                <div class="tags">
                    <div class="tag"></div>
                    <div class="tag"></div>
                    <div class="tag"></div>
                </div>
                <div class="adresse"></div>
                <p class="modal-desc"></p>
                <p class="price"></p>
                <div class="buttons">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#del-modal"
                            type="button" id="delete">Delete
                    </button>
                    <button class="btn btn-primary" id="edit" data-bs-toggle="modal"
                            data-bs-target="#modify-modal">Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--delete Modal-->
<div id="del-modal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            <div class="modal-body">
                <h4 class="title">Do you really want to delete this annonce ?</h4>
<!--                delete form-->
                <form action="php/delete.php" method="post">
                    <input type="text" name="annonce_id" id="annonce_id" style="display: none">
                    <button data-bs-dismiss="modal" type="button" class="btn btn-primary">Cancel</button>
                    <input type="submit" name="delete" id="Delete" class="btn btn-primary" value="Delete">
                </form>
            </div>
        </div>
    </div>
</div>
<!--edit Modal-->
<div id="modify-modal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            <div class="modal-body">
                <h4 class="title">Edit the annonce</h4>
                <p>Please fill every input all inputs are required.</p>
<!--                edit form-->
                <form id="modify-form" action="php/edit.php" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <div class="input" id="input-title-modify">
                            <label for="title_modify">Annonce title</label>
                            <input type="text" id="title_modify" maxlength="40" name="title">
                        </div>
                        <div class="input" id="input-adresse-modify">
                            <label for="adresse_modify">Annonce adresse</label>
                            <input type="text" maxlength="50" id="adresse_modify" name="adresse">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input" id="input-area-modify">
                            <label for="area_modify">Annonce area(m²)</label>
                            <input type="text" maxlength="11" id="area_modify" name="area">
                        </div>
                        <div class="input" id="input-price-modify">
                            <label for="price_modify">Annonce price(USD)</label>
                            <input type="text" maxlength="11" id="price_modify" name="price">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input" id="input-type-modify">
                            <label for="type_modify">Annonce type</label>
                            <select name="type" id="type_modify">
                                <option value="For Sale">For Sale</option>
                                <option value="For Rent">For Rent</option>
                            </select>
                        </div>
                        <div class="input" id="input-image-modify">
                            <label for="image_modify">Annonce image(jpg-png-jpeg-webp)</label>
                            <input type="file" id="image_modify" name="image">
                        </div>
                    </div>
                    <div class="input" id="input-description-modify">
                        <label for="description_modify">Annonce description</label>
                        <textarea name="description" maxlength="800" id="description_modify"
                                  rows="5"></textarea>
                    </div>
                    <input type="text" name="annonce_id" class="d-none" id="modify_id">
                    <input class="btn btn-primary" type="submit" value="Edit">
                </form>
            </div>
        </div>
    </div>
</div>
<!--add Modal-->
<div id="add-modal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" id="close" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            <div class="modal-body">
                <h4 class="title">Add new annonce</h4>
                <p>Please fill every input all inputs are required.</p>
<!--                add form -->
                <form id="add-form" action="php/add.php" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <div class="input" id="input-title-add">
                            <label for="title_add">Annonce title</label>
                            <input type="text" id="title_add" maxlength="40" name="title">
                        </div>
                        <div class="input" id="input-adresse-add">
                            <label for="adresse_add">Annonce adresse</label>
                            <input type="text" maxlength="50" id="adresse_add" name="adresse">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input" id="input-area-add">
                            <label for="area_add">Annonce area(m²)</label>
                            <input type="number" maxlength="11" id="area_add" name="area">
                        </div>
                        <div class="input" id="input-price-add">
                            <label for="price_add">Annonce price(USD)</label>
                            <input type="number" maxlength="11" id="price_add" name="price">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input" id="input-type-add">
                            <label for="type_add">Annonce type</label>
                            <select name="type" id="type_add">
                                <option value="For Sale">For Sale</option>
                                <option value="For Rent">For Rent</option>
                            </select>
                        </div>
                        <div class="input" id="input-image-add">
                            <label for="image_add">Annonce image(jpg-png-jpeg-webp)</label>
                            <input type="file" id="image_add" name="image">
                        </div>
                    </div>
                    <div class="input" id="input-description-add">
                        <label for="description_add">Annonce description</label>
                        <textarea name="description" maxlength="800" id="description_add" rows="5"></textarea>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Add">
                </form>
            </div>
        </div>
    </div>
</div>