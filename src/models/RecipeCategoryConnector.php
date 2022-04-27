<?php

class RecipeCategoryConnector {

    private $recipeTitle;
    private $categoryId;

    public function __construct(string $recipeTitle, int $categoryId)
    {
        $this->recipeTitle = $recipeTitle;
        $this->categoryId = $categoryId;
    }

    public function getRecipeTitle(): string
    {
        return $this->recipeTitle;
    }

    public function setRecipeTitle(string $recipeTitle): void
    {
        $this->recipeTitle = $recipeTitle;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }



}