$(document).ready(function(){
    $("form").submit(function(event){
        event.preventDefault();

        $.ajax({
            url: "change_pw.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if (response === "OK")
                {
                    $(".pwChangeInfoMsg").css("color", "green");
                    $(".pwChangeInfoMsg").html("<b> Lozinka uspješno promijenjena. </b>" + "<br> > <a href='../../login'> Login </a>");
                    $("form").trigger("reset"); // reset form upon successful password change
                }
                else
                {
                    $(".pwChangeInfoMsg").css("color", "red");
                    $(".pwChangeInfoMsg").html("<b>" + response + "</b>");
                }
            }
        });
    });
});