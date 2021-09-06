window.addEventListener("DOMContentLoaded", function()
{
    document.getElementById("form_RadnikNew").onsubmit = function(event)
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
                        document.getElementById("radnikNewInfoMsg").style.color = "green";
                        document.getElementById("radnikNewInfoMsg").innerHTML = "<b> Radnik uspješno registrovan! </b>";
                    }
                    else
                    {
                        document.getElementById("radnikNewInfoMsg").style.color = "red";
                        document.getElementById("radnikNewInfoMsg").innerHTML = "<b>" + xhr.responseText + "</b>";
                    }
                }
                else alert("Greška, pokušajte ponovo!");
            }
        }

        xhr.open('POST', 'novi_radnik.php');
        xhr.send(data);
    }
});