<?php

class Ingredient {

    private $name;
    private $proteins;
    private $carbs;
    private $fats;
    private $calories;
    private $amount; // dla wyswietlania przepisow

    public function __construct(string $name, float $proteins, float $carbs, float $fats, float $calories) {
        $this->name = $name;
        $this->proteins = $proteins;
        $this->carbs = $carbs;
        $this->fats = $fats;
        $this->calories = $calories;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount)
    {
        $this->amount = $amount;
    }



    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getProteins(): float {
        return $this->proteins;
    }

    public function setProteins(float $proteins) {
        $this->proteins = $proteins;
    }

    public function getCarbs(): float {
        return $this->carbs;
    }

    public function setCarbs(float $carbs) {
        $this->carbs = $carbs;
    }

    public function getFats(): float {
        return $this->fats;
    }

    public function setFats(float $fats) {
        $this->fats = $fats;
    }

    public function getCalories(): float {
        return $this->calories;
    }

    public function setCalories(float $calories) {
        $this->calories = $calories;
    }

}