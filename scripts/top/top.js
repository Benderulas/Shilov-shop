function openTab(evt, tabName) {
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    document.getElementById(tabName).style.display = "block";
}

function SexButtons(_sexID)
{
    console.log(_sexID);
    if (_sexID == 1) window.location.href = "http://shilov-shop/products?sexID=1";
    if (_sexID == 2) window.location.href = "http://shilov-shop/products?sexID=2";
}