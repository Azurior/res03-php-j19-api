<?php

class UserController extends AbstractController {
    private UserManager $um;

    public function __construct()
    {
        $this->um = new UserManager();
    }

    public function getUsers()
    {
        // get all the users from the manager
        $allUsers = $this->um->getAllUsers();
        $users = [];
        
        
        foreach($allUsers as $user){
            array_push($users, $user->toArray());
            
        }
        // render
        $this->render($users);
    }

    public function getUser(string $get)
    {
        // get the user from the manager
        // either by email or by id
        
        $id = intval($get);
        $userId = $this->um->getUserById($id);

        $user = $userId->toArray();
        $this->render($user);

        // render
    }

    public function createUser(array $post)
    {
        // create the user in the manager
        foreach($post as $value){
            
            $newUser = new User($value['username'], $value['firstName'], $value['lastName'], $value['email']);
            $newUser->createUser($newUser);
        }
        
        $this->render($newUser);

        // render the created user
    }

    public function updateUser(array $post)
    {
        // update the user in the manager
        foreach($post as $value){
            
            $newUser = new User($value['username'], $value['firstName'], $value['lastName'], $value['email']);
            $userManager->updateUser($newUser);
        }
        
        $this->render($newUser);

        // render the updated user
    }

    public function deleteUser(array $post)
    {
        // delete the user in the manager
        foreach($post as $value){
            
            $newUser = new User($value['username'], $value['firstName'], $value['lastName'], $value['email']);
            $userManager->deleteUser($newUser);
        }
        
        $this->render($newUser);

        // render the list of all users
    }
}