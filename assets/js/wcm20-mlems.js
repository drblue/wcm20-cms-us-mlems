(function(){
	const ajax_url = wcmm_settings.ajax_url;

	// find all (if any) mlem-widgets
	const widgets = document.querySelectorAll('.random-mlem');

	widgets.forEach(widget => {
		console.log("Requesting all your mlems!", widget);

		// fetch dat mlem!
		fetch(ajax_url + '?action=wcmm_get_random_mlem')
			.then(res => res.json())
			.then(res => {
				// do other stuff with response
				console.log("Got mlem!", widget, res);

				// was request successful?
				if (res.success) {
					// show dat mlem!
					widget.innerHTML = `
						<img src="${res.data.url}">
					`;
				} else {
					// render error message
					widget.innerHTML = `
						<p><em>${res.data}</em></p>
					`;
				}
			})
	});
})();
