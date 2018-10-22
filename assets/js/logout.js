$('#logout').click(function(){
    $.ajax({
        type: 'POST',
        async: true,
        cache: false,
        url: './../BuisnessLayer/logout.php',
        success: function(response){
            window.location = "http://serenity.ist.rit.edu/~cnd9351/341/Sports_Management/";

        }
    });
});