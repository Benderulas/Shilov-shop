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
        categories.style.opacity = "0";
        button.className = "sexButton";       
        categories.style.visibility = "hidden";           
    }
}

function hideFemaleCategories()
{
    let sexMenu = document.getElementById("sexMenu");
    let categories = document.getElementById("femaleCategories");
    let button = document.getElementById("femaleCategoryButton");

    if (event.relatedTarget != sexMenu && event.relatedTarget != categories)
    {
        categories.style.opacity = "0";
        button.className = "sexButton";       
        categories.style.visibility = "hidden";           
    }
}

function hideCategories()
{
    hideMaleCategories();
    hideFemaleCategories();
}

function displayMaleCategories()
{
    document.getElementById("femaleCategories").style.opacity = "0";
    document.getElementById("femaleCategoryButton").className = "sexButton";
    document.getElementById("femaleCategories").style.visibility = "hidden";
    

    
    document.getElementById("maleCategories").style.visibility = "visible";
    document.getElementById("maleCategories").style.opacity = "1";
    document.getElementById("maleCategoryButton").className = "sexButtonActive";
}

function displayFemaleCategories()
{
    document.getElementById("maleCategories").style.opacity = "0";
    document.getElementById("maleCategoryButton").className = "sexButton";
    document.getElementById("maleCategories").style.visibility = "hidden";

    document.getElementById("femaleCategories").style.visibility = "visible";
    document.getElementById("femaleCategories").style.opacity = "1";
    document.getElementById("femaleCategoryButton").className = "sexButtonActive";
}