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
            console.log(response);
            $("#playerTable").append(response);
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
                    }
                }
            });
        });
    });
});