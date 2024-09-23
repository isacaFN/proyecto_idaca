<?php
namespace Classes;

class Email{
    public $email;
    public $token;
    public $nombre;

    public function __construct($email, $token, $nombre){
        $this->email = $email;
        $this->token = $token;
        $this->nombre = $nombre;
    
    }
}