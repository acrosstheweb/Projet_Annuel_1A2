// ----- barre de recherche -----
const search_trigger = document.getElementById("__search-trigger");
const searchbar = document.getElementById("__searchbar");
const searchbar_results = document.getElementById("__searchbar-results");

search_trigger.addEventListener("click", function(){
    const searchbar_state = searchbar.style.display;
    if(searchbar_state === "block"){
        searchbar.style.display = "none";
        searchbar_results.innerHTML = '';
        searchbar_results.style.display = "none";
        search_trigger.innerHTML = "<a class='nav-link __navIcon' href='#'><i class='fa-solid fa-magnifying-glass'></i></a>";
    }else{
        /*search_trigger.style.display = "none";*/
        search_trigger.innerHTML = "<a class='nav-link __navIcon' href='#'><i class='fa-solid fa-xmark'></i></a>";
        searchbar.style.display = "block";
        searchbar_results.style.display = "block";
    }
});

function getRootWebSitePath() // https://www.codeproject.com/Tips/591352/Get-WebSite-Root-Relative-Path-by-JavaScript
{
    var _location = document.location.toString();
    var applicationNameIndex = _location.indexOf('/', _location.indexOf('://') + 3);
    var applicationName = _location.substring(0, applicationNameIndex) + '/';
    var webFolderIndex = _location.indexOf('/', _location.indexOf(applicationName) + applicationName.length);
    var webFolderFullPath = _location.substring(0, webFolderIndex);

    return webFolderFullPath;
}

// prototypage ajax
function search(text){
    let searchBarResult = document.getElementById("__searchbar-results");
    if(text.length != 0){
        searchBarResult.style.display = 'block';
        let XML = new XMLHttpRequest();
        XML.onreadystatechange = function(){
            if(XML.readyState == 4 && XML.status == 200){
                searchBarResult.innerHTML = XML.responseText;
            }
        };

        XML.open('GET', getRootWebSitePath()+`/searchBar.php?q=${text}`, true);
        XML.send();
    }else{
        searchBarResult.style.display = 'none';
    }
}


// var modal = document.getElementById('register-modal');
// var body = document.getElementsByTagName('body')[0];
// var header = document.getElementsByTagName('header')[0];


// let shown = 1;

// function closeModal(){
//     modal.style.display = 'none';
//     modal.style.paddingLeft = "0px";
//     modal.classList.add('show');
//     modal.attributes.removeNamedItem('aria-hidden');
//     modal.setAttribute('aria-modal', "true");
//     modal.setAttribute('role', 'dialog');

//     body.classList.add('modal-open');
//     body.style.overflow = 'hidden';
//     body.style.paddingRight = "17px";
//     body.innerHTML += '<div class="modal-backdrop fade show"></div>';

//     header.style.paddingRight = '4px';
//     header.style.marginRight = 0;
// }

// function showModal(){
//     if (window.location.href.indexOf("register-modal") > -1) {
//         if (shown == 1){
//             modal.style.display = 'block';
//             modal.style.paddingLeft = "0px";
//             modal.classList.add('show');
//             modal.attributes.removeNamedItem('aria-hidden');
//             modal.setAttribute('aria-modal', "true");
//             modal.setAttribute('role', 'dialog');

//             body.classList.add('modal-open');
//             body.style.overflow = 'hidden';
//             body.style.paddingRight = "17px";
//             body.innerHTML += '<div class="modal-backdrop fade show"></div>';

//             header.style.paddingRight = '4px';
//             header.style.marginRight = 0;
//         }
//     }

//     shown = 0;

// }

// showModal();