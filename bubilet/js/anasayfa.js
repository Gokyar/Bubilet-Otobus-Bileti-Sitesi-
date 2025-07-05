document.addEventListener("DOMContentLoaded", function () {
    const today = new Date();
    const yyyy = today.getFullYear(); 
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');

    const minDate = `${yyyy}-${mm}-${dd}`;


    const dateInput = document.getElementById("tarih");
    dateInput.setAttribute("value", minDate);

    if (dateInput) {
        dateInput.setAttribute("min", minDate);
    }
});
