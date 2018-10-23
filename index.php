<!--
 * User: Caitlyn
 * Date: 10/9/2018
 * Time: 1:21 PM
 -->
<!DOCTYPE html>
<html class="no-js" lang="en">
    <header>


        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link rel="stylesheet" type="text/css" href="assets/css/styles.css"/>

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
                        <i class="large material-icons">directions_run</i>
                        <div>
                        </div>
                        <!--form information -->

                            <form class="col s12" id="loginForm">
                                <div class="row">
                                    Username:<div class="input-field col s12">
                                        <input id="username" type="text" class="validate" name="username">
                                        <label for="username"></label>
                                    </div>
                                </div>
                                <div class="row">
                                    Password:<div class="input-field col s12">
                                        <input id="password" type="password" class="validate" name="password">
                                        <label for="password"></label>
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

    <!-- JS includes -->
        <!--JQuery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/login.js"></script>

    </body>
</html>
