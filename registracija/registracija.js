$(document).ready(function(){
    $("form").submit(function(event){
        event.preventDefault();

        $.ajax({
            url: "registracija.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if (response === "OK")
                {
                    $(".registracijaInfoMsg").css("color", "green");
                    $(".registracijaInfoMsg").html("<b> Uspješna registracija. </b>" + "<br> > <a href='../login'> Login </a>");
                    $("form").trigger("reset"); // reset form upon successful registration
                }
                else
                {
                    $(".registracijaInfoMsg").css("color", "red");
                    $(".registracijaInfoMsg").html("<b>" + response + "</b>");
                }
            }
        });
    });
});