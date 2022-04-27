<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Recipe.php';
require_once __DIR__.'/../models/Ingredient.php';
require_once __DIR__.'/../models/RecipeIngredientConnector.php';

// repozytorium tworzy entry do repository_ingredient (relacja wiele do wielu)
class RecipeIngredientConnectorRepository extends Repository {

    public function addRecipeIngredientConnector(RecipeIngredientConnector $connector): void {

        $stmt = $this->database->connect()->prepare('
            INSERT INTO recipe_ingredient (recipe_id, ingredient_id, amount) 
            VALUES ((SELECT id FROM recipes WHERE title LIKE ?), (SELECT id FROM ingredients WHERE name LIKE ?), ?)
        ');

        $stmt->execute([
            $connector->getRecipeTitle(),
            $connector->getIngredientName(),
            $connector->getAmount()
        ]);
    }
}