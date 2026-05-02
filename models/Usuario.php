<?php
class Usuario {
    private $id;
    private $email;
    private $password;

    public function __construct($email, $password, $id = 0) {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId() { return $this->id; }
    public function setId($id): self { $this->id = $id; return $this; }

    public function getEmail() { return $this->email; }
    public function setEmail($email): self { $this->email = $email; return $this; }

    public function getPassword() { return $this->password; }
    public function setPassword($password): self { $this->password = $password; return $this; }
}
