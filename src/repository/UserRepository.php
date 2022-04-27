<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository {

    public function getUserById(int $id): ?User {

        // zapytanie poniżej zwraca wszystkie dane o użytkowniku (połączone tabele user_accounts i users_data)
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user_accounts ua
            LEFT JOIN users_data ud ON ud.user_account_id = ua.id 
            WHERE ua.id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['username'],
            $user['password'],
            $user['salt'],
            $user['name'],
            $user['lastname'],
            $user['email'],
            $user['skill_level'],
            $user['profile_picture']
        );
    }

    public function getUser(string $username): ?User {

        // zapytanie poniżej zwraca wszystkie dane o użytkowniku (połączone tabele user_accounts i users_data)
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_accounts ua
            LEFT JOIN users_data ud ON ud.user_account_id = ua.id 
            WHERE username = :username
        ');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['username'],
            $user['password'],
            $user['salt'],
            $user['name'],
            $user['lastname'],
            $user['email'],
            $user['skill_level'],
            $user['profile_picture']
        );
    }

    public function getUsersId(User $user) {

        $username = $user->getUsername();

        $stmt = $this->database->connect()->prepare('
            SELECT id FROM user_accounts WHERE username = :username
        ');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user['id'];
    }

    public function addUser(User $user): void {

        // zapytanie poniżej dodaje do tabeli user_accounts uzytkownika o podanych danych
        // oraz uzupelnia informacje o nim dodajac informacje do users_data
        // włącznie z polem user_account_id (referencją do opowiedniego, dodanego przed chwilą wiersza z tabeli
        // user_accounts
        $stmt = $this->database->connect()->prepare('
                WITH inserted_user AS (
                    INSERT INTO user_accounts(username, password, salt)
                    VALUES (?, ?, ?)
                    RETURNING id
                )
                INSERT INTO users_data (name, lastname, email, skill_level, profile_picture, user_account_id)
                VALUES (?, ?, ?, ?, ?, (SELECT id FROM inserted_user))
        ');

        $stmt->execute([
            $user->getUsername(),
            $user->getPassword(),
            $user->getSalt(),
            $user->getName(),
            $user->getLastname(),
            $user->getEmail(),
            $user->getSkillLevel(),
            $user->getProfilePicture()
        ]);
    }
}