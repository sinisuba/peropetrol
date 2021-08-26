$(document).ready(function(){
    $("form").submit(function(event){
        event.preventDefault();

        $.ajax({
            url: "change_email.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if (response === "OK")
                {
                    $(".emailChangeInfoMsg").css("color", "green");
                    $(".emailChangeInfoMsg").html("<b> Mejl uspješno promijenjen. </b>" + "<br> > <a href='../../login'> Login </a>");
                    $("form").trigger("reset"); // reset form upon successful email change
                }
                else
                {
                    $(".emailChangeInfoMsg").css("color", "red");
                    $(".emailChangeInfoMsg").html("<b>" + response + "</b>");
                }
            }
        });
    });
});