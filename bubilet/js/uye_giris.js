function Kontrol(secim) {
    console.log(secim);
    if (secim.value == "kyt") {
        document.getElementsByClassName('login')[0].style.display = "none";
        document.getElementsByClassName('signin')[0].style.display = "block";
        document.getElementById("Kyt").checked = true;
        document.getElementById("Kyt2").checked = true;
    }

    if (secim.value == "grs") {
        console.log(secim.value);
        document.getElementsByClassName('login')[0].style.display = "block";
        document.getElementsByClassName('signin')[0].style.display = "none";
        document.getElementById("Grs").checked = true;
        document.getElementById("Grs2").checked = true;
    }
}

function boslukKontrol(secim) {
    
    if (document.getElementsByName("kayit_email")[0].value == "" || document.getElementsByName("kayit_sifre")[0].value == "") {
        event.preventDefault();
        document.getElementById("hata").innerHTML="Boş alan bırakmayınız..!";
    }
}