//$.getScript("/JavaScript/requests.js");
import { UrlManager } from "/scripts/products/UrlManager.js";
import { FiltersManager } from "/scripts/products/FiltersManager.js";
import { ProductsManager } from "/scripts/products/ProductsManager.js";
import { PageSelector } from "/JavaScript/PageSelector.js";

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

function OpenProduct()
{
  let url = new URL ("http://shilov-shop/product");

  url.searchParams.set("id", this.firstElementChild.innerText);

  window.location.href = url;
}





async function InitializeAll()
{

  await FiltersManager.InitializeFilters();
  UrlManager.GetPageFromUrl();

  let product = document.getElementsByName("product");

  for (let i = 0; i < 8; i++)
  {
    product[i].onclick = OpenProduct;
  }



  let filters = FiltersManager.GetFiltersFromPage();


  filters = FiltersManager.PrepareFiltersForRequest(filters);
  let productsAmount = await ProductsManager.UpdateProducts(filters);

  let pagesAmount = Math.floor(productsAmount / productsOnPage);
  if (productsAmount % productsOnPage) pagesAmount++;


  let page  = UrlManager.GetPageFromUrl();
  PageSelector.UpdateButtons(page, pagesAmount);




  let searchButton = document.getElementById("search");
  searchButton.onclick = Search;

  let pagesButtons = document.getElementsByName("pageButton")
  for (let i = 0; i < 7; i++)
  {
    pagesButtons[i].onclick = OpenPage;
  }
}


InitializeAll();

