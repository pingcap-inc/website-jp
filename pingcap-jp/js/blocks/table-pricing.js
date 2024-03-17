import { removeAllChildNodes } from '../util/dom-util';
class BlockTablePricing {
	constructor(el) {
		this.el = el;
		this.tableEls = Array.from(
			this.el.querySelectorAll('.block-table-pricing__selector-content-table')
		);
		this.providerSelectorEl = this.el.querySelector(
			'.block-table-pricing__provider-selector select'
		);
		this.regionSelectorEl = this.el.querySelector(
			'.block-table-pricing__region-selector select'
		);
		this.providersData = JSON.parse(
			this.providerSelectorEl.getAttribute('data-providers-data') ?? '[]'
		);
		this.activeProviderId = Object.keys(this.providersData)[0];
		this.activeRegionId = this.providersData[this.activeProviderId][0];

		this.providerSelectorEl.addEventListener('change', (e) => {
			this.setActiveProvider(e.currentTarget.value);
		});

		if (this.regionSelectorEl) {
			this.regionSelectorEl.addEventListener('change', (e) => {
				this.activeRegionId = e.currentTarget.value;

				this.updateTableRows(this.activeProviderId, this.activeRegionId);
			});
		}
	}

	setActiveProvider(providerId) {
		if (this.activeProviderId === providerId) {
			return;
		}

		this.activeProviderId = providerId;

		// update region options
		this.setRegionOptions(providerId);
	}

	setRegionOptions(providerId) {
		this.activeRegionId = this.providersData[providerId][0];

		if (!this.regionSelectorEl) {
			return;
		}

		// remove all existing <option> elements
		removeAllChildNodes(this.regionSelectorEl);

		// create the new <option> elements
		const regions = this.providersData[providerId] || [];

		regions.forEach((region) => {
			const optionEl = document.createElement('option');
			optionEl.value = region.replace(' ', '-');
			optionEl.textContent = region;

			this.regionSelectorEl.appendChild(optionEl);
		});

		// update the table rows
		this.updateTableRows(this.activeProviderId, this.activeRegionId);
	}

	updateTableRows(providerId, regionId) {
		this.tableEls.forEach((el) => {
			const sectionId =
			'selector-table-content-' + providerId + '-' + regionId.replace(/\s/g, '-');
			if (el.getAttribute('data-table-id') === sectionId) {
				el.classList.add('active');
			} else {
				el.classList.remove('active');
			}
		});
	}
}

export default BlockTablePricing;
