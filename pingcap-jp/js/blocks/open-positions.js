import { wpAPIget } from '../util/wp-rest-api';

class BlockOpenPositions {
	constructor(el) {
		this.el = el;
		this.filter = {};
		this.jobs = [];

		this.filterEl = el.querySelector('.block-open-positions__filter');
		this.groupsEl = el.querySelector('.block-open-positions__groups');
		this.templateGroup = el.querySelector('.block-open-positions__template-group');
		this.templateCard = el.querySelector('.block-open-positions__template-card');
		this.groupContentEl = this.groupsEl.querySelector('.block-open-positions__groups-wrapper');
		this.noResultsContainer = this.groupsEl.querySelector('[data-no-results-container]');

		if (!this.templateGroup || !this.templateCard) return;

		this.selectEls = [...el.querySelectorAll('.block-open-positions__filter-control')];
		this.selectEls.forEach((select) => {
			select.addEventListener('change', (e) => {
				this.filter[select.getAttribute('data-role')] = e.currentTarget.value;
				this.renderGroup();
			});
		});

		this.init();
	}

	async init() {
		this.groupsEl.classList.add('loading');
		this.jobs = await this.fetchData();
		this.renderFilter(this.jobs);
		this.renderGroup();
		this.groupsEl.classList.remove('loading');
	}

	async fetchData() {
		const res = await wpAPIget(
			'https://boards-api.greenhouse.io/v1/boards/pingcap/jobs',
			{ content: true },
			{ credentials: 'omit' },
			true
		);
		return Array.isArray(res.body.jobs) ? res.body.jobs : [];
	}

	renderFilter(jobs) {
		const offices = new Set();
		const departments = new Set();

		jobs.forEach((job) => {
			if (job.location?.name) offices.add(job.location.name);
			job.departments?.forEach((dep) => departments.add(dep.name));
		});

		const locSelect = this.filterEl.querySelector('[name="filter_location"]');
		const deptSelect = this.filterEl.querySelector('[name="filter_department"]');

		this.populateSelect(locSelect, offices);
		this.populateSelect(deptSelect, departments);
	}

	populateSelect(selectEl, values) {
		values.forEach((val) => {
			const option = document.createElement('option');
			option.value = val;
			option.textContent = val;
			selectEl.appendChild(option);
		});
	}

	renderGroup() {
		this.groupContentEl.innerHTML = '';
		this.noResultsContainer.classList.add('hide');

		const filteredJobs = this.filterJobs(this.jobs);
		const grouped = this.groupJobsByFirstDepartment(filteredJobs);

		Object.entries(grouped).forEach(([dept, jobs]) => {
			const groupEl = this.createGroupEl(dept, jobs);
			if (groupEl) this.groupContentEl.appendChild(groupEl);
		});

		if (filteredJobs.length === 0) {
			this.noResultsContainer.classList.remove('hide');
		}
	}

	filterJobs(jobs) {
		return jobs.filter((job) => {
			const matchLoc = !this.filter.location || job.location?.name === this.filter.location;
			const matchDept = !this.filter.department || job.departments?.some(dep => dep.name === this.filter.department);
			return matchLoc && matchDept;
		});
	}

	groupJobsByFirstDepartment(jobs) {
		return jobs.reduce((acc, job) => {
			const dept = job.departments?.[0]?.name || 'Uncategorized';
			acc[dept] = acc[dept] || [];
			acc[dept].push(job);
			return acc;
		}, {});
	}

	createGroupEl(dept, jobs) {
		const groupEl = this.templateGroup.content.cloneNode(true);
		groupEl.querySelector('.block-open-positions__group-title').textContent = dept;

		const cardsContainer = groupEl.querySelector('.block-open-positions__group-cards');
		jobs.forEach((job) => {
			const cardEl = this.createCardEl(job);
			if (cardEl) cardsContainer.appendChild(cardEl);
		});

		return groupEl;
	}

	createCardEl(job) {
		if (!job.title || !job.absolute_url) return null;

		const cardEl = this.templateCard.content.cloneNode(true);
		const cardLink = cardEl.querySelector('a.block-open-positions__card');
		const titleEl = cardEl.querySelector('.block-open-positions__card-title');
		const descEl = cardEl.querySelector('.block-open-positions__card-desc');

		cardLink.href = job.absolute_url;
		titleEl.textContent = job.title;
		descEl.textContent = job.location?.name || '';

		return cardEl;
	}
}

export default BlockOpenPositions;
