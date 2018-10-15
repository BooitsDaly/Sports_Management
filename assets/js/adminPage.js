$(document).ready(function(){
    $('select').formSelect();
    $.ajax({
        type: 'GET',
        async: true,
        cache: false,
        url: './../BuisnessLayer/BLAdminUser.php',
        success: function(response){
            $("#userTable").append(response);
        }
    });
    $.ajax({
        type: 'GET',
        async: true,
        cache: false,
        url: './../BuisnessLayer/BLTeamNames.php',
        success: function(response){
            $("#userModalContent").append(response);
        }
    });
    $.ajax({
        type: 'GET',
        async: true,
        cache: false,
        url: './../BuisnessLayer/BLLeagueNames.php',
        success: function(response){
            $("#userModalContent").append(response);
        }
    });
    var footerString = "<div class=\"modal-footer\">\n" +
        "                <a id='editSaveChanges' href=\"#!\" class=\"modal-close waves-effect waves-green btn-flat\">Save Changes</a>\n" +
        "            </div>";
    //wait for the ajax responses to come in
    setTimeout(function(){
        $("#userModalContent").append(footerString);
        $('.modal').modal();
        $('select').formSelect();
    },1000);


    /**
     * Click event handler for the edit button
     */
    $(document).on('click','.editButton',function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        console.log(values);
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
            var formData = "newUser="+username+"&password="+password+"&role="+role+"&league="+ league +"&team="+team+"&oldUser="+ oldUser;
            $.ajax({
                url: './../BuisnessLayer/BLeditUser.php',
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

    $(document).on('click', '#userAdd', function(){
        console.log('clicked on');
        $("#userModalHeader").html('');
        $(document).on('click', '#editSaveChanges', function(){
            var role = $('select#role').val();
            var league = $('select#league').val();
            var team = $('select#team').val();
            var username = $("#editUsername").val();
            var password = $("#editPassword").val();
            //create a post string
            var formData = "username="+username+"&password="+password+"&role="+role+"&league="+ league +"&team="+team;
            $.ajax({
                url: './../BuisnessLayer/BLaddUser.php',
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

    $(document).on('click', '.deleteButton', function(){
        console.log('got clicked on');
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        console.log(values);
        //create a post string
        var formData = "username="+values[0];
        console.log(formData);
        $.ajax({
            url: './../BuisnessLayer/BLDeleteUser.php',
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





});

