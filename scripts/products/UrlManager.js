export class UrlManager
{
  static GetFiltersByURL()
  {
    let url = new URL (window.location.href);

    let filters = {
      colorID: url.searchParams.get("colorID"),
      sizeID: url.searchParams.get("sizeID"),
      companyID: url.searchParams.get("companyID"),
      categoryID: url.searchParams.get("categoryID"),

      priceMin: url.searchParams.get("priceMin"),
      priceMax: url.searchParams.get("priceMax"),
      title: url.searchParams.get("title"),
      sexID: url.searchParams.get("sexID"),

      page: url.searchParams.get("page")
    };

    return filters;
  }

  static UpdateURLByFitlers(_filters)
  {
    let url = new URL (window.location.href);

    if (_filters['colorID'] != "null") url.searchParams.set("colorID", _filters['colorID']);
    else url.searchParams.delete("colorID");

    if (_filters['sizeID'] != "null") url.searchParams.set("sizeID", _filters['sizeID']);
    else url.searchParams.delete("sizeID");

    if (_filters['companyID'] != "null") url.searchParams.set("companyID", _filters['companyID']);
    else url.searchParams.delete("companyID");

    if (_filters['categoryID'] != "null") url.searchParams.set("categoryID", _filters['categoryID']);
    else url.searchParams.delete("categoryID");

    if (_filters['priceMin']) url.searchParams.set("priceMin", _filters['priceMin']);
    else url.searchParams.delete("priceMin");

    if (_filters['priceMax']) url.searchParams.set("priceMax", _filters['priceMax']);
    else url.searchParams.delete("priceMax");

    if (_filters['title']) url.searchParams.set("title", _filters['title']);
    else url.searchParams.delete("title");

    window.history.pushState("", "", url);
  }

  static UpdateURLByPage(_page)
  {
    let url = new URL (window.location.href);
    url.searchParams.set("page", _page);
    window.history.pushState("", "", url);
  }

  static GetPageFromUrl()
  {
    let url = new URL (window.location.href);
    let page = url.searchParams.get("page");


    if (!page) 
    {
      page = 1;
      url.searchParams.set("page", page);
      window.history.pushState("", "", url);
    }

    return Number(page);
  }

}