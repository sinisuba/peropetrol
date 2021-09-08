window.addEventListener("DOMContentLoaded", function()
{
    document.getElementById("form_PasswordChange").addEventListener("submit", function(event)
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
                        document.getElementById("pwChangeInfoMsg").style.color = "green";
                        document.getElementById("pwChangeInfoMsg").innerHTML = "<b> Lozinka uspješno promijenjena. </b>" + "<br> > <a href='../../login'> Login </a>";
                        document.getElementById("form_PasswordChange").reset(); // reset form upon successful password change
                    }
                    else
                    {
                        document.getElementById("pwChangeInfoMsg").style.color = "red";
                        document.getElementById("pwChangeInfoMsg").innerHTML = "<b>" + xhr.responseText + "</b>";
                    }
                }
                else alert("Greška, pokušajte ponovo!");
            }
        }

        xhr.open('POST', 'change_pw.php');
        xhr.send(data);
    });
});