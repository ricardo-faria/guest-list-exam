<?php
require 'vendor/autoload.php';
require 'guest/GuestService.php';

$app = new \Slim\Slim();


$app->post('/guests', function() use ( $app ) {
   $guestJson = $app->request()->getBody();
   $guest = json_decode($guestJson, true);
   
   if($guest){
       $return = GuestService::addGuest($guest);
       
       echo $return;
   }
   else{
       echo 'malfomat json';
   }
});


$app->get('/guests/', function() use($app){
    
    $guests = GuestService::getGuests();
    echo json_encode($guests);
});


$app->delete('/guests/:id', function($id) use($app){
   $return = GuestService::deleteGuest($id);
   if($return){
        $app->response()->header('Content-Type', 'application/json');
       echo '{"status": "true","message": "Guest deleted!"}';
    }
    else{
         $app->response()->header('Content-Type', 'application/json');
        echo '{"status": "false", "message": "Guest with $id does not exit"}';
    }
});


$app->run();
?>