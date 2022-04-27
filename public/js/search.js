const search = document.querySelector('input[placeholder="Znajdź przepis..."]');
const recipeContainer = document.querySelector('.recipes');
const searchButton = document.querySelector('#search-button');

search.addEventListener("keyup", function(event) {
    if(event.key === "Enter") {

        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function(recipes) {
            recipeContainer.innerHTML = "";
            loadRecipes(recipes);
        })
    }
});

function loadRecipes(recipes) {
    recipes.forEach(recipe => {
        console.log(recipe);
        createRecipe(recipe);
    })
}

function createRecipe(recipe) {
    const template = document.querySelector("#recipe-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = `/public/uploads/${recipe.image}`;
    const title = clone.querySelector("p");
    title.innerHTML = recipe.title;
    const a = clone.querySelector("a");
    a.setAttribute("href", `recipe?title=${recipe.title}`);

    recipeContainer.appendChild(clone);
}

searchButton.addEventListener("click", function(event) {
    const data = {search: search.value};

    fetch("/search", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function(recipes) {
        recipeContainer.innerHTML = "";
        loadRecipes(recipes);
    })
});