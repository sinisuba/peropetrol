window.addEventListener("DOMContentLoaded", function()
{
    let izmjena_buttons = document.getElementsByClassName("modalButtonIzmjena");

    // attach click event listeners [jQ. => $(".modalButtonIzmjena").click(...)];
    for (let i = 0; i < document.querySelectorAll('.modalButtonIzmjena').length; ++i)
        izmjena_buttons[i].addEventListener('click', izmjenaClicked);

    let email;

    function izmjenaClicked()
    {
        document.getElementById("editUserModal").style.display = "block";

        email = this.closest("tr").getElementsByClassName("currentRowEmail")[0].innerText;

        // this => document.querySelector(".modalButtonIzmjena");
        let currentRow = this.parentNode.parentNode;

        document.querySelector("input[name='firstname']").value = currentRow.children[1].innerText;
        document.querySelector("input[name='lastname']").value = currentRow.children[2].innerText;
        document.querySelector("input[name='email']").value = email;
        document.querySelector("input[name='staz']").value = currentRow.children[4].innerText;
        document.querySelector("input[name='plata']").value = currentRow.children[5].innerText;
        document.querySelector("input[name='godisnji']").value = currentRow.children[6].innerText;
        document.querySelector("input[name='pumpa']").value = currentRow.children[7].innerText;

        document.getElementById("selectedRadnik").innerHTML = "Radnik <b>" + email + "</b>";
    }

    document.getElementById("form_RadnikEdit").onsubmit = function(event){
        event.preventDefault();

        let xhr = new XMLHttpRequest();
        let data = new FormData(this); // FormData(document.getElementById("form_RadnikEdit"));

        xhr.onreadystatechange = function()
        {
            if (xhr.readyState === 4) // XMLHttpRequest.DONE
            {
                if (xhr.status === 200 && xhr.responseText === "OK")
                {
                    alert("Radnik uspješno izmijenjen.");
                }
                else if (xhr.status === 200 && xhr.responseText !== "OK")
                {
                    document.getElementById("editUserModalErrMsg").style.color = "red";
                    document.getElementById("editUserModalErrMsg").innerHTML = "<b>" + xhr.responseText + "</b>";
                }
                else
                {
                    console.log("Error updating employee");
                }
            }
        }
        xhr.open('POST', 'izmjena_radnik.php', true);
        data.append("selectedUserEmail", email);
        xhr.send(data);
    }

    document.getElementsByClassName("editUserModalClose")[0].onclick = function()
    {
        document.getElementById("editUserModal").style.display = "none";
    };
});