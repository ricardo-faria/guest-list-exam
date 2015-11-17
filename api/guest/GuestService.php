<?php
require 'database/FactoryConnection.php';

class GuestService{
    public static function addGuest($newGuest){
        $db = FactoryConnection::getDB();
        $db->guests->insert($newGuest);
       
        foreach($db->guests as $guest){
            if($guest['email'] == $newGuest['email'] && $guest['name'] == $newGuest['name'])
            return json_encode(
                array(
                    'name'=>  $guest['name'],
                    'email'=>  $guest['email'],
                    'id' => $guest['id']
                )
                );
                
        };
    }


  
    public static function getGuests(){
        $db = FactoryConnection::getDB();
        $guests =  Array();
        foreach($db->guests as $guest){
            $guests[] = array(
               'id'=> $guest['id'],
               'email'=> $guest['email'],
               'name'=> $guest['name']
            );
        }
        return $guests;
       // return json_encode($db->guests);
    }
    
    public static function deleteGuest($id){
        $db = FactoryConnection::getDB();
        $guest = $db->guests[$id];
        if($guest) {
            $guest->delete();
            return true;
        }
        return false;
    }
}
?>