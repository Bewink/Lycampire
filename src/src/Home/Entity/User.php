<?php

namespace src\Home\Entity;

use vendor\befew\Entity;

/**
 * Class User
 * @package src\Home\Entity
 */
class User extends Entity {
    protected $id;
    protected $pseudo;
    protected $password;
    protected $salt;
    protected $email;
    protected $rank;
    protected $avatar;
}