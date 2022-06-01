const programExerciceList = document.getElementById('__programExerciceList');
const programContentPreview = document.getElementById('__programContentPreview');


let counter = 1;




//Nom du programme
const programNamePreview = document.getElementById("__programNamePreview");
const programTitle = document.getElementById("__programTitle");

function displayProgramTitle(){
    programNamePreview.innerText = programTitle.value;
};



//Ajout d'un exercice
const addExercice_trigger = document.getElementById('__addExercice');

function addExercice(){
    let exercice = `
    <div id="__programExercice${counter}" class="__programExercice accordion-item">
        <div class="row">
            <label for="__programExerciceDropdown${counter}" id="__programExerciceDropdown${counter}-label" class="accordion-header form-label fw-bold p-0 col-10 col-md-11">
                <button class="__programExerciceButton accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#__programExerciceCollapse${counter}" aria-expanded="true" aria-controls="collapseOne">
                    Exercice #${counter}
                </button>
            </label>
            <div id="__programExerciceDeleteHeader${counter}" class="__programExerciceDelete col-2 col-md-1">
                <i class="fa-solid fa-trash-can"></i>
            </div>
        </div>
        <div id="__programExerciceCollapse${counter}" class=" __programExerciceCollapse accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#__programExerciceList">
            <div class="accordion-body">
                <select class="form-select" name="programExerciceDropdown" id="__programExerciceDropdown${counter}" required="required" onchange="displayExercice(${counter})"><br>
                    <option selected disabled>Exercice</option>
                    <option value="1">Biceps Curl</option>
                    <option value="2">Developpé couché</option>
                    <option value="3">Rowing barre</option>
                    <option value="4">Squat</option>
                </select>
                <p>L'exercice n'est pas dans la liste? Créez-le</p>
                <button class="btn btn-primary">+ Créer un exercice</button>
            

                <div class="row my-3">
                    <div class="col-12 col-md-6">
                        <label for="__programSeries${counter}" id="__programSeries${counter}-label">Série(s) : </label><br>
                        <input type="number" name="programSeries" id="__programSeries${counter}" oninput="displayReps(${counter})">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="__programReps${counter}" id="__programReps${counter}-label">Répétitions : </label><br>
                        <input type="number" name="programReps" id="__programReps${counter}" oninput="displayReps(${counter})">
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;
    programExerciceList.innerHTML += exercice;

    
    
    let exercicePreview = `
    <tr id="__programExercicePreview${counter}">
        <td id="__programExerciceNamePreview${counter}"></td>
        <td id="__programExerciceRepsPreview${counter}"></td>
        <td id="__programExerciceDelete${counter}"><i class="fa-solid fa-trash-can"></i></td>
    </tr>
    `;
    programContentPreview.innerHTML += exercicePreview;

    
    addExercice_trigger.href = `#__programReps${counter-1}-label`;


    let programExerciceCollapses = document.getElementsByClassName('__programExerciceCollapse');
    let programExerciceButtons = document.getElementsByClassName('__programExerciceButton');
    for (let i = 0; i < programExerciceCollapse.length - 1; i++){
        programExerciceCollapses[i].classList.remove("show");
        programExerciceButtons[i].classList.add("collapsed");
    };

};

function displayExercice(n){
    //Nom exercice
    let exercice = document.getElementById(`__programExerciceDropdown${n}`);
    let exercicePreview = document.getElementById(`__programExerciceNamePreview${n}`);
    exercicePreview.innerText = exercice.options[exercice.selectedIndex].text;
};

function displayReps(n){
    //Series
    let series = document.getElementById(`__programSeries${n}`).value;
    let reps = document.getElementById(`__programReps${n}`).value;
    let repsPreview = document.getElementById(`__programExerciceRepsPreview${n}`);
    repsPreview.innerText = `${series}X${reps}`;
};

addExercice_trigger.addEventListener('click', function(){
    if (counter < 7){
        counter += 1;
        addExercice();
    } else {
        addExercice_trigger.classList.add("disabled");
    }
});


//Suppression d'un exercice
function deleteExercice(n){
    const programExercice = document.getElementById(`__programExercice${n}`);
    let programExercices = document.getElementsByClassName('__programExercice');

    //programExercice.remove();

    let src_exercice = document.getElementById(`__programExercice${n+1}`);
    let dest_exercice = document.getElementById(`__programExercice${n}`);

    for (let i = n; i < programExercices.length - 1; i++){
        //remplacer tout le contenu de l'élément n par celui de n+1

        dest_exercice.id = src_exercice.id;
        

        let exercice = `
        <div id="__programExercice${counter}" class="__programExercice accordion-item">
            <div class="row">
                <label for="__programExerciceDropdown${counter}" class="accordion-header form-label fw-bold p-0 col-11">
                    <button class="__programExerciceButton accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#__programExerciceCollapse${counter}" aria-expanded="true" aria-controls="collapseOne">
                        Exercice #${counter}
                    </button>
                </label>
                <div id="__programExerciceDeleteHeader${counter}" class="__programExerciceDelete col-1">
                    <i class="fa-solid fa-trash-can"></i>
                </div>
            </div>
            <div id="__programExerciceCollapse${counter}" class=" __programExerciceCollapse accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#__programExerciceList">
                <div class="accordion-body">
                    <select class="form-select" name="programExerciceDropdown" id="__programExerciceDropdown${counter}" required="required" onchange="displayExercice(${counter})"><br>
                        <option selected disabled>Exercice</option>
                        <option value="1">Biceps Curl</option>
                        <option value="2">Developpé couché</option>
                        <option value="3">Rowing barre</option>
                        <option value="4">Squat</option>
                    </select>
                    <p>L'exercice n'est pas dans la liste? Créez-le</p>
                    <button class="btn btn-primary">+ Créer un exercice</button>
                

                    <div class="row my-3">
                        <div class="col-12 col-md-6">
                            <label for="__programSeries${counter}">Série(s) : </label><br>
                            <input type="number" name="programSeries" id="__programSeries${counter}" oninput="displayReps(${counter})">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="__programReps${counter}">Répétitions : </label><br>
                            <input type="number" name="programReps" id="__programReps${counter}" oninput="displayReps(${counter})">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        programExerciceList.innerHTML += exercice;

        
        
        let exercicePreview = `
        <tr id="__programExercicePreview${counter}">
            <td id="__programExerciceNamePreview${counter}"></td>
            <td id="__programExerciceRepsPreview${counter}"></td>
            <td id="__programExerciceDelete${counter}"><i class="fa-solid fa-trash-can"></i></td>
        </tr>
        `;
        programContentPreview.innerHTML += exercicePreview;

    };
    
    programExercices[programExercices.length].remove();

};
