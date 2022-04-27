<?php

class Recipe {

    private $title;
    private $description;
    private $content;
    private $image;
    private $id;
    private $date_added;
    private $rating;
    private $author_id;

    public function __construct(string $title, string $description, string $content, string $image, int $author_id) {
        $this->title = $title;
        $this->content = str_replace("\n", "<br>", $content);
        $this->description = $description;
        $this->image = $image;
        $this->author_id = $author_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDateAdded(): string
    {
        return $this->date_added;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function getAuthorId(): int
    {
        return $this->author_id;
    }


    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setDateAdded(string $date_added)
    {
        $this->date_added = $date_added;
    }

    public function setRating(?float $rating)
    {
        $this->rating = $rating;
    }

    public function setAuthorId(int $author_id)
    {
        $this->author_id = $author_id;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function getContent(): string {
        return $this->content;
    }

    public function setContent(string $content) {
        $this->content = $content;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function setImage(string $image) {
        $this->image = $image;
    }

}