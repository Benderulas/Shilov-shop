import { UrlManager } from "/scripts/products/UrlManager.js";
import { POST_JSON_request } from "/JavaScript/requests.js";

export class FiltersManager
{
	static GetFiltersFromPage()
	{
		let filters = UrlManager.GetFiltersByURL();

		filters['colorID'] = document.getElementById('color').value;
		filters['sizeID'] = document.getElementById('size').value;
		filters['companyID'] = document.getElementById('company').value;
		filters['categoryID'] = document.getElementById('category').value;

		filters['priceMin'] = document.getElementById('priceMin').value;
		filters['priceMax'] = document.getElementById('priceMax').value;
		filters['title'] = document.getElementById('title').value;

		return filters;
	}
	static async GetSelectsFromDb(_filters)
	{
	  let path = "/POST/products/GetSearchFilters.php";

	  let data = {
	    sexID: _filters['sexId']
	  }

	  let response = await POST_JSON_request(path, data); 

	  return response;  
	}

	static async GetSelectsFromDb()
	{
	  let path = "POST/products/GetSearchFilters.php";

	  let response = await POST_JSON_request(path); 

	  return response;  
	}



	static PrepareFiltersForRequest(_filters)
	{
		_filters['colorID'] = Number(_filters['colorID']);
		_filters['sizeID'] = Number(_filters['sizeID']);
		_filters['companyID'] = Number(_filters['companyID']);
		_filters['categoryID'] = Number(_filters['categoryID']);

		_filters['priceMin'] = Number(_filters['priceMin']);
		_filters['priceMax'] = Number(_filters['priceMax']);

		_filters['page'] = Number(_filters['page']);
		_filters['sexID'] = Number(_filters['sexID']);

		return _filters;
	}

	static SetFiltersList(_response, _filters)
	{

	  let filters = {

	    title: document.getElementById("title"),
	    priceMin: document.getElementById("priceMin"),
	    priceMax: document.getElementById("priceMax"),
	    color: document.getElementById("color"),
	    size: document.getElementById("size"),
	    category: document.getElementById("category"),
	    company: document.getElementById("company")
	  };


	  filters['title'].value = _filters.title;
	  filters['priceMin'].value = _filters.priceMin;
	  filters['priceMax'].value = _filters.priceMax;

	  let option = document.createElement("option");
	  option.value = 'null';
	  if (_filters['colorID'] == false) option.selected = "selected";
	  filters['color'].add(option);

	  option = document.createElement("option");
	  option.value = 'null';
	  if (_filters['sizeID'] == false) option.selected = "selected";
	  filters['size'].add(option);

	  option = document.createElement("option");
	  option.value = 'null';
	  if (_filters['categoryID'] == false) option.selected = "selected";
	  filters['category'].add(option);

	  option = document.createElement("option");
	  option.value = 'null';
	  if (_filters['companyID'] == false) option.selected = "selected";
	  filters['company'].add(option);




	  for (let i = 0; _response.colors[i]; i++)
	  {
	      option = document.createElement("option");
	      option.text = _response.colors[i].title;
	      option.value = _response.colors[i].id;
	      if (option.value == _filters['colorID']) option.selected = "selected";

	      filters['color'].add(option);
	  }

	  for (let i = 0; _response.sizes[i]; i++)
	  {
	      option = document.createElement("option");
	      option.text = _response.sizes[i].title;
	      option.value = _response.sizes[i].id;
	      if (option.value == _filters['sizeID']) option.selected = "selected";

	      filters['size'].add(option);
	  }

	  for (let i = 0; _response.categories[i]; i++)
	  {
	      option = document.createElement("option");
	      option.text = _response.categories[i].title;
	      option.value = _response.categories[i].id;
	      if (option.value == _filters['categoryID']) option.selected = "selected";

	      filters['category'].add(option);
	  }

	  for (let i = 0; _response.companies[i]; i++)
	  {
	      option = document.createElement("option");
	      option.text = _response.companies[i].title;
	      option.value = _response.companies[i].id;
	      if (option.value == _filters['companyID']) option.selected = "selected";

	      filters['company'].add(option);
	  }
	}

	static async InitializeFilters()
	{
		let filters = await UrlManager.GetFiltersByURL();
		let response = await this.GetSelectsFromDb(filters);
		this.SetFiltersList(response, filters);
	}
}