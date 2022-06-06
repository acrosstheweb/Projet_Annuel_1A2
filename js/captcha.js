const tile0 = document.getElementById('__captchaTile0');
const tile1 = document.getElementById('__captchaTile1');
const tile2 = document.getElementById('__captchaTile2');
const tile3 = document.getElementById('__captchaTile3');
const tile4 = document.getElementById('__captchaTile4');
const tile5 = document.getElementById('__captchaTile5');
const tile6 = document.getElementById('__captchaTile6');
const tile7 = document.getElementById('__captchaTile7');
const tile8 = document.getElementById('__captchaTile8');




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

    console.log(tileName1);
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

var tiles = [tile0, tile1, tile2, tile3, tile4, tile5, tile6, tile7, tile8];

tiles.forEach(function(item){
    item.addEventListener('click', function() {
        addToSelection(item);
    });
});

