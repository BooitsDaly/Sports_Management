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
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-image">
                        <img src="./../assets/images/login-image.jpeg">
                        <span class="card-title">Card Title</span>
                        <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
                    </div>
                    <div class="card-content">
                        <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


