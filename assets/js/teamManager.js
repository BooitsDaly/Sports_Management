$(document).ready(function(){
    $('select').formSelect();
    $.ajax({
        type: 'POST',
        async: true,
        cache: false,
        data: "call=view",
        url: './../BuisnessLayer/BLposition.php',
        success: function (response) {
            $("#positionTable").append(response);
        }
    });

    $.ajax({
        type: 'POST',
        async: true,
        cache: false,
        data: "call=view",
        url: './../BuisnessLayer/BLplayers.php',
        success: function (response) {
            $("#playerTable").append(response);
        }
    });

    // Players -- Modal
    $.ajax({
        type: 'POST',
        async: true,
        cache: false,
        data: "call=modal",
        url: './../BuisnessLayer/BLplayers.php',
        success: function(response){
            $("#playerTeams").append(response);
        }
    });

    $(document).on('click', '#positionAdd', function () {
        $(document).on('click', '#positionSave', function () {
            var position = $('#position').val();
            $.ajax({
                type: 'POST',
                async: true,
                cache: false,
                data: "call=add&position=" + position,
                url: './../BuisnessLayer/BLposition.php',
                success: function (response) {
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
     * Sports click event handlers
     *
     * add
     * delete
     * edit
     */
    $(document).on('click', '#playersAdd', function(){
        $("#userModalHeader").html('');
        $(document).on('click', '#playerSave', function(){
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var dob = $('#playerDOB').val();
            var jerseynumber = $('#jerseynumber').val();
            var team = $('select#playerTeamsModal').val();
            //create a post string
            var formData = "call=add&firstname="+firstname+"&lastname="+lastname+"&dob="+dob+"&jerseynumber="+ jerseynumber +"&team="+team;
            $.ajax({
                url: './../BuisnessLayer/BLplayers.php',
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

    $(document).on('click', '.deletePlayersButton', function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        var team = values[5];
        var jerseynumber = values[4];
        var formData = "call=delete&team=" + team + "&jerseynumber=" + jerseynumber;
        $.ajax({
            url: './../BuisnessLayer/BLplayers.php',
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
    $(document).on('click', '.editPlayersButton', function(){
        var value = $(this).closest('tr').find('td');
        var values = [];
        $.each(value, function(i,item){
            values[i] = item.innerHTML;
        });
        $(document).on('click', '#playerSave', function(){
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var dob = $('#playerDOB').val();
            var jerseynumber = $('#jerseynumber').val();
            var team = $('select#playerTeamsModal').val();
            var oldteam = values[5];
            var oldjerseynumber = values[4];
            //create a post string
            var formData = "call=edit&firstname="+firstname+"&lastname="+lastname+"&dob="+dob+"&jerseynumber="+ jerseynumber +"&team="+team+"&oldjerseynumber="+ oldjerseynumber +"&oldteam="+oldteam;
            console.log(formData);
            $.ajax({
                url: './../BuisnessLayer/BLplayers.php',
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
});