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


});

