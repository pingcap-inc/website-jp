import { wpAPIget } from '../util/wp-rest-api';

class BlockOpenPositions {
	constructor(el) {
		this.filter = {};
		this.el = el;
		this.filterEl = this.el.querySelector('.block-open-positions__filter');
		this.groupsEl = this.el.querySelector('.block-open-positions__groups');
		this.templateGroup = this.el.querySelector('.block-open-positions__template-group');
		this.templateCard = this.el.querySelector('.block-open-positions__template-card');
		this.groupContentEl = this.groupsEl.querySelector('.block-open-positions__groups-wrapper');
		this.noResultsContainer = this.groupsEl.querySelector('[data-no-results-container]');

		if (!this.templateGroup || !this.templateCard) {
			return;
		}

		this.selectEls = Array.from(
			this.el.querySelectorAll('.block-open-positions__filter-control')
		);

		this.selectEls.forEach((el) => {
			el.addEventListener('change', (e) => {
				this.handleFilter(el.getAttribute('data-role'), e.currentTarget.value);
			});
		});

		this.init();
	}

	async init() {
		const res = await this.fetchData();
		this.renderFilter(res);
		this.renderGroup(res);
	}

	async fetchData() {
		this.groupsEl.classList.add('loading');
		const res = await wpAPIget('pingcap/v1/careers', this.filter);
		return Array.isArray(res.body) ? res.body : [];
	}

	async handleFilter(name, value) {
		this.groupContentEl.innerHTML = '';
		this.noResultsContainer.classList.add('hide');

		this.filter[name] = value;
		const res = await this.fetchData();

		this.renderGroup(res);
	}

	renderFilter(data) {
		const filters = ['location', 'department'];
		filters.forEach((filter) => {
			const optionEl = this.createOptionEl(data, filter);
			const targetEl = this.filterEl.querySelector(`[name="filter_${filter}"]`);
			if (optionEl) {
				targetEl.innerHTML = optionEl;
			}
		});
	}

	renderGroup(data) {
		data.forEach((group) => {
			const groupEl = this.createGroupEl(group);

			if (groupEl) {
				this.groupContentEl.appendChild(groupEl);
			}
		});

		this.groupsEl.classList.remove('loading');
		data.length === 0 && this.noResultsContainer.classList.remove('hide');
	}

	getOption(data, target) {
		if (!Array.isArray(data)) {
			return [];
		}

		if (target === 'department') {
			return [...new Set(data.map((v) => v.department).sort())];
		}

		return [
			...new Set(
				data
					.map((v) => v.records)
					.flat()
					.map((v) => v[target])
					.sort()
			)
		];
	}

	createOptionEl(groups, filter) {
		const options = this.getOption(groups, filter);
		const FILTER_LABEL = { location: 'Location', department: 'Department' };
		let el = `<option value="">Filter by ${FILTER_LABEL[filter]}</option>`;
		options.forEach((record) => {
			el += `<option value="${record}">${record || 'Uncategorized'}</option>`;
		});
		return el;
	}

	createGroupEl(group) {
		const groupName = group.group ?? '';
		const records = Array.isArray(group.records) ? group.records : [];

		if (!groupName || !records) {
			return null;
		}

		const groupEl = this.templateGroup.content.cloneNode(true);
		const groupTitleEl = groupEl.querySelector('.block-open-positions__group-title');
		const groupCardsEl = groupEl.querySelector('.block-open-positions__group-cards');

		if (groupTitleEl) {
			groupTitleEl.textContent = groupName;
		}

		if (groupCardsEl) {
			records.forEach((record) => {
				const cardEl = this.createCardEl(record);

				if (cardEl) {
					groupCardsEl.appendChild(cardEl);
				}
			});
		}

		return groupEl;
	}

	createCardEl(record) {
		const cardEl = this.templateCard.content.cloneNode(true);
		const cardLinkEl = cardEl.querySelector('a.block-open-positions__card');
		const cardTitleEl = cardEl.querySelector('.block-open-positions__card-title');
		const cardDescEl = cardEl.querySelector('.block-open-positions__card-desc');

		const url = record.url ?? '';
		const title = record.title ?? '';
		const descParts = [];

		if (!cardLinkEl || !url) {
			return null;
		}

		if (!title) {
			return null;
		}

		if (record.location) {
			descParts.push(record.location);
		}

		if (record.commitment) {
			descParts.push(record.commitment);
		}

		cardLinkEl.setAttribute('href', url);

		if (cardTitleEl) {
			cardTitleEl.textContent = title;
		}

		if (cardDescEl) {
			cardDescEl.textContent = descParts.join('/');
		}

		return cardEl;
	}
}

export default BlockOpenPositions;
