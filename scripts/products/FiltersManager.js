import { UrlManager } from "/scripts/products/UrlManager.js";
import { POST_JSON_request } from "/JavaScript/requests.js";

export class FiltersManager
{
	static GetFiltersFromPage()
	{
		let filters = UrlManager.GetFiltersByURL();

		filters['colorID'] = Number(document.getElementById('color').value);
		filters['sizeID'] = Number(document.getElementById('size').value);
		filters['companyID'] = Number(document.getElementById('company').value);

		filters['priceMin'] = Number(document.getElementById('priceMin').value);
		filters['priceMax'] = Number(document.getElementById('priceMax').value);
		filters['title'] = document.getElementById('title').value;

		return filters;
	}

	static async GetSelectsFromDb(_filters)
	{
		let path = "POST/products/GetSearchFilters.php";

		let filters = {
		sexID: _filters['sexID'],
		categoryID: _filters['categoryID']
		}

		return POST_JSON_request(path, filters);
	}

	static SetSelectModule(_options, _selectedOption, _selectModuleId)
	{
		let selectModule = document.getElementById(_selectModuleId);

		let option;

		for (let i = 0; i < _options.length; i++)
		{
			option = document.createElement("option");
			option.text = _options[i].title;
			option.value = _options[i].id;
			if (option.value == _selectedOption) option.selected = "selected";

			selectModule.add(option);
		}

	}

	static SetFiltersList(_response, _filters)
	{
		this.SetSelectModule(_response['colors'], _filters['colorID'], "color");
		this.SetSelectModule(_response['companies'], _filters['companyID'], "company");
		this.SetSelectModule(_response['sizes'], _filters['sizeID'], "size");

		document.getElementById('title').value = _filters['title'];
	}

	static async InitializeFilters(_filters)
	{
		let response = await this.GetSelectsFromDb(_filters);
		this.SetFiltersList(response, _filters);
	}
}