$(document).ready(function(){
    $("form").submit(function(event){
        event.preventDefault();

        $.ajax({
            url: "novi_radnik.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if (response === "OK")
                {
                    $(".radnikNewInfoMsg").css("color", "green");
                    $(".radnikNewInfoMsg").html("<b> Radnik uspješno registrovan! </b>");
                    $("form").trigger("reset"); // reset form upon successful registration
                }
                else
                {
                    $(".radnikNewInfoMsg").css("color", "red");
                    $(".radnikNewInfoMsg").html("<b>" + response + "</b>");
                }
            }
        });
    });
});