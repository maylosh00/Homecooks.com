<?php

class RecipeIngredientConnector {

    private $recipeTitle;
    private $ingredientName;
    private $amount;

    public function __construct(string $recipeTitle, string $ingredientName, float $amount)
    {
        $this->recipeTitle = $recipeTitle;
        $this->ingredientName = $ingredientName;
        $this->amount = $amount;
    }

    public function getRecipeTitle(): string
    {
        return $this->recipeTitle;
    }

    public function setRecipeTitle(string $recipeTitle)
    {
        $this->recipeTitle = $recipeTitle;
    }

    public function getIngredientName(): string
    {
        return $this->ingredientName;
    }

    public function setIngredientName(string $ingredientName)
    {
        $this->ingredientName = $ingredientName;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }



}