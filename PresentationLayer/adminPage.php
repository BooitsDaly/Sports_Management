<?php
/**
 * User: caitlyn
 * Date: 10/13/18
 * Time: 11:59 AM
 */
session_start();
if(isset($_SESSION['role'])){
    //find their role
}else{
    //redirect them to the login page
    //header("Location: ./../index.php");
    //print a message that they have to login first
}
?>
<html>
    <header>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="./../assets/css/materialize.min.css"  media="screen,projection"/>

        <!--font awesome -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Admin Home Page</title>

    </header>
    <body>
    <!-- Created header -->
    <nav>
        <div class="banner nav-wrapper">
            <button id="logout" class="btn">LOGOUT</button>
        </div>
    </nav>

    <!-- Created container to hold everything for styling-->
    <div class="">
        <!-- header -->
        <div class="row">
            <h1 class="title center-align">Admin Page</h1>
        </div>

        <!-- The sections below will be dynamically created once get information out of the database -->
        <div id="userTable"></div>
        <!-- Modal Structure -->
        <div id="edit" class="modal">
            <div id="userModalContent" class="modal-content">
                <h4 id="userModalHeader"></h4>

                <div class="input-field col s12">
                    <input id="editUsername" class="validate" type="text">
                    <label for="editUsername">Username</label>
                </div>
                <div class="input-field col s12">
                    <input id="editPassword" class="validate" type="password">
                    <label for="editUsername">Password</label>
                </div>


                <div class="input-field col s12">
                    <select id="role">
                        <option class="role" value="" disabled selected>Choose a new Role</option>
                        <option class="role" value="1">Admin</option>
                        <option class="role" value="2">League Manager</option>
                        <option class="role" value="3">Team Manager</option>
                        <option class="role" value="4">Coach</option>
                        <option class="role" value="5">Parent</option>
                    </select>
                    <label>Role</label>
                </div>



        </div>
    </div>
        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="../assets/js/materialize.min.js"></script>

        <!-- CUSTOM JS -->
        <script type="text/javascript" src="../assets/js/adminPage.js"></script>
        <script type="text/javascript" src="../assets/js/logout.js"></script>
    </body>
</html>


