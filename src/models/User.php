<?php

class User {

    // klasa odpowiada tabelom users_data i user_accounts
    // poniewaz z formularza na register_site zbieram wszystkie informacje potrzebne do stworzenia
    // nowego uzytkownika oraz uzupelnienia users_data wygodniej mi trzymac wszystkie dane uzytkownika
    // w jednej klasie "User"

    // Jednak kłóci się to z SecurityControllerem, być może trzeba jednak rozbić usera na więcej obiektów
    // lub stworzyć klasę dziedziczącą po userze

    private $username;
    private $password;
    private $salt;
    private $name;
    private $lastname;
    private $email;
    private $skill_level;
    private $profile_picture;


    public function __construct(string $username, string $password, string $salt, string $name, string $lastname,
                                string $email, string $skill_level, string $profile_picture)
    {
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->skill_level = $skill_level;
        $this->profile_picture = $profile_picture;
    }

    public function getSalt(): string
    {
        return $this->salt;
    }

    public function setSalt(string $salt)
    {
        $this->salt = $salt;
    }


    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getSkillLevel(): string
    {
        return $this->skill_level;
    }

    public function setSkillLevel(string $skill_level): void
    {
        $this->skill_level = $skill_level;
    }

    public function getProfilePicture(): string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(string $profile_picture): void
    {
        $this->profile_picture = $profile_picture;
    }

}