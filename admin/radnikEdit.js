window.addEventListener("DOMContentLoaded", function()
{
    let izmjena_buttons = document.getElementsByClassName("modalButtonIzmjena");
    let email;
    let currentRow;

    // attach click event listeners [jQ. => $(".modalButtonIzmjena").click(...)];
    for (let i = 0; i < document.querySelectorAll('.modalButtonIzmjena').length; ++i)
        izmjena_buttons[i].addEventListener('click', izmjenaClicked);

    function izmjenaClicked()
    {
        document.getElementById("editUserModal").style.display = "block";

        // this => document.querySelector(".modalButtonIzmjena");
        email = this.closest("tr").getElementsByClassName("currentRowEmail")[0].innerText;

        currentRow = this.parentNode.parentNode;

        document.querySelector("input[name='firstname']").value = currentRow.children[0].innerText;
        document.querySelector("input[name='lastname']").value = currentRow.children[1].innerText;
        document.querySelector("input[name='email']").value = email;
        document.querySelector("input[name='staz']").value = currentRow.children[3].innerText;
        document.querySelector("input[name='plata']").value = currentRow.children[4].innerText;
        document.querySelector("input[name='godisnji']").value = currentRow.children[5].innerText;
        document.querySelector("input[name='pumpa']").value = currentRow.children[6].innerText;

        document.getElementById("selectedRadnik").innerHTML = "Radnik <b>" + email + "</b>";
    }

    document.getElementById("form_RadnikEdit").onsubmit = function(event)
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
                        currentRow.children[0].innerHTML = data.get('firstname');
                        currentRow.children[1].innerHTML = data.get('lastname');
                        currentRow.children[2].innerHTML = data.get('email');
                        currentRow.children[3].innerHTML = data.get('staz');
                        currentRow.children[4].innerHTML = data.get('plata');
                        currentRow.children[5].innerHTML = data.get('godisnji');
                        currentRow.children[6].innerHTML = data.get('pumpa');

                        document.getElementById("editUserModalInfoMsg").style.color = "green";
                        document.getElementById("editUserModalInfoMsg").innerHTML = "<b> Radnik uspješno izmijenjen. </b>";
                    }
                    else
                    {
                        document.getElementById("editUserModalInfoMsg").style.color = "red";
                        document.getElementById("editUserModalInfoMsg").innerHTML = "<b>" + xhr.responseText + "</b>";
                    }
                }
                else alert("Greška, pokušajte ponovo!");
            }
        }

        xhr.open('POST', 'izmjena_radnik.php');
        data.append("selectedUserEmail", email);
        xhr.send(data);
    }

    document.getElementById("editUserModalClose").onclick = function()
    {
        if (document.getElementById("editUserModalInfoMsg").innerText.length > 0)
            document.getElementById("editUserModalInfoMsg").innerText = "";

        document.getElementById("editUserModal").style.display = "none";
    };
});