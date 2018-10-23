$(document).ready(function(){

    /**
     * AJAX calls to load tables and modals:
     * Seasons
     * Sports Leagues Seasons
     *  SLS Modal
     * Leagues
     * Games
     * Users
     */

    //Seasons
    $.ajax({
        type: 'GET',
        async: true,
        cache: false,
        url: './../BuisnessLayer/BLAllSeasons.php',
        success: function(response){
            $("#seasonsTable").append(response);
        }
    });

    //Sports Leagues Seasons
    $.ajax({
        type: 'POST',
        async: true,
        cache: false,
        data: "call=view",
        url: './../BuisnessLayer/SLSeasons.php',
        success: function(response){
            $("#SLSeasonsTable").append(response);
        }
    });

    //Sports Leagues Seasons - Modal
    $.ajax({
        type: 'GET',
        async: true,
        cache: false,
        url: './../BuisnessLayer/BLSLmodal.php',
        success: function(response){
            $("#SLSeasonModalContent").append(response);
            var footerString = "<div class=\"modal-footer\">\n" +
                "                <a id='editSSLSaveChanges' href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Save Changes</a>\n" +
                "            </div>";

            setTimeout(function(){
                $("#SLSeasonModalContent").append(footerString);
                $('.modal').modal();
                $('select').formSelect();
            },1000);
        }
    });

    //Teams
    $.ajax({
        type: 'POST',
        async: true,
        cache: false,
        data: "call=view",
        url: './../BuisnessLayer/BLteam.php',
        success: function(response){
            $("#teamTable").append(response);
        }
    });

    //Team - Modal
    $.ajax({
        type: 'POST',
        async: true,
        cache: false,
        url: './../BuisnessLayer/BLTmodal.php',
        success: function(response){
            $("#modalSelectsTeam").append(response);
        }
    });

    //Games
    $.ajax({
        type: 'POST',
        async: true,
        cache: false,
        data: "call=view",
        url: './../BuisnessLayer/BLschedules.php',
        success: function(response){
            $("#scheduleTable").append(response);
        }
    });
    //Games - Modal
    $.ajax({
        type: 'POST',
        async: true,
        cache: false,
        data: "call=modal",
        url: './../BuisnessLayer/BLschedules.php',
        success: function(response){
            $("#teamModal").append(response);
        }
    });


    /**
     * Click event handlers:
     *
     * Seasons
     * Sports Leagues Seasons
     *  SLS Modal
     * Leagues
     * Games
     * Users
     */

    /**
     * Season click event handlers
     *
     * add
     * delete
     * edit
     */

    //add Seasons
    $(document).on('click','#seasonAdd',function(){
        $(document).on('click', '#seasonSave', function(){
            var id = $("#editSeasonID").val();
            var year = $("#editSeasonYear").val();
            var description = $("#editSeasonDesc").val();
            //create a post string
            var formData = "id="+id+"&year="+year+"&description=" + description;
            $.ajax({
                url: './../BuisnessLayer/BLaddSeason.php',
                type: 'POST',
                async: false,
                cache: false,
                data: formData,
                success:function(response){
                    $("body").append(response);
                    if(response == "Success!"){
                        window.location.reload();
                    }else{
                        $('body').append(response);
                    }

                }
            });

        });
    });

    //delete seasons
    $(document).on('click', '.deleteSeasonsButton', function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        //create a post string
        var formData = "id="+values[0];
        $.ajax({
            url: './../BuisnessLayer/BLDeleteSeason.php',
            type: 'POST',
            async: false,
            cache: false,
            data: formData,
            success:function(response){
                if(response == "Success!"){
                    window.location.reload();
                }else{
                    $('body').append(response);
                }

            }
        });
    });

    //edit seasons
    $(document).on('click', '.editSeasonsButton', function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        $(document).on('click','#seasonSave',function(){
            var newID = $("#editSeasonID").val();
            var year = $("#editSeasonYear").val();
            var description = $("#editSeasonDesc").val();
            var formData= "oldID="+values[0]+"&newID="+ newID+ "&year=" + year + "&description=" + description;
            $.ajax({
                type: 'POST',
                async: true,
                cache: false,
                data: formData,
                url: './../BuisnessLayer/BLeditSeasons.php',
                success: function(response){
                    if(response == "Success!"){
                        window.location.reload();
                    }else{
                        $('body').append(response);
                    }
                }
            });
        });
    });

    /**
     * Season League Sport click event handlers
     *
     * edit
     * add
     * delete
     */

    //edit Sports Leagues Seasons
    $(document).on('click','.editSLSeasonsButton',function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        $("#SLSeasonModalHeader").html(values[0]);
        $(document).on('click', '#editSSLSaveChanges', function(){
            //get the selections for the edit content
            var newSport = $('select#SSLsport').val();
            var league = $('select#SSLleague').val();
            var season = $('select#SSLseason').val();
            var oldSport = values[0];
            var oldSeason = values[1];
            var oldLeague =values[2];
            //create a post string
            var formData ="call=edit&oldSport="+ oldSport+"&newSport="+ newSport+"&league="+league+"&season="+season + "&oldSeason=" + oldSeason + "&oldLeague=" + oldLeague;
            $.ajax({
                url: './../BuisnessLayer/SLSeasons.php',
                type: 'POST',
                async: false,
                cache: false,
                data: formData,
                success:function(response){
                    $('body').append(response);
                    if(response == "Success!"){
                        window.location.reload();
                    }else{
                        $('body').append(response);
                    }

                }
            });

        });
    });

    //add Sports Leagues Seasons
    $(document).on('click','#SLseasonAdd',function(){
        $(document).on('click', '#editSSLSaveChanges', function(){
            var newSport = $('select#SSLsport').val();
            var league = $('select#SSLleague').val();
            var season = $('select#SSLseason').val();
            //create a post string
            var formData = "call=add&sport="+ newSport+"&league="+league+"&season="+season;
            $.ajax({
                url: './../BuisnessLayer/SLSeasons.php',
                type: 'POST',
                async: false,
                cache: false,
                data: formData,
                success:function(response){
                    if(response == "Success!"){
                        window.location.reload();
                    }else{
                        $('body').append(response);
                    }

                }
            });

        });
    });

    //delete Season Sport League
    $(document).on('click','.deleteSLSeasonsButton', function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });

        var oldSport = values[0];
        var oldSeason = values[1];
        var oldLeague =values[2];
        //create a post string
        var formData ="call=delete&oldSport="+ oldSport + "&oldSeason=" + oldSeason + "&oldLeague=" + oldLeague;
        $.ajax({
            url: './../BuisnessLayer/SLSeasons.php',
            type: 'POST',
            async: false,
            cache: false,
            data: formData,
            success:function(response){
                if(response == "Success!"){
                    window.location.reload();
                }else{
                    $('body').append(response);
                }
            }
        });

    });

    /**
     * Teams click event handlers
     *
     * edit
     * add
     * delete
     */

    //Teams - edit
    $(document).on('click','.editTeamsButton', function() {
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        var id = values[0];
        $(document).on('click', '#teamSave', function () {
            var $name = $("#teamName").val();
            var $mascot = $("#teamMascot").val();
            var $sls = $('select#teamsls').val();
            if($sls === null){
                alert("Fill in all fields");
            }
            var splitString = $sls.split(",");
            var $sport = splitString[0];
            var $league = splitString[1];
            var $season =splitString[2];
            var $picture =$("#teamPicture").val();
            var $homecolor = $("#homeColor").val();
            var $awaycolor = $("#awayColor").val();
            var $maxplayers = $("#maxplayers").val();
            var formData = "call=edit&name=" + $name + "&id="+ id + "&sport=" + $sport + "&league=" + $league + "&season=" + $season  + "&awaycolor=" + $awaycolor;

            if($mascot !== undefined || $mascot !== null){
                formData += "&mascot=" + $mascot;
            }
            if($picture !== undefined || $picture !== null){
                formData += "&picture=" + $picture;
            }
            if($homecolor !== undefined || $homecolor !== null){
                formData += "&homecolor=" + $homecolor;
            }
            if($maxplayers !== undefined || $maxplayers !== null){
                formData += "&maxplayers=" + $maxplayers;
            }

            //create a post string
            $.ajax({
                url: './../BuisnessLayer/BLteam.php',
                type: 'POST',
                async: false,
                cache: false,
                data: formData,
                success: function (response) {
                    console.log(response);
                    $('body').append(response);
                    if (response == "Success!") {
                        window.location.reload();
                    }else{
                        $('body').append(response);
                    }
                }
            });

        });
    });

    //Teams - Add
    $(document).on('click','#teamAdd', function() {
        $(document).on('click', '#teamSave', function () {
            var $name = $("#teamName").val();
            var $mascot = $("#teamMascot").val();
            var $sls = $('select#teamsls').val();
            if($sls === null){
                alert("Fill in all fields");
            }
            var splitString = $sls.split(",");
            var $sport = splitString[0];
            var $league = splitString[1];
            var $season =splitString[2];
            var $picture =$("#teamPicture").val();
            var $homecolor = $("#homeColor").val();
            var $awaycolor = $("#awayColor").val();
            var $maxplayers = $("#maxplayers").val();
            var formData = "call=add&name=" + $name  + "&sport=" + $sport + "&league=" + $league + "&season=" + $season  + "&awaycolor=" + $awaycolor;

            if($mascot !== undefined || $mascot !== null){
                formData += "&mascot=" + $mascot;
            }
            if($picture !== undefined || $picture !== null){
                formData += "&picture=" + $picture;
            }
            if($homecolor !== undefined || $homecolor !== null){
                formData += "&homecolor=" + $homecolor;
            }
            if($maxplayers !== undefined || $maxplayers !== null){
                formData += "&maxplayers=" + $maxplayers;
            }

            //create a post string
            $.ajax({
                url: './../BuisnessLayer/BLteam.php',
                type: 'POST',
                async: false,
                cache: false,
                data: formData,
                success: function (response) {
                    if (response == "Success!") {
                        window.location.reload();
                    }else{
                        $('body').append(response);
                    }
                }
            });

        });
    });

    //delete Team
    $(document).on('click','.deleteScheduleButton', function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });

        var sport = values[0];
        var league = values[1];
        var season = values[2];
        var hometeam = values[3];
        var awayteam = values[4];
        var homescore = values[5];
        var awayscore = values[6];
        var scheduled = values[7];
        var completed = values[8];

        //create a post string
        var formData = "call=delete&sport=" + sport  + "&league=" + league + "&season=" + season + "&hometeam=" + hometeam  + "&awayteam=" + awayteam+ "&homescore=" + homescore  + "&awayscore=" + awayscore + "&scheduled=" + scheduled+ "&completed=" + completed;
        $.ajax({
            url: './../BuisnessLayer/BLschedules.php',
            type: 'POST',
            async: false,
            cache: false,
            data: formData,
            success:function(response){
                if(response == "Success!"){
                    window.location.reload();
                }else{
                    $('body').append(response);
                }
            }
        });

    });

    /**
     * Games click event handlers
     *
     * edit
     * add
     * delete
     */

    //Teams - edit
    $(document).on('click','.editScheduleButton', function() {
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        var id = values[0];
        $(document).on('click', '#scheduleSave', function () {
            var $sls = $('select#scheduleSLS').val();
            var splitString = $sls.split(",");
            if($sls === null){
                alert("Fill in all fields");
            }
            var $sport = splitString[0];
            var $league = splitString[1];
            var $season =splitString[2];
            var hometeam = $('select#hometeam').val();
            var awayteam = $('select#awayteam').val();
            var homescore = $('#homeScore').val();
            var awayscore = $('#awayScore').val();
            var scheduled = $('#scheduleDate').val();
            var completed = $('#completed').val();

            var oldsport = values[0];
            var oldleague = values[1];
            var oldseason = values[2];
            var oldhometeam = values[3];
            var oldawayteam = values[4];
            var oldhomescore = values[5];
            var oldawayscore = values[6];
            var oldscheduled = values[7];
            var oldcompleted = values[8];


            var formData = "call=edit&sport=" + $sport  + "&league=" + $league + "&season=" + $season + "&hometeam=" + hometeam  + "&awayteam=" + awayteam+ "&homescore=" + homescore  + "&awayscore=" + awayscore + "&scheduled=" + scheduled+ "&completed=" + completed + "&oldsport=" + oldsport  + "&oldleague=" + oldleague + "&oldseason=" + oldseason + "&oldhometeam=" + oldhometeam  + "&oldawayteam=" + oldawayteam+ "&oldhomescore=" + oldhomescore  + "&oldawayscore=" + oldawayscore + "&oldscheduled=" + oldscheduled+ "&oldcompleted=" + oldcompleted;

            //create a post string
            $.ajax({
                url: './../BuisnessLayer/BLschedules.php',
                type: 'POST',
                async: false,
                cache: false,
                data: formData,
                success: function (response) {
                    if (response == "Success!") {
                        window.location.reload();
                    }
                }
            });

        });
    });

    //Teams - Add
    $(document).on('click','#scheduleAdd', function() {
        $(document).on('click', '#scheduleSave', function () {
            var $sls = $('select#scheduleSLS').val();
            if($sls === null){
                alert("Fill in all fields");
            }
            var splitString = $sls.split(",");
            var $sport = splitString[0];
            var $league = splitString[1];
            var $season =splitString[2];
            var hometeam = $('select#hometeam').val();
            var awayteam = $('select#awayteam').val();
            var homescore = $('#homeScore').val();
            var awayscore = $('#awayScore').val();
            var scheduled = $('#scheduleDate').val();
            var completed = $('#completed').val();

            var formData = "call=add&sport=" + $sport  + "&league=" + $league + "&season=" + $season + "&hometeam=" + hometeam  + "&awayteam=" + awayteam+ "&homescore=" + homescore  + "&awayscore=" + awayscore + "&scheduled=" + scheduled+ "&completed=" + completed;

            //create a post string
            $.ajax({
                url: './../BuisnessLayer/BLschedules.php',
                type: 'POST',
                async: false,
                cache: false,
                data: formData,
                success: function (response) {
                    $('body').append(response);
                    if (response == "Success!") {
                        window.location.reload();
                    }
                }
            });

        });
    });

    //delete Team
    $(document).on('click','.deleteTeamsButton', function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });

        var teamID = values[0];

        //create a post string
        var formData ="call=delete&id="+ teamID;
        $.ajax({
            url: './../BuisnessLayer/BLteam.php',
            type: 'POST',
            async: false,
            cache: false,
            data: formData,
            success:function(response){
                if(response == "Success!"){
                    window.location.reload();
                }
            }
        });

    });




});

