const tileNumber = document.getElementById("__captcha").getAttribute('data-tiles');
let tiles = []

for(let t=0; t < tileNumber**2 ;t++){
    tiles.push(document.getElementById(`__captchaTile${t}`));
}

let selection = [];

function swap(el1,el2){
    let tmp = el1.innerHTML;
    el1.innerHTML = el2.innerHTML;
    el2.innerHTML = tmp;

    let tileName1 = document.getElementById(`__tile${el1.id.substring(13,14)}`);
    let tileName2 = document.getElementById(`__tile${el2.id.substring(13,14)}`);

    tmp = tileName1.name;
    tileName1.name = tileName2.name;
    tileName2.name = tmp;

    tmp = tileName1.id;
    tileName1.id = tileName2.id;
    tileName2.id = tmp;

};

function addToSelection(el){
    if (selection[0] == null){
        selection[0] = el;
    } else {
        selection[1] = el;
    }
    if (selection[1] != null){
        swap(selection[0], selection[1]);
        selection[0] = null;
        selection[1] = null;
    }
};

tiles.forEach(function(item){
    item.addEventListener('click', function() {
        addToSelection(item);
    });
});