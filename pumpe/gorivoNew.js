$(document).ready(function(){
    $(".modalButtonAdd").click(function(){
        $("#addGorivoModal").show();
    });
    
    $("#addGorivo").submit(function(event){
        event.preventDefault();

        $.ajax({
            url: "novo_gorivo.php",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if (response === "OK")
                {
                    alert("Gorivo uspješno dodano!");
                    location.reload();
                }
                else
                {
                    $(".addGorivoModalErrMsg").css("color", "red");
                    $(".addGorivoModalErrMsg").html("<b>" + response + "</b>");
                }
            }
        });
    });
    
    $(".closeModal").click(function(){
        $("#addGorivoModal").hide();
    });
});