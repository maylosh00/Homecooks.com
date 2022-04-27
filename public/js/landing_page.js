const recipesContainer = document.querySelector(".recipes");
recipesContainer.getElementsByTagName('a')[0].setAttribute('class', "recipe-tile-container first-recipe");
recipesContainer.getElementsByTagName('a')[1].setAttribute('class', "recipe-tile-container second-recipe");
recipesContainer.getElementsByTagName('a')[2].setAttribute('class', "recipe-tile-container third-recipe");

recipesContainer.getElementsByTagName('a')[0].querySelector(".recipe-tile").setAttribute('class', "recipe-tile size1");
recipesContainer.getElementsByTagName('a')[1].querySelector(".recipe-tile").setAttribute('class', "recipe-tile size2");
recipesContainer.getElementsByTagName('a')[2].querySelector(".recipe-tile").setAttribute('class', "recipe-tile size2");