window.onload = onLoad;
function onLoad() {
    jQuery(document).ready(function () {
        $('dt').click(function () {
            $(this).next('dd').slideToggle();
        })
    });
    document.getElementById("toDisplay").style.display = "none";
}