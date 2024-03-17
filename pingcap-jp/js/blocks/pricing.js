import { removeAllChildNodes } from '../util/dom-util';

function createTdElement(value, format = '') {
	const tdEl = document.createElement('td');

	switch (format) {
		// case 'usd_per_hr':
		// 	tdEl.innerText = `$${value} /hr`;
		// 	break;

		// case 'usd_per_mo':
		// 	tdEl.innerText = `$${value} /month`;
		// 	break;

		default:
			tdEl.innerText = value;
			break;
	}

	return tdEl;
}

class BlockPricing {
	constructor(el) {
		this.el = el;
		this.tableEl = this.el.querySelector('.block-pricing__table');
		this.providerBtnEls = Array.from(
			this.el.querySelectorAll('.block-pricing__provider-button')
		);
		this.regionSelectorEl = this.el.querySelector('.block-pricing__region-selector');

		this.activeProviderId = 0;
		this.activeRegionId = 0;
		this.providersData = JSON.parse(this.tableEl.getAttribute('data-providers-data') ?? '[]');

		this.providerBtnEls.forEach((btnEl) => {
			btnEl.addEventListener('click', (e) => {
				const providerId = parseInt(
					e.currentTarget.getAttribute('data-provider-id') ?? '0',
					10
				);

				this.setActiveProvider(providerId);
			});
		});

		if (this.regionSelectorEl) {
			this.regionSelectorEl.addEventListener('change', (e) => {
				this.activeRegionId = parseInt(e.currentTarget.value ?? '0', 10);

				this.updateTableRows(this.activeProviderId, this.activeRegionId);
			});
		}
	}

	setActiveProvider(providerId) {
		if (this.activeProviderId === providerId) {
			return;
		}

		this.activeProviderId = providerId;

		// update active provider button status
		this.providerBtnEls.forEach((btn) => btn.classList.remove('active'));

		const activeBtnEl = this.el.querySelector(
			`.block-pricing__provider-button[data-provider-id="${providerId}"]`
		);

		if (activeBtnEl) {
			activeBtnEl.classList.add('active');
		}

		// update region options
		this.setRegionOptions(providerId);
	}

	setRegionOptions(providerId) {
		this.activeRegionId = 0;

		if (!this.regionSelectorEl) {
			return;
		}

		// remove all existing <option> elements
		removeAllChildNodes(this.regionSelectorEl);

		// create the new <option> elements
		const regions = this.providersData[providerId]?.regions ?? [];

		regions.forEach((region, regionIndex) => {
			const optionEl = document.createElement('option');
			optionEl.value = regionIndex;
			optionEl.textContent = region.name;

			this.regionSelectorEl.appendChild(optionEl);
		});

		// update the table rows
		this.updateTableRows(this.activeProviderId, this.activeRegionId);
	}

	updateTableRows(providerId, regionId) {
		if (!this.tableEl) {
			return;
		}

		const tbodyEl = this.tableEl.querySelector('tbody');

		if (!tbodyEl) {
			return;
		}

		// remove existing <tr> elements from the <tbody> element
		removeAllChildNodes(tbodyEl);

		// create the new <tr> and <td> elements
		const tiers = this.providersData[providerId]?.regions[regionId]?.tiers ?? [];

		tiers.forEach((tier, tierIndex) => {
			const rows = tier?.rows ?? [];

			rows.forEach((row, rowIndex) => {
				const trEl = document.createElement('tr');

				if (tierIndex % 2 === 1) {
					trEl.classList.add('table--row-gray-bg');
				}

				if (rowIndex === 0 && tierIndex === tiers.length - 1) {
					trEl.classList.add('table--last-group-start');
				}

				if (rowIndex === 0) {
					const tdTierEl = createTdElement(tier.name ?? '');
					tdTierEl.rowSpan = rows.length;

					trEl.appendChild(tdTierEl);
				}
				if (this.tableEl.classList.contains('pricing-new')) {
					// Pricing New
					trEl.appendChild(createTdElement(row?.node ?? ''));
					trEl.appendChild(createTdElement(row?.cpu ?? ''));
					trEl.appendChild(createTdElement(row?.storage ?? ''));
					trEl.appendChild(createTdElement(row?.hcpn ?? '', 'usd_per_hr'));
					trEl.appendChild(createTdElement(row?.scgbh ?? '', 'usd_per_hr'));
				} else {
					trEl.appendChild(createTdElement(row?.node ?? ''));
					trEl.appendChild(createTdElement(row?.storage ?? ''));
					trEl.appendChild(createTdElement(row?.hcpn ?? '', 'usd_per_hr'));
					trEl.appendChild(createTdElement(row?.mcpn ?? '', 'usd_per_mo'));
					trEl.appendChild(createTdElement(row?.pphcpn ?? '', 'usd_per_hr'));
					trEl.appendChild(createTdElement(row?.ppmcpn ?? '', 'usd_per_mo'));
					trEl.appendChild(createTdElement(row?.cpu ?? ''));
				}


				tbodyEl.appendChild(trEl);
			});
		});
	}
}

export default BlockPricing;
