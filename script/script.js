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