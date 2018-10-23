$(document).ready(function(){
    /**
     * AJAX calls to load tables and modals:
     *
     * User
     * Sports
     * Players
     *
     */

    //initiate forms
    $('select').formSelect();

    //User Table
    $.ajax({
        type: 'POST',
        async: true,
        cache: false,
        data: "call=view",
        url: './../BuisnessLayer/BLuser.php',
        success: function(response){
            $("#userTable").append(response);
        }
    });

    //User -- Modal
    $.ajax({
        type: 'GET',
        async: true,
        cache: false,
        url: './../BuisnessLayer/BLTeamNames.php',
        success: function(response){
            $("#userModalContent").append(response);
        }
    });

    //User -- Modal
    $.ajax({
        type: 'GET',
        async: true,
        cache: false,
        url: './../BuisnessLayer/BLLeagueNames.php',
        success: function(response){
            $("#userModalContent").append(response);
            var footerString = "<div class=\"modal-footer\">\n" +
                "                <a id='editSaveChanges' href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Save Changes</a>\n" +
                "            </div>";
            //wait for the ajax responses to come in
            setTimeout(function(){
                $("#userModalContent").append(footerString);
                $('.modal').modal();
                $('select').formSelect();
            },1000);
        }
    });

    //Sports Table
    $.ajax({
        type: 'GET',
        async: true,
        cache: false,
        url: './../BuisnessLayer/BLAllSports.php',
        success: function(response){
            $("#sportsTable").append(response);
        }
    });


    /**
     * Click event handlers:
     *
     * User
     * Sports
     */

    /**
     * User click event handlers
     *
     * add
     * delete
     * edit
     */

    //edit -- user
    $(document).on('click','.editButton',function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        $("#userModalHeader").html(values[0]);
        $(document).on('click', '#editSaveChanges', function(){
            //get the selections for the edit content
            var role = $('select#role').val();
            var league = $('select#league').val();
            var team = $('select#team').val();
            var username = $("#editUsername").val();
            var password = $("#editPassword").val();
            var oldUser = values[0];
            //create a post string
            var formData = "call=edit&newUser="+username+"&password="+password+"&role="+role+"&league="+ league +"&team="+team+"&oldUser="+ oldUser;
            console.log(formData);
            $.ajax({
                url: './../BuisnessLayer/BLuser.php',
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

    //User -- Add
    $(document).on('click', '#userAdd', function(){
        $("#userModalHeader").html('');
        $(document).on('click', '#editSaveChanges', function(){
            var role = $('select#role').val();
            var league = $('select#league').val();
            var team = $('select#team').val();
            var username = $("#editUsername").val();
            var password = $("#editPassword").val();
            //create a post string
            var formData = "call=add&username="+username+"&password="+password+"&role="+role+"&league="+ league +"&team="+team;
            $.ajax({
                url: './../BuisnessLayer/BLuser.php',
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

    //User -- Delete
    $(document).on('click', '.deleteButton', function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        //create a post string
        var formData = "call=delete&username="+values[0];
        $.ajax({
            url: './../BuisnessLayer/BLuser.php',
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
     * Sports click event handlers
     *
     * add
     * delete
     * edit
     */

    //Sports -- edit
    $(document).on('click', '.editSportsButton', function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        $(document).on('click','#sportsSave',function(){
            var ID = $("#editSportID").val();
            var sportName = $("#editSportName").val();
            var formData= "call=edit&oldID="+values[0]+"&newID="+ ID+ "&sportName=" + sportName;
            $.ajax({
                type: 'POST',
                async: true,
                cache: false,
                data: formData,
                url: './../BuisnessLayer/BLsports.php',
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

    //Sports -- Delete
    $(document).on('click', '.deleteSportsButton', function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        var formData= "call=delete&ID="+ values[0];
        $.ajax({
            type: 'POST',
            async: true,
            cache: false,
            data: formData,
            url: './../BuisnessLayer/BLsports.php',
            success: function(response){
                if(response == "Success!"){
                    window.location.reload();
                }else{
                    $('body').append(response);
                }
            }
        });

    });

    //Sports Add
    $(document).on('click', '#editSports', function(){
        $(document).on('click','#sportsSave',function(){
            var ID = $("#editSportID").val();
            var sportName = $("#editSportName").val();
            var formData= "call=add&ID="+ ID+ "&sportName=" + sportName;
            $.ajax({
                type: 'POST',
                async: true,
                cache: false,
                data: formData,
                url: './../BuisnessLayer/BLsports.php',
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


});

