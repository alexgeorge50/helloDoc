function run_first() {
    if(sessionStorage.item_id) {
        document.getElementById(sessionStorage.item_id.toString()).classList.add("text-white");
    }
    else {
        document.getElementById("0").classList.add("text-white");
    }
}

function nav_item_selected(item_id) {
    $('.nav-item a').removeClass('text-white');
     $('#'+item_id).addClass('text-white');
   // document.getElementById(item_id.toString()).classList.add("text-white");
    //store item_id in sessionStorage
    sessionStorage.item_id = item_id;
}
