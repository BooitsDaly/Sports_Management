<!--
 * User: Caitlyn
 * Date: 10/9/2018
 * Time: 1:21 PM
 -->
<!DOCTYPE html>
<html class="no-js" lang="en">
    <header>
        <!--JQuery-->
        <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link rel="stylesheet" type="text/css" href="assets/css/loginPage.css"/>

    </header>
    <body>
        <div class="row valign-wrapper">
            <!-- Created container to hold everything for styling-->
            <div class="container">
                <!-- header -->
                <div class="row">
                    <h1 class="title center-align">Sports Management Software</h1>
                </div>
                <!-- image -->
                <div class="row">
                    <div class="center-align col s12">
                        <i class="large material-icons">school</i>
                        <div>
                        </div>
                        <!--form information -->
                        <div class="row">
                            <form class="col s12" id="loginForm">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="email" type="text" class="validate" name="username">
                                        <label for="email">Username</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" type="password" class="validate" name="password">
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <!-- Button -->
                                <div class="center-align row">
                                    <button class="btn waves-effect waves-light" type="button" id="btnLogin">Log in
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
