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
        title("Admin Page");
        userTable();
        adminPage();
        leagueManager();
        teamManager();
        footer();
    }elseif($_SESSION['role'] == 2){
        pageheader();
        title("League Manager Page");
        userTable();
        leagueManager();
        teamManager();
        footer();

    }elseif($_SESSION['role'] == 3){
        pageheader();
        title("Team Manager Page");
        userTable();
        teamManager();
        footer();

    }
    elseif($_SESSION['role'] == 4){
        pageheader();
        title("Coach");
        userTable();
        teamManager();
        footer();

    }
    elseif($_SESSION['role'] == 5){
        header("./teamPage.php");
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
          <ul class=\"left\">
            <li class=\"active\"><a href=\"admin.php\">Admin Page</a></li>
            <li><a href=\"teamPage.php\">Team Page</a></li>
            <li ><a href=\"schedule.php\">Schedule Page</a></li>
          </ul>
        </div>
    </nav>

    <!-- Created container to hold everything for styling-->
    <div>
    
    ";
}

function footer(){
    echo "
            <!--Import jQuery before materialize.js-->
        <script type=\"text/javascript\" src=\"https://code.jquery.com/jquery-3.2.1.min.js\"></script>
        <script type=\"text/javascript\" src=\"../assets/js/materialize.min.js\"></script>

        <!-- CUSTOM JS -->
        <script type=\"text/javascript\" src=\"../assets/js/adminPage.js\"></script>
        <script type=\"text/javascript\" src=\"../assets/js/logout.js\"></script>
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

function userTable()
{
    echo "
    
        <!-- The sections below will be dynamically created once get information out of the database -->
        <div id=\"userTable\"></div>
        <!-- Modal Structure -->
        <div id=\"edit\" class=\"modal\">
            <div id=\"userModalContent\" class=\"modal-content\">
                <h4 id=\"userModalHeader\"></h4>

                <div class=\"input-field col s12\">
                    <input id=\"editUsername\" class=\"validate\" type=\"text\">
                    <label for=\"editUsername\">Username</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"editPassword\" class=\"validate\" type=\"password\">
                    <label for=\"editPassword\">Password</label>
                </div>


                <div class=\"input-field col s12\">
                    <select id=\"role\">";
                    if($_SESSION['role'] == 1){
                        echo "<option class=\"role\" value=\"\" disabled selected>Choose a new Role</option>
                        <option class=\"role\" value=\"1\">Admin</option>
                        <option class=\"role\" value=\"2\">League Manager</option>";
                        }
                        if($_SESSION['role'] == 3 ||$_SESSION['role'] == 4 || $_SESSION['role'] == 1){
                            echo "<option class=\"role\" value=\"3\">Team Manager</option>
                        <option class=\"role\" value=\"4\">Coach</option>
                        <option class=\"role\" value=\"5\">Parent</option>";
                        }else if($_SESSION['role'] == 2){
                            echo "<option class=\"role\" value=\"3\">Team Manager</option>
                        <option class=\"role\" value=\"4\">Coach</option>";
                        }

                    echo "</select>
                    <label>Role</label>
                </div>
            </div>
        </div>";
}

function adminPage(){
    echo"
        <!-- Sports Section -->
        <!-- Sports Section -->
        <div id=\"sportsTable\"></div>
        <!-- Modal Structure -->
        <div id=\"editSports\" class=\"modal\">
            <div id=\"sportModalContent\" class=\"modal-content\">
                <h4 id=\"sportModalHeader\"></h4>
                <div class=\"input-field col s12\">
                    <input id=\"editSportID\" class=\"validate\" type=\"number\">
                    <label for=\"editSportID\">Sport ID</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"editSportName\" class=\"validate\" type=\"text\">
                    <label for=\"editSportName\">Sport Name</label>
                </div>
            </div>
            <div class=\"modal-footer\">
                <a id='sportsSave' href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Save Changes</a>
            </div>
        </div>
    ";
}


function leagueManager(){
    echo "
        <div id='seasonsTable'></div>
        <!-- Modal Structure -->
        <div id=\"editSeasons\" class=\"modal\">
            <div id=\"SeasonModalContent\" class=\"modal-content\">
                <h4 id=\"SeasonModalHeader\"></h4>
                <div class=\"input-field col s12\">
                    <input id=\"editSeasonID\" class=\"validate\" type=\"number\">
                    <label for=\"editSeasonID\">Season ID</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"editSeasonYear\" class=\"validate\" type=\"number\">
                    <label for=\"editSeasonYear\">Season Year</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"editSeasonDesc\" class=\"validate\" type=\"text\">
                    <label for=\"editSeasonDesc\">Season Description</label>
                </div>
            </div>
            <div class=\"modal-footer\">
                <a id='seasonSave' href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Save Changes</a>
            </div>
        </div>
        <div id=\"SLSeasonsTable\"></div>
        <div id=\"editSLSeasons\" class=\"modal\">
            <div id=\"SLSeasonModalContent\" class=\"modal-content\">
                <h4 id=\"SLSeasonModalHeader\"></h4>
                <!-- get the available seasons sport league -->
            </div>
            
        </div>
        <div id='teamTable'></div>
        <!-- Modal Structure -->
        <div id=\"editTeams\" class=\"modal\">
            <div id=\"teamModalContent\" class=\"modal-content\">
                
                <div class=\"input-field col s12\">
                    <input id=\"teamName\" class=\"validate\" type=\"text\">
                    <label for=\"teamName\">Team Name</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"teamMascot\" class=\"validate\" type=\"text\">
                    <label for=\"teamMascot\">Mascot</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"teamPicture\" class=\"validate\" type=\"text\">
                    <label for=\"teamPicture\">Team Picture</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"homeColor\" class=\"validate\" type=\"text\">
                    <label for=\"homeColor\">Home Color</label>
                </div>
                <div id='modalSelectsTeam'></div>
                <div class=\"input-field col s12\">
                    <input id=\"awayColor\" class=\"validate\" type=\"text\">
                    <label for=\"awayColor\">Away Color</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"maxplayers\" class=\"validate\" type=\"number\">
                    <label for=\"maxplayers\">Max Players</label>
                </div>
            </div>
            <div class=\"modal-footer\">
                <a id='teamSave' href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Save Changes</a>
            </div>
        </div>
        
        <div id='scheduleTable'></div>
        <!-- Modal Structure -->
        <div id=\"editSchedule\" class=\"modal\">
            <div id=\"scheduleModalContent\" class=\"modal-content\">
                <div id='teamModal'></div>
                <div class=\"input-field col s12\">
                    <input id=\"homeScore\" class=\"validate\" type=\"number\">
                    <label for=\"homeScore\">Home Score</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"awayScore\" class=\"validate\" type=\"number\">
                    <label for=\"awayScore\">Away Score</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"scheduleDate\" class=\"validate\" type=\"date\">
                    <label for=\"scheduleDate\">Date</label>
                </div>
                <div class=\"input-field col s12\">
                <select id='completed'>
                  <option value=\"\" disabled selected>Game Completed?</option>
                  <option value=\"1\">Yes</option>
                  <option value=\"0\">No</option>
                </select>
                <label>Completed</label>
              </div>
            </div>
            <div class=\"modal-footer\">
                <a id='scheduleSave' href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Save Changes</a>
            </div>
        </div>
        
    ";
}
function teamManager(){
    echo "
        <div id='positionTable'></div>
            <!-- Modal Structure -->
        <div id=\"editPosition\" class=\"modal\">
            <div id=\"positionModalContent\" class=\"modal-content\">
                <div id='positionModal'></div>
                <div class=\"input-field col s12\">
                    <input id=\"position\" class=\"validate\" type=\"text\">
                    <label for=\"position\">Position</label>
                </div>
              </div>
            <div class=\"modal-footer\">
                <a id='positionSave' href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Save Changes</a>
            </div>
        </div>
        
        <div id='playerTable'></div>
        <!-- Modal Structure -->
        <div id=\"editPlayers\" class=\"modal\">
            <div id=\"playerModalContent\" class=\"modal-content\">
                <div id='playerModal'></div>
                <div class=\"input-field col s12\">
                    <input id=\"firstname\" class=\"validate\" type=\"text\">
                    <label for=\"firstname\">First Name</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"lastname\" class=\"validate\" type=\"text\">
                    <label for=\"lastname\">Last Name</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"playerDOB\" class=\"validate\" type=\"date\">
                    <label for=\"playerDOB\">Date of Birth</label>
                </div>
                <div class=\"input-field col s12\">
                    <input id=\"jerseynumber\" class=\"validate\" type=\"number\">
                    <label for=\"jerseynumber\">Jersey Number</label>
                </div>
                <div id='playerTeams'></div>
            </div>
            <div class=\"modal-footer\">
                <a id='playerSave' href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Save Changes</a>
            </div>
        </div>
        ";
}




