class PricingSearch {
	constructor(el) {
		this.el = el;
		this.tabEls = Array.from(this.el.querySelectorAll('.tab'));
		this.selectEl = this.el.querySelector('select');
		this.resultEl = this.el.querySelector('.pricing-search__result');
		this.provider = 'aws';

		const pricing = {
			aws: { 4: 1376, 8: 2591, 16: 5096, 32: 10107 },
			gcp: { 4: 1406, 8: 2623, 16: 5146, 32: 10537 },
			azure: { 8: 2680, 16: 5259 }
		};

		this.tabEls.forEach((tabEl) => {
			tabEl.addEventListener('click', (e) => {
				if (e.currentTarget.classList.contains('active')) {
					return;
				}

				this.tabEls.forEach((el) => el.classList.remove('active'));
				e.currentTarget.classList.add('active');
				this.provider = e.currentTarget.getAttribute('data-provider');
				this.selectEl.innerHTML = Object.keys(pricing[this.provider]).map(
					(v) => `<option value="${v}">${v} vCPU</option>">`
				);
				this.selectEl.selectedIndex = 0;
				this.resultEl.innerHTML = `Starts from $${pricing[this.provider][this.selectEl.options[0].value]} / month`;
			});
		});

		this.selectEl.addEventListener('change', (e) => {
			const value = parseInt(e.currentTarget.value);

			if (value) {
				this.resultEl.innerHTML = `Starts from $${pricing[this.provider][value]} / month`;
			} else {
				this.resultEl.innerHTML = '<span class="pricing-search__tip">Price / month</span>';
			}
		});
	}
}

export default PricingSearch;
