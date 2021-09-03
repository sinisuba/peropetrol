$(document).ready(function(){
    let $email;

    $(".modalButtonBrisi").click(function(){
        $("#confirmationModal").show();

        $email = $(this).closest("tr").find(".currentRowEmail").text();

        $(".confirmationText").html("Jeste li sigurni da želite obrisati radnika <b>" + $email + "</b>?");
    });
    
    $("#buttonDeleteYes").click(function(){
        $.ajax({
            url: "brisi_radnika.php",
            type: "POST",
            data: { radnik_email: $email },
            success: function(response){
                if (response === "OK")
                {
                    alert("Radnik uspješno obrisan.");
                    location.reload();
                }
                else alert("Greška, pokušajte ponovo.");
            }
        });
    });

    $(".closeModal, #buttonDeleteNo").click(function(){
        $("#confirmationModal").hide();
    });
});