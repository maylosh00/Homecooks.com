<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Ingredient.php';
require_once __DIR__.'/../models/Recipe.php';

class IngredientRepository extends Repository {

    public function getIngredients(): array {

        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM ingredients
        ');

        $stmt->execute();
        $ingredients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($ingredients as $ingredient) {
            $result[] = new Ingredient(
                $ingredient['name'],
                $ingredient['proteins'],
                $ingredient['carbs'],
                $ingredient['fats'],
                $ingredient['calories']
            );
        }

        return $result;
    }

    public function getIngredientsForRecipe(Recipe $recipe): array {

        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT ingredients.id, ingredients.name, ingredients.proteins, ingredients.carbs, ingredients.fats, ingredients.calories, recipe_ingredient.amount FROM ingredients
                  JOIN recipe_ingredient ON ingredients.id = recipe_ingredient.ingredient_id
                  JOIN recipes ON recipe_ingredient.recipe_id = recipes.id
            WHERE recipes.title LIKE :title
        ');
        $stmt->bindParam(':title', $recipe->getTitle(), PDO::PARAM_STR);
        $stmt->execute();
        $ingredients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $index = 0;
        foreach ($ingredients as $ingredient) {
            $result[] = new Ingredient(
                $ingredient['name'],
                $ingredient['proteins'],
                $ingredient['carbs'],
                $ingredient['fats'],
                $ingredient['calories']
            );
            $result[$index]->setAmount($ingredient['amount']);
            $index++;
        }

        return $result;
    }

    public function addIngredient(Ingredient $ingredient): void {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO ingredients (name, proteins, carbs, fats, calories)
            VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $ingredient->getName(),
            $ingredient->getProteins(),
            $ingredient->getCarbs(),
            $ingredient->getFats(),
            $ingredient->getCalories(),
        ]);
    }

}