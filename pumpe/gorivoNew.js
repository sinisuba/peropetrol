window.addEventListener("DOMContentLoaded", function()
{
    document.getElementById("modalButtonAdd").onclick = function()
    {
        document.getElementById("addGorivoModal").style.display = "block";
    }

    document.getElementById("form_AddGorivo").onsubmit = function(event)
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
                        alert("Gorivo uspješno dodano!");
                        location.reload();
                    }
                    else
                    {
                        document.getElementById("addGorivoModalErrMsg").style.color = "red";
                        document.getElementById("addGorivoModalErrMsg").innerHTML = "<b>" + xhr.responseText + "</b>";
                    }
                }
                else alert("Greška, pokušajte ponovo!");
            }
        }

        xhr.open('POST', 'novo_gorivo.php');
        xhr.send(data);
    }

    document.getElementById("addGorivoModalClose").onclick = function()
    {
        document.getElementById("addGorivoModal").style.display = "none";
    }
});