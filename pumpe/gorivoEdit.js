$(document).ready(function(){
    var $current_location;

    $(".modalButtonIzmjena").click(function(){
        $("#editGorivoModal").show();
        
        $current_location = $(this).closest("tr").find(".currentRowLocation").text();
    });

    $("#editGorivo").submit(function(event){
        event.preventDefault();
        
        $.ajax({
            url: "izmjena_gorivo.php",
            type: "POST",
            data: $(this).serialize() + "&selectedLocation=" + $current_location,
            success: function(response) {
                if (response === "OK")
                {
                    alert("Količina goriva uspješno izmijenjena.");
                    location.reload();
                }
                else
                {
                    $(".editGorivoModalErrMsg").css("color", "red");
                    $(".editGorivoModalErrMsg").html("<b>" + response + "</b>");
                }
            }
        });
    });

    $(".closeModal").click(function(){
        $("#editGorivoModal").hide();
    });
});