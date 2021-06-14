import { UrlManager } from "/scripts/products/UrlManager.js";


export class PageSelector
{

	static InitializeButtons(_pagesAmount)
	{
		let page  = UrlManager.GetPageFromUrl();
		this.UpdateButtons(page, _pagesAmount)
	}
	static UpdateButtons(_page, _pagesAmount)
	{
		_page = Number(_page);
		let buttons = document.getElementsByName("pageButton");

		buttons[3].hidden = '';
		buttons[3].value = _page;
		buttons[3].innerText = _page;


		if (_page > 1 && _page <= _pagesAmount)
		{
			buttons[0].hidden = '';
			buttons[0].value = _page - 1;

			buttons[2].hidden = '';
			buttons[2].value = _page - 1;
			buttons[2].innerText = _page - 1;
		}
		else 
		{
			buttons[0].hidden = 'hidden';
			buttons[2].hidden = 'hidden';
		}

		if (_page > 0 && _page + 1 <= _pagesAmount)
		{
			buttons[6].hidden = '';
			buttons[6].value = _page + 1;

			buttons[4].hidden = '';
			buttons[4].value = _page + 1;
			buttons[4].innerText = _page + 1;
		}
		else
		{
			buttons[6].hidden = 'hidden';
			buttons[4].hidden = 'hidden';
		}




		if (_page - 2 > 0 && _page <= _pagesAmount)
		{
			buttons[1].hidden = '';
			buttons[1].value = _page - 2;
			buttons[1].innerText = _page - 2;
		}
		else 
		{
			buttons[1].hidden = 'hidden';
		}

		if (_page > 0 && _page + 2 <=_pagesAmount)
		{
			buttons[5].hidden = '';
			buttons[5].value = _page + 2;
			buttons[5].innerText = _page + 2;
		}
		else 
		{
			buttons[5].hidden = 'hidden';
		}


		//console.log(buttons);

		

	}
}