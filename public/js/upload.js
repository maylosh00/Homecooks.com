const addIngredientButtonDiv = document.querySelector('.add-ingredient-button');
const addIngredientButton = addIngredientButtonDiv.querySelector('a');

const ingredientsDiv = document.querySelector('.ingredients');
const addIngredientTemplate = document.querySelector('.add-ingredient-template');

//zmienna globalna, używana przez addIngredient
//używam jej do nadawania odpowiednich nazw inputom i selectom w htmlu
var ingredientsAmount = 0;

function addIngredient() {
    // cały div zawierający dodawany składnik
    const newIngredient = addIngredientTemplate.content.cloneNode(true);
    // div, którego rozszerzam o formularz wyboru skladnika z listy lub nowego skladnika
    const choosingIngredientForm = newIngredient.querySelector('.add-ingredient-forms');
    // przycisk "śmientik"
    const trashButton = newIngredient.querySelector('.trash-icon');
    // lista skladnikow i formularz nowych skladnikow - radio inputy
    const radioInputIngredientFromList = newIngredient.querySelector('#ingredient-from-list');
    const radioInputNewIngredient = newIngredient.querySelector('#new-ingredient');
    // lista skladnikow i formularz nowych skladnikow - divy
    const ingredientFromListForm = newIngredient.querySelector('.ingredient-from-list-form');
    const newIngredientForm = newIngredient.querySelector('.new-ingredient-form');


    // funkcje wyswietlajace i ukrywajace listę skladnikow / formularz nowych skladnikow
    function displayIngredientsList() {
        ingredientFromListForm.classList.remove('not-visible');
        newIngredientForm.classList.add('not-visible');
    }
    function displayNewIngredientForm() {
        newIngredientForm.classList.remove('not-visible');
        ingredientFromListForm.classList.add('not-visible');
    }
    radioInputIngredientFromList.addEventListener("click",displayIngredientsList);
    radioInputNewIngredient.addEventListener("click",displayNewIngredientForm);


    // ustawiam atrybuty "names" dla inputów radio
    ingredientsAmount++;
    const thisIngredientNum = ingredientsAmount;
    setNameAttributes(newIngredient, thisIngredientNum);

    // dodaje klasę ingredient<n> do skladnika
    // ten fragment kodu pomaga jedynie rozeznac sie w htmlu przy badaniu elementu na stronie
    [].forEach.call(ingredientsDiv.childNodes, function(el){
        if(el.className == "add-ingredient" && el.nodeName == "DIV")
            el.className += ' ingredient'+thisIngredientNum;
    });

    // dodaje utworzonego diva do containera ze skladnikami
    // zanim to jednak zrobie, przypisuje node z elementem html do stalej, abym mogl pozniej jej uzyc
    // do usuniecia skladnika
    const nodeToDelete = newIngredient.childNodes.item(1);
    ingredientsDiv.appendChild(newIngredient);

    // dodaje event listener dla przycisku "śmietnika"
    function removeIngredient() {
        ingredientsDiv.removeChild(nodeToDelete);
    }
    trashButton.addEventListener("click", removeIngredient);
}


function setNameAttributes(parentDiv, num) {

    const radioInputIngredientFromList = parentDiv.querySelector('input[value="ingredientFromList"]');
    const radioInputNewIngredient = parentDiv.querySelector('input[value="newIngredient"]');
    const labels = parentDiv.querySelectorAll('label');
    const select = parentDiv.querySelector('#ingredient-select');
    const inputAmountAfterSelect = parentDiv.querySelector('#ingredient-from-list-amount')
    const inputNewIngredient = parentDiv.querySelectorAll('#new-ingredient-input');

    radioInputIngredientFromList.setAttribute('name', 'ingredientType'+num);
    radioInputIngredientFromList.setAttribute('id', 'ingredient-from-list'+num);
    radioInputNewIngredient.setAttribute('name', 'ingredientType'+num);
    radioInputNewIngredient.setAttribute('id', 'new-ingredient'+num);
    labels[0].setAttribute('for', 'ingredient-from-list'+num);
    labels[1].setAttribute('for', 'new-ingredient'+num);
    select.setAttribute('name', 'ingredientFromList'+num);
    inputAmountAfterSelect.setAttribute('name', 'ingredientFromListAmount'+num);
    inputNewIngredient[0].setAttribute('name', 'newIngredientName'+num);
    inputNewIngredient[1].setAttribute('name', 'newIngredientProteins'+num);
    inputNewIngredient[2].setAttribute('name', 'newIngredientCarbs'+num);
    inputNewIngredient[3].setAttribute('name', 'newIngredientFats'+num);
    inputNewIngredient[4].setAttribute('name', 'newIngredientCalories'+num);
    inputNewIngredient[5].setAttribute('name', 'newIngredientAmount'+num);
}

addIngredientButton.addEventListener("click", addIngredient);