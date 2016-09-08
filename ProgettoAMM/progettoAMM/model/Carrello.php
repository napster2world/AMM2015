<?php



class Carrello {
    
    private $ID;
    private $titolo;
    private $price;
    private $amount;
    
    
    public function __construct($ID,$titolo,$price,$amount){
        $this->ID = $ID;
        $this->titolo = $titolo;
        $this->price = $price;
        $this->amount = $amount;
        
    }
    
     public function getID(){
        return $this->ID;
     }
     public function setID($id) {
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intVal)) {
            return false;
        }
        $this->ID = $intVal;
        return true;
    }
     
     public function getTitolo(){
         return $this->name_obj;
     }
     public function setTitolo($name_obj){
         $this->name_obj=$name_obj;
     }
     
     public function getPrice(){
        return $this->price;
     }
     public function setPrice($price) {
        $intVal = filter_var($price, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intVal)) {
            return false;
        }
        $this->price=$intVal;
     }

     
     public function getAmount(){
        return $this->amount;
     }
     public function setAmount($amount) {
        $intVal = filter_var($amount, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intVal)) {
            return false;
        }
        $this->amount=$intVal;
     }

    
    
    
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
