<?php

include_once 'Object.php';
include_once 'User.php';
include_once 'ObjectFactory.php';
include_once 'UserSeller.php';
include_once 'UserFactory.php';


class CarrelloFactory{
    
    private static $singleton;
    
    private function __constructor(){
   
    }
    
    
    public static function instance(){
        if(!isset(self::$singleton)){
            self::$singleton = new CarrelloFactory();
        }
        
        return self::$singleton;
    }
    
    public function &getListaCarrello() {
        $carrello = array();
        $query = "select * from carrello ";
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[getListaCarrello] impossibile inizializzare il database");
            $mysqli->close();
            return $oggetti;
        }
        $result = $mysqli->query($query);
        if ($mysqli->errno > 0) {
            error_log("[getListaCarrello] impossibile eseguire la query");
            $mysqli->close();
            return $oggetti;
        }
        while ($row = $result->fetch_array()) {
            $carrello[] = self::creaCarrelloDaArray($row);
        }
        return $carrello;
    }
    
    public function &caricaCarrelloDaStmt(mysqli_stmt $stmt){
        $carrello = array();
         if (!$stmt->execute()) {
            error_log("[caricaCarrelloDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }
        $row = array();
        $bind = $stmt->bind_result(
                $row['oggetti_nome'],
                $row['oggetti_quantita'],
                $row['oggetti_prezzo'],
                $row['oggetti_id']);
                
        if (!$bind) {
            error_log("[caricaOggettoDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }
        while ($stmt->fetch()) {
            $carrello[] = self::creaCarrelloDaArray($row);
        }
        
        $stmt->close();
        
        return $carrello;
    }

    public static function creaCarrelloDaArray($row) {
   
        $oggetto = new Carrello(
        $row['titolo'],
        $row['quantita'],        
        $row['prezzo'],
        $row['id']);
        return $oggetto;
     }
     
     public function nuovo(Carrello $carrello){
        $query = "INSERT INTO carrello (titolo, prezzo, quantita, id)
                  values (?, ?, ?, ?)";
        return $this->modificaDB($carrello, $query);
    }
    
    public function cancella(Carrello $carrello){
        $query = "delete from carrello where id = ?";
        return $this->modificaDB($carrello, $query);
    }
    
    //Funzione che modifica il Db
    private function modificaDB(Carrello $carrello, $query){
        $mysqli = Db::getInstance()->connectDb();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            return 0;
        }
        $stmt = $mysqli->stmt_init();
       
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[modificaDB] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return 0;
        }
        if (!$stmt->bind_param('isissi',
                $carrello->getTitolo(),
                $carrello->getAmount(),
                $carrello->getPrice(),
                $carrello->getID())) {
            error_log("[modificaDB] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return 0;
        }
        if (!$stmt->execute()) {
            error_log("[modificaDB] impossibile" .
                    " eseguire lo statement");
            $mysqli->close();
            return 0;
        }
        $mysqli->close();
        return $stmt->affected_rows;
    }
 }


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
