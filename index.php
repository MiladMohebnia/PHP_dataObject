<?php

include "vendor/autoload.php";

use miladm\DataObject;

class UserDataObject extends DataObject
{
    public $name;
    public $age;
    public $role;


    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function getAccessLevel()
    {
        switch ($this->role) {
            case 'admin':
                return 0;
            case 'user':
                return 1;
            default:
                return -1;
        }
    }
}



$user1 = new UserDataObject([
    'name' => 'milad',
    'role' => 'admin'
]);


$user2 = new UserDataObject([
    'name' => 'joe',
    'role' => 'user'
]);

die(var_dump(
    $user1->isAdmin(),
    $user1->getAccessLevel(),
    $user2->isAdmin(),
    $user2->getAccessLevel(),
));
