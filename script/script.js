//################## validations ################
//add form validation
document.getElementById('add-form').addEventListener('submit',e=>{
    let key = true;
    let title = document.querySelector('#title_add').value;
    let area = document.querySelector('#area_add').value;
    let adresse = document.querySelector('#adresse_add').value;
    let image = document.querySelector('#image_add').value;
    let price = document.querySelector('#price_add').value;
    let desc = document.querySelector('#description_add').value;
    if (title!== '' && area!== '' && adresse !== '' && image !== '' && price !== '' && desc !== '' ){
        if (!(/(.{1,40})$/i.test(title))){
            document.querySelector('#input-title-add').setAttribute('data-after','the title should be maximum of 40 characters');
            key = false;
        }else {
            document.querySelector('#input-title-add').removeAttribute('data-after');
        }
        if (!(/^[0-9]+$/i.test(area))){
            document.querySelector('#input-area-add').setAttribute('data-after','the area should be just numbers');
            key = false;
        }else {
            document.querySelector('#input-area-add').removeAttribute('data-after');
        }
        if (!(/.{1,50}$/i.test(adresse))){
            document.querySelector('#input-adresse-add').setAttribute('data-after','the title should be maximum of 50 characters');
            key = false;
        }else {
            document.querySelector('#input-adresse-add').removeAttribute('data-after');
        }
        if (!(/.+\.(png|jpg|jpeg|webp)$/i.test(image))){
            document.querySelector('#input-image-add').setAttribute('data-after','please insert a valid picture');
            key = false;
        }else {
            document.querySelector('#input-image-add').removeAttribute('data-after');
        }
        if (!(/^[0-9]+$/i.test(price))){
            document.querySelector('#input-price-add').setAttribute('data-after','the price should be just numbers');
            key = false;
        }else {
            document.querySelector('#input-price-add').removeAttribute('data-after');
        }
        if (!(/.{1,800}$/i.test(desc))){
            document.querySelector('#input-description-add').setAttribute('data-after','the description should be maximum of 800 character');
            key = false;
        }else {
            document.querySelector('#input-description-add').removeAttribute('data-after');
        }
        if (!key) e.preventDefault();
    }else {
        e.preventDefault();
        if (title ===''){
            document.querySelector('#input-title-add').setAttribute('data-after','please enter a title')
        }else {
            document.querySelector('#input-title-add').removeAttribute('data-after');
        }
        if (area ===''){
            document.querySelector('#input-area-add').setAttribute('data-after','please enter a area')
        }else {
            document.querySelector('#input-area-add').removeAttribute('data-after');
        }
        if (adresse ===''){
            document.querySelector('#input-adresse-add').setAttribute('data-after','please enter a adresse')
        }else {
            document.querySelector('#input-adresse-add').removeAttribute('data-after');
        }
        if (image ===''){
            document.querySelector('#input-image-add').setAttribute('data-after','please insert a picture')
        }else {
            document.querySelector('#input-image-add').removeAttribute('data-after');
        }
        if (price ===''){
            document.querySelector('#input-price-add').setAttribute('data-after','please enter a price')
        }else {
            document.querySelector('#input-price-add').removeAttribute('data-after');
        }
        if (desc ===''){
            document.querySelector('#input-description-add').setAttribute('data-after','please enter a description')
        }else {
            document.querySelector('#input-description-add').removeAttribute('data-after');
        }
    }
});
// modify form validation
document.getElementById('modify-form').addEventListener('submit',e=>{
    let key = true;
    let title = document.querySelector('#title_modify').value;
    let area = document.querySelector('#area_modify').value;
    let adresse = document.querySelector('#adresse_modify').value;
    let price = document.querySelector('#price_modify').value;
    let desc = document.querySelector('#description_modify').value;
    if (title!== '' && area!== '' && adresse !== '' && price !== '' && desc !== '' ){
        if (!(/(.{1,40})$/i.test(title))){
            document.querySelector('#input-title-modify').setAttribute('data-after','the title should be maximum of 40 characters');
            key = false;
        }else {
            document.querySelector('#input-title-modify').removeAttribute('data-after');
        }
        if (!(/^[0-9]+$/i.test(area))){
            document.querySelector('#input-area-modify').setAttribute('data-after','the area should be just numbers');
            key = false;
        }else {
            document.querySelector('#input-area-modify').removeAttribute('data-after');
        }
        if (!(/.{1,50}$/i.test(adresse))){
            document.querySelector('#input-adresse-modify').setAttribute('data-after','the title should be maximum of 50 characters');
            key = false;
        }else {
            document.querySelector('#input-adresse-modify').removeAttribute('data-after');
        }
        if (!(/^[0-9]+$/i.test(price))){
            document.querySelector('#input-price-modify').setAttribute('data-after','the price should be just numbers');
            key = false;
        }else {
            document.querySelector('#input-price-modify').removeAttribute('data-after');
        }
        if (!(/.{1,800}$/i.test(desc))){
            document.querySelector('#input-description-modify').setAttribute('data-after','the description should be maximum of 800 character');
            key = false;
        }else {
            document.querySelector('#input-description-modify').removeAttribute('data-after');
        }
        if (!key) e.preventDefault();
    }else {
        e.preventDefault();
        if (title ===''){
            document.querySelector('#input-title-modify').setAttribute('data-after','please enter a title')
        }else {
            document.querySelector('#input-title-modify').removeAttribute('data-after');
        }
        if (area ===''){
            document.querySelector('#input-area-modify').setAttribute('data-after','please enter a area')
        }else {
            document.querySelector('#input-area-modify').removeAttribute('data-after');
        }
        if (adresse ===''){
            document.querySelector('#input-adresse-modify').setAttribute('data-after','please enter a adresse')
        }else {
            document.querySelector('#input-adresse-modify').removeAttribute('data-after');
        }
        if (price ===''){
            document.querySelector('#input-price-modify').setAttribute('data-after','please enter a price')
        }else {
            document.querySelector('#input-price-modify').removeAttribute('data-after');
        }
        if (desc ===''){
            document.querySelector('#input-description-modify').setAttribute('data-after','please enter a description')
        }else {
            document.querySelector('#input-description-modify').removeAttribute('data-after');
        }
    }
})
//detail modal filling
//################## content filling ################
function show(data) {
    document.querySelector('.modal-img img').src = "pictures/"+data["annonce_image"];
    document.querySelector('.modal-img img').alt = data["annonce_title"];
    document.querySelector('#modal .title').innerHTML = data["annonce_title"];
    document.querySelector('#modal .tag:first-child').innerHTML = data["annonce_type"];
    document.querySelector('#modal .tag:last-child').innerHTML = data["annonce_date"];
    document.querySelector('#modal .tag:nth-child(2)').innerHTML = data["annonce_area"]+"m²";
    document.querySelector('#modal .adresse').innerHTML = data["annonce_adresse"];
    document.querySelector('#modal .modal-desc').innerHTML = data["annonce_description"];
    if (data["annonce_type"] === "For Rent") {
        document.querySelector('#modal .price').innerHTML = (new Intl.NumberFormat('en-US',{style:'currency', currency: 'USD'}).format(data["annonce_price"]))+"/month";
    }else {
        document.querySelector('#modal .price').innerHTML = (new Intl.NumberFormat('en-US',{style:'currency', currency: 'USD'}).format(data["annonce_price"]));
    }
    document.querySelector('#modal #delete').dataset.id = data["annonce_id"];
    document.querySelector('#modal #delete').setAttribute('onclick','deleteModal(this.dataset.id)');
    document.querySelector('#modal #edit').dataset.id = data["annonce_id"];
    document.querySelector('#modal #edit').setAttribute('onclick','modify_modal('+JSON.stringify(data)+')');
}
//delete modal fill
function deleteModal(id){
    document.querySelector('#del-modal #annonce_id').value = id;
}
//modify modal fill
function modify_modal(data){
    document.querySelector('#modify-modal #modify_id').value = data["annonce_id"];
    document.querySelector('#modify-modal #adresse_modify').value= data["annonce_adresse"];
    document.querySelector('#modify-modal #area_modify').value= data["annonce_area"];
    document.querySelector('#modify-modal #price_modify').value= +data["annonce_price"];
    document.querySelector('#modify-modal #description_modify').value= data["annonce_description"];
    document.querySelector('#modify-modal #title_modify').value= data["annonce_title"];
    if (data["annonce_type"] === "For Rent") {
        document.querySelector('#modify-modal option[value="For Rent"]').setAttribute('selected','');
    }
}