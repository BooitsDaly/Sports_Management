<?php
session_start();
if(isset($_POST['call'])){
    $call = $_POST['call'];
    include('helper.php');
    include('./../DataLayer/Player.class.php');
    if($call == 'add'){

    }elseif($call == 'view'){
        $db = new Player();
        $data;
        if($_SESSION['role'] == 1 || $_SESSION['role'] == 2){
            $data = $db->getAllPlayers();
        }elseif($_SESSION['role'] == 3 || $_SESSION['role'] == 4){
            $data = $db->getPlayersbyTeam($_SESSION['team']);
        }
        $results = $db->getAsTable($data);
        echo $results;

    }elseif($call == 'delete'){

    }elseif($call == 'edit'){

    }
}