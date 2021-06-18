function openTab(evt, tabName) {
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    document.getElementById(tabName).style.display = "block";
}



function hideMaleCategories()
{
    let sexMenu = document.getElementById("sexMenu");
    let categories = document.getElementById("maleCategories");
    let button = document.getElementById("maleCategoryButton");

    if (event.relatedTarget != sexMenu && event.relatedTarget != categories)
    {
        categories.style.display = "none";
        button.className = "sexButton";
    }
}

function hideFemaleCategories()
{
    let sexMenu = document.getElementById("sexMenu");
    let categories = document.getElementById("femaleCategories");
    let button = document.getElementById("femaleCategoryButton");

    if (event.relatedTarget != sexMenu && event.relatedTarget != categories)
    {
        categories.style.display = "none";
        button.className = "sexButton";
    }
}

function displayMaleCategories()
{
    document.getElementById("femaleCategories").style.display = "none";
    document.getElementById("femaleCategoryButton").className = "sexButton";

    document.getElementById("maleCategories").style.display = "block";
    document.getElementById("maleCategoryButton").className = "sexButtonActive";
}

function displayFemaleCategories()
{
    document.getElementById("maleCategories").style.display = "none";
    document.getElementById("maleCategoryButton").className = "sexButton";

    document.getElementById("femaleCategories").style.display = "block";
    document.getElementById("femaleCategoryButton").className = "sexButtonActive";
}