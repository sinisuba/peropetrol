window.addEventListener("DOMContentLoaded", function()
{
    let izmjenaGorivo_buttons = document.getElementsByClassName("modalButtonIzmjenaGorivo");
    let current_location;
    let currentRow;

    // attach click event listeners [jQ. => $(".modalButtonIzmjenaGorivo").click(...)];
    for (let i = 0; i < document.querySelectorAll('.modalButtonIzmjenaGorivo').length; ++i)
        izmjenaGorivo_buttons[i].addEventListener('click', izmjenaGorivoClicked);

    function izmjenaGorivoClicked()
    {
        document.getElementById("editGorivoModal").style.display = "block";

        current_location = this.closest("tr").getElementsByClassName("currentRowLocation")[0].innerText;

        // this => document.querySelector(".modalButtonIzmjenaGorivo");
        currentRow = this.parentNode.parentNode;
    }

    document.getElementById("form_EditGorivo").onsubmit = function(event)
    {
        event.preventDefault();

        let xhr = new XMLHttpRequest();
        let data = new FormData(this);

        xhr.onreadystatechange = function()
        {
            if (xhr.readyState === 4) // XMLHttpRequest.DONE
            {
                if (xhr.status === 200)
                {
                    if (xhr.responseText === "OK")
                    {
                        // currentRow.children[0].innerHTML = data.get('gorivo_naziv');
                        document.getElementById("editGorivoModalInfoMsg").style.color = "green";
                        document.getElementById("editGorivoModalInfoMsg").innerHTML = "<b> Količina goriva uspješno izmijenjena. </b>";
                    }
                    else
                    {
                        document.getElementById("editGorivoModalInfoMsg").style.color = "red";
                        document.getElementById("editGorivoModalInfoMsg").innerHTML = "<b>" + xhr.responseText + "</b>";
                    }
                }
                else alert("Greška, pokušajte ponovo!");
            }
        }

        xhr.open('POST', 'izmjena_gorivo.php');
        data.append("selectedLocation", current_location);
        xhr.send(data);
    }

    document.getElementById("editGorivoModalClose").onclick = function()
    {
        if (document.getElementById("editGorivoModalInfoMsg").innerText.length > 0)
            document.getElementById("editGorivoModalInfoMsg").innerText = "";

        document.getElementById("editGorivoModal").style.display = "none";
    }
});