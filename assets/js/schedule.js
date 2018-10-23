$(document).ready(function(){
    /**
    *get the schedule table
     */
    $.ajax({
        type: 'POST',
        async: true,
        cache: false,
        data: "call=schedulePage",
        url: './../BuisnessLayer/BLschedules.php',
        success: function(response){
            $("#AscheduleTable").append(response);
        }
    });
});