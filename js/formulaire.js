const programExerciceList = document.getElementById('__programExerciceList');
const programContentPreview = document.getElementById('__programContentPreview');

let values = [];
let ex = [];


let counter = document.getElementsByClassName('__programExercice').length;

function trash(){
    if (counter == 1){
        const label = document.getElementById('__programExerciceDropdown1-label');
        label.classList.remove('col-10');
        label.classList.remove('col-md-11');
        label.classList.add('col-12');

        let trash = document.getElementById('__programExerciceDeleteHeader1');
        trash.classList.add('d-none');

        trash = document.getElementById('__programExerciceDelete1');
        trash.classList.add('d-none');

    } else {
        const label = document.getElementById('__programExerciceDropdown1-label');
        if (!('col-10' in label.classList)){
            label.classList.add('col-10');
        };
        if (!('col-10' in label.classList)){
            label.classList.add('col-md-11');
        };
        label.classList.remove('col-12');

        let trash = document.getElementById('__programExerciceDeleteHeader1');
        trash.classList.remove('d-none');

        trash = document.getElementById('__programExerciceDelete1');
        trash.classList.remove('d-none');
    }
};
trash();



//Nom du programme
const programNamePreview = document.getElementById("__programNamePreview");
const programTitle = document.getElementById("__programTitle");

function displayProgramTitle(){
    programNamePreview.innerText = programTitle.value;
};



// Options d'exercice possibles
const options = document.getElementById('__programExerciceDropdown1').innerHTML;



//Ajout d'un exercice
const addExercice_trigger = document.getElementById('__addExercice');

function addExercice(){
    
    for (let i = 1; i < counter; i++){
        values[i] = [];

        values[i][0] = document.getElementById(`__programExerciceDropdown${i}`).value;
        values[i][1] = document.getElementById(`__programSeries${i}`).value;
        values[i][2] = document.getElementById(`__programReps${i}`).value;
    };

    let newExercice = `
    <div id="__programExercice${counter}" class="__programExercice accordion-item">
        <div class="row">
            <label for="__programExerciceDropdown${counter}" id="__programExerciceDropdown${counter}-label" class="accordion-header form-label fw-bold p-0 col-10 col-md-11">
                <button id="__programExerciceDropdown${counter}-button" class="__programExerciceButton accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#__programExerciceCollapse${counter}" aria-expanded="true" aria-controls="collapseOne">
                    Exercice #${counter}
                </button>
            </label>
            <div id="__programExerciceDeleteHeader${counter}" class="__programExerciceDelete col-2 col-md-1" onclick="deleteExercice(${counter})">
                <i class="fa-solid fa-trash-can"></i>
            </div>
        </div>
        <div id="__programExerciceCollapse${counter}" class="__programExerciceCollapse accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#__programExerciceList">
            <div class="accordion-body">
                <select class="form-select" name="programExerciceDropdown${counter}" id="__programExerciceDropdown${counter}" required="required" onchange="displayExercice(${counter})"><br>
                    ${options}
                </select>

                <div class="row my-3">
                    <div class="col-12 col-md-6">
                        <label for="__programSeries${counter}" id="__programSeries${counter}-label">Série(s) : </label><br>
                        <input type="number" name="programSeries${counter}" id="__programSeries${counter}" oninput="displayReps(${counter})">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="__programReps${counter}" id="__programReps${counter}-label">Répétitions : </label><br>
                        <input type="number" name="programReps${counter}" id="__programReps${counter}" oninput="displayReps(${counter})">
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;
    programExerciceList.innerHTML += newExercice;
    document.getElementById(`__programExerciceDropdown${counter}`)


    
    let exercicePreview = `
    <tr id="__programExercicePreview${counter}" class="__programExercicePreview">
        <td id="__programExerciceNamePreview${counter}"></td>
        <td id="__programExerciceRepsPreview${counter}"></td>
        <td id="__programExerciceDelete${counter}" class="text-end"><i class="fa-solid fa-trash-can" onclick="deleteExercice(${counter})"></i></td>
    </tr>
    `;
    programContentPreview.innerHTML += exercicePreview;

    
    addExercice_trigger.href = `#__programReps${counter-1}-label`;


    let programExerciceCollapses = document.getElementsByClassName('__programExerciceCollapse');
    let programExerciceButtons = document.getElementsByClassName('__programExerciceButton');
    for (let i = 0; i < programExerciceCollapses.length - 1; i++){
        programExerciceCollapses[i].classList.remove("show");
        programExerciceButtons[i].classList.add("collapsed");
    };

    for (let i = 1; i < counter; i++){
        document.getElementById(`__programExerciceDropdown${i}`).value = values[i][0];
        document.getElementById(`__programSeries${i}`).value = values[i][1];
        document.getElementById(`__programReps${i}`).value = values[i][2];
    };
    
    document.getElementById(`__programExerciceDropdown${counter}`).value = 0;

};

