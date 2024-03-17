class PricingSearch {
	constructor(el) {
		this.el = el;
		this.tabEls = Array.from(this.el.querySelectorAll('.tab'));
		this.selectEl = this.el.querySelector('select');
		this.resultEl = this.el.querySelector('.pricing-search__result');
		this.provider = 'aws';

		const pricing = {
			aws: { 2: 692, 4: 1339, 8: 2656, 16: 5250 },
			gcp: { 2: 754, 4: 1405, 8: 2862, 16: 5297 }
		};

		this.tabEls.forEach((tabEl) => {
			tabEl.addEventListener('click', (e) => {
				if (e.currentTarget.classList.contains('active')) {
					return;
				}

				this.tabEls.forEach((el) => el.classList.remove('active'));
				e.currentTarget.classList.add('active');
				this.provider = e.currentTarget.getAttribute('data-provider');
				this.selectEl.selectedIndex = 0;
				this.resultEl.innerHTML = '<span class="pricing-search__tip">Price / month</span>';
			});
		});

		this.selectEl.addEventListener('change', (e) => {
			const value = parseInt(e.currentTarget.value);
            console.log(this.provider,value);
			if (value) {
				this.resultEl.innerHTML = `Starts from $${pricing[this.provider][value]} / month`;
			} else {
				this.resultEl.innerHTML = '<span class="pricing-search__tip">Price / month</span>';
			}
		});
	}
}

export default PricingSearch;
