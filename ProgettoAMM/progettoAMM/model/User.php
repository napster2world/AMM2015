<?php

//classe che mi serve per definire il ruolo di Cliente o venditore

class User {
    
    //Costanti che definiscono il ruolo di Venditore e Studente
    
    const Docente = 1;
   
    const Studente = 2;

    
    private $ruolo;
    
    private $id;
    
    private $password;
    
    private $username;
    
    public function __construct() {
        
    }
    
    public function getRuolo() {
        return $this->ruolo;
    }
   
    public function setRuolo($ruolo) {
        switch ($ruolo) {
            case self::Docente:
            case self::Studente:
                $this->ruolo = $ruolo;
                return true;
            default:
                return false;
        }
    }
    
    public function getID(){
        return $this->ID;
    }
    public function setId($ID){
        $intVal = filter_var($ID, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(!isset($intVal)){
            return false;
        }
        $this->ID = $intVal;
    }
    
    public function getUsername(){         //Guardare user del proff//
        return $this->username;
    }
    public function setUsername($username) {
        // utilizzo la funzione filter var specificando un'espressione regolare
        // che implementa la validazione personalizzata
        if (!filter_var($username, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[a-zA-Z]{5,}/')))) {
            return false;
        }
        $this->username = $username;
        return true;
    }
    
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($password){
        $this->password=$password;
        return true;    //restituisce true se la password è giusta //
    }
}

?>