function displayExercice(n){
    //Nom exercice
    let exercice = document.getElementById(`__programExerciceDropdown${n}`);
    let exercicePreview = document.getElementById(`__programExerciceNamePreview${n}`);
    
    if (!(exercice.options.selectedIndex == -1)){
        exercicePreview.innerText = exercice.options[exercice.options.selectedIndex].text;
    };
};

function displayReps(n){
    //Series
    let series;
    let reps;
    if (typeof(document.getElementById(`__programSeries${n}`).value) !== 'undefined') {
        series = document.getElementById(`__programSeries${n}`).value;
    }
    if (typeof(document.getElementById(`__programReps${n}`).value) !== 'undefined') {
        reps = document.getElementById(`__programReps${n}`).value;
    }
    let repsPreview = document.getElementById(`__programExerciceRepsPreview${n}`);
    repsPreview.innerText = `${series}X${reps}`;
};

addExercice_trigger.addEventListener('click', function(){
    if (counter < 7){
        counter ++;
        addExercice();
        trash();
        init();
    }
    if (counter == 7){
        addExercice_trigger.classList.add("disabled");
    }
});




//Suppression d'un exercice
function deleteExercice(n){
let toModify;

    const programExercices = document.getElementsByClassName('__programExercice');
    const programExercicesPreviews = document.getElementsByClassName('__programExercicePreview');

    if (n == counter) {

        programExercices[programExercices.length - 1].remove();

        programExercicesPreviews[programExercicesPreviews.length - 1].remove();
    } else {

        document.getElementById(`__programExercice${n}`).remove();
        document.getElementById(`__programExercicePreview${n}`).remove();

        console.log(n);

        for (let i = n; i < counter; i++){
            toModify = document.getElementById(`__programExerciceDelete${i+1}`);
            toModify.setAttribute("onclick", `deleteExercice(${i})`);
            toModify.setAttribute('id', `__programExerciceDelete${i}`);

            toModify = document.getElementById(`__programExerciceRepsPreview${i+1}`);
            toModify.id = `__programExerciceRepsPreview${i}`;

            toModify = document.getElementById(`__programExerciceNamePreview${i+1}`);
            toModify.id = `__programExerciceNamePreview${i}`;

            toModify = document.getElementById(`__programExercicePreview${i+1}`);
            toModify.id = `__programExercicePreview${i}`;

            toModify = document.getElementById(`__programReps${i+1}`);
            toModify.setAttribute("name", `programReps${i}`);
            toModify.setAttribute("oninput", `displayReps(${i})`);
            toModify.id = `__programReps${i}`;

            toModify = document.getElementById(`__programReps${i+1}-label`);
            toModify.setAttribute("for", `__programReps${i}`);
            toModify.id = `__programReps${i}-label`;

            toModify = document.getElementById(`__programSeries${i+1}`);
            toModify.setAttribute("name", `programSeries${i}`);
            toModify.setAttribute("oninput", `displayReps(${i})`);
            toModify.id = `__programSeries${i}`;
            
            toModify = document.getElementById(`__programSeries${i+1}-label`);
            toModify.setAttribute("for", `__programSeries${i}`);
            toModify.id = `__programSeries${i}-label`;

            toModify = document.getElementById(`__programExerciceDropdown${i+1}`);
            toModify.setAttribute("name", `programExerciceDropdown${i}`);
            toModify.setAttribute("onchange", `displayExercice(${i})`);
            toModify.id = `__programExerciceDropdown${i}`;

            toModify = document.getElementById(`__programExerciceCollapse${i+1}`);
            toModify.id = `__programExerciceCollapse${i}`;

            toModify = document.getElementById(`__programExerciceDeleteHeader${i+1}`);
            toModify.setAttribute("onclick", `deleteExercice(${i})`);
            toModify.id = `__programExerciceDeleteHeader${i}`;
            
            toModify = document.getElementById(`__programExerciceDropdown${i+1}-button`);
            toModify.setAttribute("data-bs-target",`#__programExerciceCollapse${i}`);
            toModify.innerText = `Exercice #${i}`;
            toModify.id = `__programExerciceDropdown${i}-button`;

            toModify = document.getElementById(`__programExerciceDropdown${i+1}-label`);
            toModify.setAttribute("for",`__programExerciceDropdown${i}`);
            toModify.setAttribute('id',  `__programExerciceDropdown${i}-label`);
        
            toModify = document.getElementById(`__programExercice${i+1}`);
            toModify.setAttribute('id', `__programExercice${i}`);

            displayExercice(i);

        };

    };

    counter-=1;
    trash();

};
