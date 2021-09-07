window.addEventListener("DOMContentLoaded", function()
{
    document.getElementById("modalButtonDelete").onclick = function()
    {
        document.getElementById("deleteGorivoModal").style.display = "block";
    }

    document.getElementById("form_DeleteGorivo").onsubmit = function(event)
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
                        alert("Gorivo uspješno obrisano!");
                        location.reload();
                    }
                    else
                    {
                        document.getElementById("deleteGorivoModalErrMsg").style.color = "red";
                        document.getElementById("deleteGorivoModalErrMsg").innerHTML = "<b>" + xhr.responseText + "</b>";
                    }
                }
                else alert("Greška, pokušajte ponovo!");
            }
        }

        xhr.open('POST', 'brisi_gorivo.php');
        xhr.send(data);
    }

    document.getElementById("deleteGorivoModalClose").onclick = function()
    {
        document.getElementById("deleteGorivoModal").style.display = "none";
    }
});