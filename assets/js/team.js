$(document).ready(function(){
    $.ajax({
        type: 'POST',
        async: true,
        cache: false,
        data: "call=viewPage",
        url: './../BuisnessLayer/BLteam.php',
        success: function (response) {
            $("#AteamTable").append(response);
        }
    });
});