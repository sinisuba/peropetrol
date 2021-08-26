$(document).ready(function(){
    $("form").submit(function(event){
        event.preventDefault();

        $.ajax({
            url: "novo_gorivo.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if (response === "OK")
                {
                    $(".newGorivoInfoMsg").css("color", "green");
                    $(".newGorivoInfoMsg").html("<b> Gorivo uspješno dodano! </b>");
                    $("form").trigger("reset"); // reset form upon success
                }
                else
                {
                    $(".newGorivoInfoMsg").css("color", "red");
                    $(".newGorivoInfoMsg").html("<b>" + response + "</b>");
                }
            }
        });
    });
});