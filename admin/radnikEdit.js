$(document).ready(function(){
    var $email;

    $(".modalButtonIzmjena").click(function(){
        $("#editUserModal").show();
        
        $email = $(this).closest("tr").find(".currentRowEmail").text();

        $(".selectedRadnik").html("Radnik <b>" + $email + "</b>");
    });

    $("form").submit(function(event){
        event.preventDefault();

        $.ajax({
            url: "izmjena_radnik.php",
            type: "POST",
            data: $(this).serialize() + "&selectedUserEmail=" + $email,
            success: function(response) {
                if (response === "OK")
                {
                    alert("Radnik uspješno izmijenjen.");
                    location.reload();
                }
                else
                {
                    $(".editUserModalErrMsg").css("color", "red");
                    $(".editUserModalErrMsg").html("<b>" + response + "</b>");
                }
            }
        });
    });

    $(".closeModal").click(function(){
        $("#editUserModal").hide();
    });
});