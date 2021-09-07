window.addEventListener("DOMContentLoaded", function()
{
    document.getElementById("form_Registracija").onsubmit = function(event)
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
                        document.getElementById("registracijaInfoMsg").style.color = "green";
                        document.getElementById("registracijaInfoMsg").innerHTML = "<b> Uspješna registracija. </b>" + "<br> > <a href='../login'> Login </a>"
                        document.getElementById("form_Registracija").reset();
                    }
                    else
                    {
                        document.getElementById("registracijaInfoMsg").style.color = "red";
                        document.getElementById("registracijaInfoMsg").innerHTML = "<b>" + xhr.responseText + "</b>";
                    }
                }
                else alert("Greška, pokušajte ponovo!");
            }
        }

        xhr.open('POST', 'registracija.php');
        xhr.send(data);
    }
});