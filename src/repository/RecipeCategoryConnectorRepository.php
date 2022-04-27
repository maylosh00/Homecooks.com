<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Recipe.php';
require_once __DIR__.'/../models/RecipeCategoryConnector.php';

class RecipeCategoryConnectorRepository extends Repository
{
    public function addRecipeCategoryConnector(RecipeCategoryConnector $connector): void {

        $stmt = $this->database->connect()->prepare('
            INSERT INTO recipe_category (recipe_id, category_id) 
            VALUES ((SELECT id FROM recipes WHERE title LIKE ?), ?)
        ');

        $stmt->execute([
            $connector->getRecipeTitle(),
            $connector->getCategoryId()
        ]);
    }
}