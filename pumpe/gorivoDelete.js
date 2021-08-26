$(document).ready(function(){
    $(".modalButtonDelete").click(function(){
        $("#deleteGorivoModal").show();
    });

    $("#deleteGorivo").submit(function(event){
        event.preventDefault();

        $.ajax({
            url: "brisi_gorivo.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if (response === "OK")
                {
                    alert("Gorivo uspješno obrisano!");
                    location.reload();
                }
                else
                {
                    $(".deleteGorivoModalErrMsg").css("color", "red");
                    $(".deleteGorivoModalErrMsg").html("<b>" + response + "</b>");
                }
            }
        });
    });

    $(".closeModal").click(function(){
        $("#deleteGorivoModal").hide();
    });
});