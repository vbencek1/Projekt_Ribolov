

function ocitaj()
{
    document.getElementById("email").addEventListener("input", funReg);
    function funReg() {
        var re = /([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}/;
        var ok = re.test(document.getElementById("email").value);
        if (!ok)
        {
            document.getElementById("email").style.background = "#ff002a";
        } else {

            document.getElementById("email").style.background = "#26C485";
        }
    }

    document.getElementById("ime").addEventListener("input", provjeraImena);
    document.getElementById("prez").addEventListener("input", provjeraPrezimena);
    function provjeraImena() {
        var re = /^(([A-za-zÀ-Ÿ]+[\s]{1}[A-za-zÀ-Ÿ]+)|([A-Za-zÀ-Ÿ]+))$/;
        var ok = re.test(document.getElementById("ime").value);
        if (!ok)
        {
            document.getElementById("ime").style.background = "#ff002a";
        } else {

            document.getElementById("ime").style.background = "#26C485";
        }
    }
    function provjeraPrezimena() {
        var re = /^(([A-za-zÀ-Ÿ]+[\s]{1}[A-za-zÀ-Ÿ]+)|([A-Za-zÀ-Ÿ]+))$/;
        var ok = re.test(document.getElementById("prez").value);
        if (!ok)
        {
            document.getElementById("prez").style.background = "#ff002a";
        } else {

            document.getElementById("prez").style.background = "#26C485";
        }
    }

    document.getElementById("korime").addEventListener("input", provjeraKorIme);
    function provjeraKorIme() {
        var re = /^([A-Za-z0-9]){6,18}$/;
        var ok = re.test(document.getElementById("korime").value);
        if (!ok)
        {
            document.getElementById("korime").style.background = "#ff002a";
        } else {

            document.getElementById("korime").style.background = "#26C485";
        }
    }

    document.getElementById("lozinka1").addEventListener("input", provjeraLozinke);
    function provjeraLozinke() {
        var LozinkaDuzina = document.getElementById("lozinka1").value.length;
        if (LozinkaDuzina < 6 || LozinkaDuzina > 30)
        {
            document.getElementById("lozinka1").style.background = "#ff002a";
        } else {

            document.getElementById("lozinka1").style.background = "#26C485";
        }
    }



    var drzave = new Array();
    var brojac = 0;
    $.getJSON("../json/states.json",
            function (data) {
                $.each(data, function () {
                    drzave.push(data[brojac]);
                    brojac++;
                });
            });
    document.getElementById("drzava").addEventListener("input", funDrzava);
    function funDrzava() {
        $(document.getElementById("drzava")).autocomplete({
            source: drzave,
            minLength: 0
        });
        if (document.getElementById("drzava").value === "" || document.getElementById("drzava").value === null) {
            document.getElementById("drzava").style.background = "#ff002a";
        } else {
            document.getElementById("drzava").style.background = "#26C485";
        }
    }
    document.getElementById("korime").addEventListener("input", provjeraDuplikata);


    function provjeraDuplikata()
    {
        var korime = document.getElementById("korime").value;
        $.ajax({
            type: 'post',
            url: '../skripte/provjeraKorime.php',
            data: {
                korisnicko_ime: korime
            },
            success: function (response) {
                document.getElementById("ispisDuplikat").value = response;
            }
        });
    }
}



function Natjecanja() {

    $(document).ready(function () {
        $(document.getElementById("TablicaNatjecanja")).DataTable({
            "pageLength": 7
        });
    });
    $(document).ready(function () {
        $(document.getElementById("TablicaNatjecanjaNOSORT")).DataTable({
            "pageLength": 7,
            "ordering": false
        });
    });

    document.getElementById("ispisGumb").addEventListener("click", Ispis);
    function Ispis() {
        window.print();
    }
}





