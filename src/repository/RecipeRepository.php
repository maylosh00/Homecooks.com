<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Recipe.php';

class RecipeRepository extends Repository {

    public function getRecipe(string $title): ?Recipe {
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM recipes WHERE title LIKE :title'
        );
        $stmt->bindParam(':title', $title, PDO::PARAM_INT);
        $stmt->execute();

        $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($recipe == false) {
            return null;
        }

        $result = new Recipe(
            $recipe['title'],
            $recipe['description'],
            $recipe['content'],
            $recipe['image'],
            $recipe['author_id']
        );
        $result->setDateAdded($recipe['date_added']);
        $result->setRating($recipe['rating']);
        $result->setAuthorId($recipe['author_id']);
        $result->setId($recipe['id']);

        return $result;
    }

    public function getRecipesBySubstring(string $searchString) {
        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM recipes WHERE LOWER(title) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecipesFromCategory(int $category) {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM recipes
                              JOIN recipe_category ON recipes.id = recipe_category.recipe_id
            WHERE recipe_category.category_id = :category
        ');
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        $stmt->execute();

        $result = [];
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($recipes as $recipe) {
            $result[] = new Recipe(
                $recipe['title'],
                $recipe['description'],
                $recipe['content'],
                $recipe['image'],
                $recipe['author_id']
            );
        }
        return $result;
    }

    public function getRecipeObjectsBySubstring(string $searchString) {
        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM recipes WHERE LOWER(title) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        $result = [];
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($recipes as $recipe) {
            $result[] = new Recipe(
                $recipe['title'],
                $recipe['description'],
                $recipe['content'],
                $recipe['image'],
                $recipe['author_id']
            );
        }
        return $result;
    }

    public function getRecipes(): array {

        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM recipes
        ');

        $stmt->execute();
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($recipes as $recipe) {
            $result[] = new Recipe(
                $recipe['title'],
                $recipe['description'],
                $recipe['content'],
                $recipe['image'],
                $recipe['author_id']
            );
        }

        return $result;
    }

    public function addRecipe(Recipe $recipe): void {
        $date = new DateTime();
        $stmt = $this->database->connect()->prepare('
            INSERT INTO recipes (title, description, content, image, date_added, author_id)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $recipe->getTitle(),
            $recipe->getDescription(),
            $recipe->getContent(),
            $recipe->getImage(),
            $date->format('Y-m-d'),
            $recipe->getAuthorId()
        ]);
    }
}