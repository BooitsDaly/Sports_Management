<?php
/**
 * User: caitlyn
 * Date: 10/13/18
 * Time: 11:59 AM
 */
session_start();
if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 1){
        pageheader();
        title("Schedule");
        teamTable();
        footer();
    }elseif($_SESSION['role'] == 2){
        pageheader();
        title("Schedule");
        teamTable();
        footer();

    }elseif($_SESSION['role'] == 3){
        pageheader();
        title("Schedule");
        teamTable();
        footer();

    }
    elseif($_SESSION['role'] == 4){
        pageheader();
        title("Schedule");
        teamTable();
        footer();

    }
    elseif($_SESSION['role'] == 5){
        pageheader();
        title("Schedule");
        teamTable();
        footer();
    }else{
        header("Location: ./../index.php");
    }
    //find their role
}else{
    //redirect them to the login page
    header("Location: ./../index.php");
    //print a message that they have to login first
}
function pageheader(){
    echo "
    <html>
    <header>
        <!--Import Google Icon Font-->
        <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\">
        <!--Import materialize.css-->
        <link type=\"text/css\" rel=\"stylesheet\" href=\"./../assets/css/materialize.min.css\"  media=\"screen,projection\"/>

        <!--font awesome -->
        <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"assets/css/styles.css\"/>

        <!--Let browser know website is optimized for mobile-->
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>
        <title>Admin Home Page</title>

    </header>
    <body>
    <!-- Created header -->
    
        <nav class=\"navbar-fixed\">
        <div class=\"nav-wrapper\">
            <div class=\"banner nav-wrapper right\">
                <button id=\"logout\" class=\"btn\">LOGOUT</button>
            </div>
          <ul class=\"left\">";
            if($_SESSION['role'] == 5){
                echo "
            <li><a href=\"teamPage.php\" >Team Page</a></li>
            <li class='active'><a href=\"schedule.php\">Schedule Page</a></li>
          </ul>
        </div>
    </nav>";
            }else{
                echo "<li><a href=\"admin.php\">Admin Page</a></li>
            <li><a href=\"teamPage.php\">Team Page</a></li>
            <li class='active'><a href=\"schedule.php\">Schedule Page</a></li>
          </ul>
        </div>
    </nav>";
            }


    echo "<!-- Created container to hold everything for styling-->
    <div>";
}

function footer(){
    echo "
            <!--Import jQuery before materialize.js-->
        <script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-3.2.1.min.js\"></script>
        <script type=\"text/javascript\" src=\"../assets/js/materialize.min.js\"></script>

        <!-- CUSTOM JS -->
        <script type=\"text/javascript\" src=\"../assets/js/adminPage.js\"></script>
        <script type=\"text/javascript\" src=\"../assets/js/team.js\"></script>

        <script type=\"text/javascript\" src=\"../assets/js/logout.js\"></script>
        <script type=\"text/javascript\" src=\"../assets/js/schedule.js\"></script>

        <script type=\"text/javascript\" src=\"../assets/js/leagueManager.js\"></script>
        <script type=\"text/javascript\" src=\"../assets/js/teamManager.js\"></script>

    </body>
</html>
    ";

}
function title($title){
    echo"
            <!-- header -->
        <div class=\"row\">
            <h1 class=\"title center-align\">{$title}</h1>
        </div>
        
        ";
}

function teamTable(){
    echo "<div id='AscheduleTable'></div>";
}
