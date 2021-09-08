window.addEventListener("DOMContentLoaded", function()
{
    let brisi_buttons = document.getElementsByClassName("modalButtonBrisi");
    let email;

    // attach click event listeners [jQ. => $(".modalButtonBrisi").click(...)];
    for (let i = 0; i < document.querySelectorAll('.modalButtonBrisi').length; ++i)
        brisi_buttons[i].addEventListener('click', brisiClicked);

    function brisiClicked()
    {
        document.getElementById("confirmationModal").style.display = "block";

        // this => document.querySelector(".modalButtonBrisi");
        email = this.closest("tr").getElementsByClassName("currentRowEmail")[0].innerText;

        document.getElementById("confirmationText").innerHTML = "Jeste li sigurni da želite obrisati radnika <b>" + email + "</b>?";
    }

    document.getElementById("buttonDeleteYes").onclick = function(event){
        event.preventDefault();

        let xhr = new XMLHttpRequest();
        let data = new FormData();

        xhr.onreadystatechange = function()
        {
            if (xhr.readyState === 4) // XMLHttpRequest.DONE
            {
                if (xhr.status === 200)
                {
                    if (xhr.responseText === "OK")
                    {
                        alert("Radnik uspješno obrisan.");
                        location.reload();
                    }
                    else
                    {
                        document.getElementById("confirmationModalErrMsg").style.color = "red";
                        document.getElementById("confirmationModalErrMsg").innerHTML = "<b>" + xhr.responseText + "</b>";
                    }
                }
                else alert("Greška, pokušajte ponovo!");
            }
        }

        xhr.open('POST', 'brisi_radnika.php');
        data.append("radnik_email", email)
        xhr.send(data);
    }

    document.getElementById("deleteUserModalClose").addEventListener("click", function()
    {
        document.getElementById("confirmationModal").style.display = "none";
    });

    document.getElementById("buttonDeleteNo").addEventListener("click", function()
    {
        document.getElementById("confirmationModal").style.display = "none";
    });
});