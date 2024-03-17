const PAGE_CATEGORY_MAP = {
	'': 'home',
	tidb: 'product',
	'tidb-dedicated': 'product',
	'tidb-serverless': 'product',
	pricing: 'product',
	customers: 'case-study',
	'ebook-whitepaper': 'ebook&white-papers',
	event: 'events&webinars',
	'press-releases-news': 'press-releases',
	'press-release': 'press-releases'
};

const PAGE_CATEGORY2_MAP = {
	tidb: 'tidb',
	'tidb-dedicated': 'tidb-dedicated',
	'tidb-serverless': 'tidb-serverless',
	pricing: 'pricing'
};

window.dataLayer = window.dataLayer || [];

function gtag(eventLevelVariables) {
	const path = window.location.pathname.split('/')[1];
	window.dataLayer.push({
		site: 'en',
		page_category: `${PAGE_CATEGORY_MAP[path] || path}-en`,
		page_category2: PAGE_CATEGORY2_MAP[path] || '',
		...eventLevelVariables
	});
}

window.gtag = gtag;

function initializeTracking() {
	gtag({ event: 'page_view' });

	document.addEventListener('click', function (event) {
		const {target} = event;
		const data = target.getAttribute('data-gtag');

		if (target && data) {
			const eventLevelVariables = data.split(',').reduce(function (acc, part) {
				var keyValue = part.split(':');
				if (keyValue.length === 2) {
					var key = keyValue[0].trim();
					var value = keyValue[1].trim();
					acc[key] = value;
				}
				return acc;
			}, {});

			if (eventLevelVariables.event) {
				gtag(eventLevelVariables);
			}
		}
	});
}

document.addEventListener('DOMContentLoaded', initializeTracking);
