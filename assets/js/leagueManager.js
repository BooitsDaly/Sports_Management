$(document).ready(function(){
    $.ajax({
        type: 'GET',
        async: true,
        cache: false,
        url: './../BuisnessLayer/BLAllSeasons.php',
        success: function(response){
            $("#seasonsTable").append(response);
        }
    });
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

    $.ajax({
        type: 'GET',
        async: true,
        cache: false,
        url: './../BuisnessLayer/BLSLmodal.php',
        success: function(response){
            $("#SLSeasonModalContent").append(response);
        }
    });
    var footerString = "<div class=\"modal-footer\">\n" +
        "                <a id='editSSLSaveChanges' href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Save Changes</a>\n" +
        "            </div>";

    setTimeout(function(){
        $("#SLSeasonModalContent").append(footerString);
        $('.modal').modal();
        $('select').formSelect();
    },1000);



    /**
     * Click event handler for the edit button
     */
    $(document).on('click','#seasonAdd',function(){
        console.log("I got clicked 1");
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
                    }

                }
            });

        });
    });

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
                console.log(response);
                if(response == "Success!"){
                    window.location.reload();
                }

            }
        });
    });

    /**
     *click event handler for edit
     */
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
                    }
                }
            });
        });
    });

    /**
     * Click event handler for the edit button
     */
    $(document).on('click','.editSLSeasonsButton',function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        $("#SLSeasonModalHeader").html(values[0]);
        $(document).on('click', '#editSSLSaveChanges', function(){
            //get the selections for the edit content
            var newSport = $('select#SLSsport').val();
            var league = $('select#SLSleague').val();
            var season = $('select#SLSseason').val();
            var oldSport = values[0];
            //create a post string
            var formData ="call=edit&oldSport="+ oldSport+"&newSport="+ newSport+"&league="+league+"&season="+season;
            $.ajax({
                url: './../BuisnessLayer/SLSeasons.php',
                type: 'POST',
                async: false,
                cache: false,
                data: formData,
                success:function(response){
                    $('body').append(response);
                    console.log(response);
                    if(response == "Success!"){
                        console.log(response);
                        //window.location.reload();
                    }

                }
            });

        });
    });

    /**
     * Click event handler for the edit button
     */
    $(document).on('click','#SLseasonAdd',function(){
        $(document).on('click', '#editSSLSaveChanges', function(){
            var newSport = $('select#SLSsport').val();
            var league = $('select#SLSleague').val();
            var season = $('select#SLSseason').val();
            //create a post string
            var formData = "call=add&sport="+ newSport+"&league="+league+"&season="+season;
            $.ajax({
                url: './../BuisnessLayer/SLSeasons.php',
                type: 'POST',
                async: false,
                cache: false,
                data: formData,
                success:function(response){
                    $("body").append(response);
                    console.log(response);
                    if(response == "Success!"){
                        window.location.reload();
                    }

                }
            });

        });
    });


});

