//$.getScript("/JavaScript/requests.js");
import { UrlManager } from "/scripts/products/UrlManager.js";
import { FiltersManager } from "/scripts/products/FiltersManager.js";
import { PageSelector } from "/scripts/products/PageSelector.js";
import { ProductsManager } from "/scripts/products/ProductsManager.js";

let productsOnPage = 8;


async function Search()
{
  UrlManager.UpdateURLByPage(1);
  let filters = FiltersManager.GetFiltersFromPage();
  UrlManager.UpdateURLByFitlers(filters);



  filters = FiltersManager.PrepareFiltersForRequest(filters);
  let productsAmount = await ProductsManager.UpdateProducts(filters);

  let pagesAmount = Math.floor(productsAmount / productsOnPage);
  if (productsAmount % productsOnPage) pagesAmount++;



  PageSelector.UpdateButtons(1, pagesAmount);
}





async function OpenPage()
{
  UrlManager.UpdateURLByPage(this.value);
  let filters = FiltersManager.GetFiltersFromPage();




  filters = FiltersManager.PrepareFiltersForRequest(filters);
  let productsAmount = await ProductsManager.UpdateProducts(filters);

  let pagesAmount = Math.floor(productsAmount / productsOnPage);
  if (productsAmount % productsOnPage) pagesAmount++;




  PageSelector.UpdateButtons(this.value, pagesAmount);
}





async function InitializeAll()
{

  await FiltersManager.InitializeFilters();
  UrlManager.GetPageFromUrl();



  let filters = FiltersManager.GetFiltersFromPage();


  filters = FiltersManager.PrepareFiltersForRequest(filters);
  let productsAmount = await ProductsManager.UpdateProducts(filters);

  let pagesAmount = Math.floor(productsAmount / productsOnPage);
  if (productsAmount % productsOnPage) pagesAmount++;



  PageSelector.InitializeButtons(pagesAmount);




  let searchButton = document.getElementById("search");
  searchButton.onclick = Search;

  let pagesButtons = document.getElementsByName("pageButton")
  for (let i = 0; i < 7; i++)
  {
    pagesButtons[i].onclick = OpenPage;
  }
}


InitializeAll();

