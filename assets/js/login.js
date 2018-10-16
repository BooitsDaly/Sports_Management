//on click handler for when the login button is selected
$("#btnLogin").on('click', function(){
    //get the values fro the text fields
    var formData = $("#loginForm").serialize();
    $.ajax({
        url: 'BuisnessLayer/BLLogin.php',
        type: 'POST',
        async: false,
        cache: false,
        data: formData,
        success:function(response){
            console.log(response);
            if(response == 1){
                window.location.href = "PresentationLayer/admin.php";
            }else if(response == 2){

            }else if(response == 3 || response == 4){

            }else if(response == 5){

            }else if(response == "error"){
                //message that login failed
                $("body").append("<h1> Please fill all fields </h1>");
            }
        },
        error: function(xhr, textStatus, errorThrown){
            //if failed, then log it
            console.log("Failed");
        }
    });
});