class PillarPage {
	constructor(el) {
		this.el = el;
		this.content = el.querySelector('.tmpl-pillar-container');
		this.toc = el.querySelector('#toc');
		this.tocItems = [];
		this.slugCountMap = {};
		this.headerOffset =
			(document.querySelector('header')?.clientHeight || 0) +
			(document.querySelector('#wpadminbar')?.clientHeight || 0) +
			20;

		this._init();
	}

	_init() {
		this._buildToc();
		this._bindClickScroll();
		this._observeHeadings();
		this._scrollToHashIfPresent();
	}

	_slugify(text) {
		let slug = text
			.toLowerCase()
			.trim()
			.replace(/[^\w\s-]/g, '')
			.replace(/\s+/g, '-');

		if (this.slugCountMap[slug] != null) {
			this.slugCountMap[slug]++;
			slug = `${slug}-${this.slugCountMap[slug]}`;
		} else {
			this.slugCountMap[slug] = 0;
		}
		return slug;
	}

	_buildToc() {
		const headers = this.content.querySelectorAll('h2, h3');
		const tocList = document.createElement('ul');
		let currentH2 = null;

		headers.forEach((header) => {
			if (!header.id) header.id = this._slugify(header.textContent);

			const link = this._createLink(header);
			const li = document.createElement('li');
			li.appendChild(link);

			if (header.tagName === 'H2') {
				const nestedUl = document.createElement('ul');
				nestedUl.classList.add('nested');
				li.appendChild(nestedUl);

				const item = {
					id: header.id,
					li,
					nestedUl,
					children: []
				};

				tocList.appendChild(li);
				this.tocItems.push(item);
				currentH2 = item;
			} else if (header.tagName === 'H3' && currentH2) {
				currentH2.nestedUl.appendChild(li);
				currentH2.children.push(header.id);
			}
		});

		this.toc.appendChild(tocList);
	}

	_createIntroLink() {
		const li = document.createElement('li');
		const link = document.createElement('a');
		link.href = '#introduction';
		link.textContent = 'Introduction';
		link.dataset.targetId = 'introduction';
		link.addEventListener('click', (e) => {
			e.preventDefault();
			window.scrollTo({ top: 0, behavior: 'smooth' });
			window.history.replaceState({}, '', '#introduction');
		});
		li.appendChild(link);
		return li;
	}

	_createLink(header) {
		const link = document.createElement('a');
		link.href = `#${header.id}`;
		link.textContent = header.textContent;
		link.dataset.targetId = header.id;
		return link;
	}

	_bindClickScroll() {
		this.toc.addEventListener('click', (e) => {
			const link = e.target.closest('a[data-target-id]');
			if (!link) return;

			e.preventDefault();
			const id = link.dataset.targetId;
			const target = document.getElementById(id);

			if (!target) return;

			if (id === 'introduction') {
				window.scrollTo({ top: 0, behavior: 'smooth' });
			} else {
				const top =
					target.getBoundingClientRect().top + window.pageYOffset - this.headerOffset;
				window.scrollTo({ top, behavior: 'smooth' });
			}
			window.history.replaceState({}, '', `#${id}`);
		});
	}

	_scrollToHashIfPresent() {
		const hash = window.location.hash;
		if (hash && hash.length > 1) {
			const target = document.getElementById(hash.substring(1));
			if (target) {
				setTimeout(() => {
					const top =
						target === 'introduction'
							? 0
							: target.getBoundingClientRect().top +
							  window.pageYOffset -
							  this.headerOffset;
					window.scrollTo({ top, behavior: 'smooth' });
				}, 300);
			}
		}
	}

	_observeHeadings() {
		const headers = this.content.querySelectorAll('h2, h3');
		const observer = new IntersectionObserver(this._onIntersection.bind(this), {
			root: null,
			rootMargin: '-30% 0px -60% 0px',
			threshold: 0
		});

		headers.forEach((header) => observer.observe(header));
	}

	_onIntersection(entries) {
		for (const entry of entries) {
			if (entry.isIntersecting) {
				const id = entry.target.id;

				// Highlight current link
				this.toc.querySelectorAll('a').forEach((link) => {
					link.classList.toggle('active', link.dataset.targetId === id);
				});

				// Expand parent h2
				const h2Id = this._getParentH2Id(id);
				this.tocItems.forEach((item) => {
					item.li.classList.toggle('expanded', item.id === h2Id);
				});
				break; // only act on first visible one
			}
		}
	}

	_getParentH2Id(id) {
		for (const item of this.tocItems) {
			if (item.id === id || item.children.includes(id)) {
				return item.id;
			}
		}
		return null;
	}
}

export default PillarPage;
