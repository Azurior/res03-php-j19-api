<?php

class UserManager extends AbstractManager {

    public function getAllUsers() : array
    {
        // get all the users from the database
        $query = $this->db->prepare('SELECT * FROM users');
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        
        $allUsers = [];
        
        foreach($users as $user){
            
        $newUser = new User($user['id'], $user['username'], $user['first_name'], $user['last_name'], $user['email']);
        
        $allUsers[] = $newUser;
        
        }
        return $allUsers;
        
    }

    public function getUserById(int $id) : User
    {
        // get the user with $id from the database
        $query = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $parameters = [
            'id' => $id
        ];
        $query->execute($parameters);
        $userById = $query->fetch(PDO::FETCH_ASSOC);
        
        $newUserId = new User($userById['id'], $userById['username'], $userById['first_name'], $userById['last_name'], $userById['email']);
        return $newUserId;
        
    }

    public function createUser(User $user) : User
    {
        // create the user from the database
        $query = $this->db->prepare('INSERT INTO users (id, username, first_name, last_name, email) VALUES (null, :username, :firstname, :lastname, :email)');

        $parameters = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail()
            ];
            
        $query->execute($parameters);
        
        $id = $this->$db->lastInsertId('users');

        // return it with its id
        
        return getUserById($id);
    }

    public function updateUser(User $user) : User
    {
        // update the user in the database
        $query = $this->db->prepare('UPDATE users SET username = :username, firest_name = :firstname, last_name = :lastname, email = :email WHERE id = :id');

        $parameters = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail()
        ];
        $query->execute($parameters);
        // return it
        return $query;
    }

    public function deleteUser(User $user) : array
    {
        // delete the user from the database
        $query = $this->db->prepare('DELETE users SET username = :username, firest_name = :firstname, last_name = :lastname, email = :email WHERE id = :id');

        $parameters = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail()
            ];
            
        $query->execute($parameters);
        // return it
        
        return getAllUsers();
        // return the full list of users
    }
}