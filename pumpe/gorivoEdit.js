window.addEventListener("DOMContentLoaded", function()
{
    let izmjenaGorivo_buttons = document.getElementsByClassName("modalButtonIzmjenaGorivo");

    // attach click event listeners [jQ. => $(".modalButtonIzmjenaGorivo").click(...)];
    for (let i = 0; i < document.querySelectorAll('.modalButtonIzmjenaGorivo').length; ++i)
        izmjenaGorivo_buttons[i].addEventListener('click', izmjenaGorivoClicked);

    function izmjenaGorivoClicked()
    {
        // this => document.querySelector(".modalButtonIzmjenaGorivo");
        let currentRow = this.parentNode.parentNode;
        let currentLocation = this.closest("tr").getElementsByClassName("currentRowLocation")[0].innerText;
        let fuelCount = currentRow.cells.length -3; // -3 to skip ID/location/edit fuel button
        let tablePumpeHeader = document.getElementById("tablePumpeHeader");

        if (fuelCount <= 0)
            alert("Ne postoji nijedno gorivo!");
        else
        {
            let fuelData = new FormData();

            for (let i = 2; i < fuelCount + 2; ++i) // first fuel has index 2
                fuelData.append(tablePumpeHeader.children[i].innerHTML, currentRow.children[i].innerHTML);

            let xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function()
            {
                if (xhr.readyState === 4) // XMLHttpRequest.DONE
                {
                    if (xhr.status === 200)
                    {
                        if (xhr.responseText === "OK")
                        {
                            document.getElementById("editFuelInfoMsg").style.color = "green";
                            document.getElementById("editFuelInfoMsg").innerHTML = "<b> Goriva uspješno izmijenjena. </b>";
                        }
                        else
                        {
                            document.getElementById("editFuelInfoMsg").style.color = "red";
                            document.getElementById("editFuelInfoMsg").innerHTML = "<b>" + xhr.responseText + "</b>";
                        }
                    }
                    else alert("Greška, pokušajte ponovo!");
                }
            }

            xhr.open('POST', 'izmjena_gorivo.php');
            fuelData.append("lokacija", currentLocation);
            xhr.send(fuelData);
        }
    }
});