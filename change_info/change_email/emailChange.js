window.addEventListener("DOMContentLoaded", function()
{
    document.getElementById("form_EmailChange").onsubmit = function(event)
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
                        document.getElementById("emailChangeInfoMsg").style.color = "green";
                        document.getElementById("emailChangeInfoMsg").innerHTML = "<b> Mejl uspješno promijenjen. </b>" + "<br> > <a href='../../login'> Login </a>";
                        document.getElementById("form_EmailChange").reset(); // reset form upon successful email change
                    }
                    else
                    {
                        document.getElementById("emailChangeInfoMsg").style.color = "red";
                        document.getElementById("emailChangeInfoMsg").innerHTML = "<b>" + xhr.responseText + "</b>";
                    }
                }
                else alert("Greška, pokušajte ponovo!");
            }
        }

        xhr.open('POST', 'change_email.php');
        xhr.send(data);
    }
});