import SiteEvents, { SiteEventNames } from '../util/site-events';
import { queryArgsAsMap, getUrlWithQueryArgs, getUrlQueryArg } from '../util/url-util';

class ScrollSubNav {
	constructor(el) {
		this.el = el;
		this.type = this.el.getAttribute('data-type');
		this.subNavEls = Array.from(this.el.querySelectorAll('.sub-nav__link'));
		this.contentEls = [];

		if (!this.subNavEls.length) {
			return;
		}

		this.subNavEls.forEach((subNavEl, index) => {
			const id = subNavEl.getAttribute('href');
			const contentEl = document.querySelector(id);
			if (contentEl) {
				this.contentEls[index] = contentEl;
			}

			subNavEl.addEventListener('click', (e) => {
				e.preventDefault();

				const currentId = e.currentTarget.getAttribute('href').replace('#', '');

				this.handleClick(currentId);
				this.updateUrl(currentId);
			});
		});

		this.init();
	}

	init() {
		const id = getUrlQueryArg('tab', '') || this.contentEls[0].id;

		this.setTabActive(id);
		this.setTabContentActive(id);

		if (this.type == 'anchor') {
			window.addEventListener('scroll', this.handleScroll.bind(this));
		}
	}

	setTabActive(id) {
		this.subNavEls.forEach((el) => {
			if (`#${id}` === el.getAttribute('href')) {
				el.classList.add('active');
			} else {
				el.classList.remove('active');
			}
		});
	}

	setTabContentActive(id) {
		if (this.type === 'anchor') {
			return;
		}

		this.contentEls.forEach((el) => {
			if (id === el.id) {
				el.style.display = 'block';
			} else {
				el.style.display = 'none';
			}
		});
		SiteEvents.publish(SiteEventNames.LAZYLOAD_TRIGGER_UPDATE);
	}

	setScrollTo(id) {
		const topOffset =
			document.querySelector('.site-header').clientHeight +
			(document.querySelector('#wpadminbar')?.clientHeight || 0) +
			this.el.clientHeight;

		window.scrollTo({
			top:
				document.querySelector(`#${id}`).getBoundingClientRect().top +
				window.pageYOffset -
				topOffset -
				20,
			behavior: 'smooth'
		});
	}

	handleClick(id) {
		this.setTabActive(id);
		this.setTabContentActive(id);
		this.setScrollTo(id);
	}

	handleScroll() {
		const activeIndex = this.getActiveElement(
			this.contentEls.map((d) => d.getBoundingClientRect())
		);

		this.setTabActive(this.contentEls[activeIndex].id);
	}

	getActiveElement(rects) {
		if (rects.length === 0) {
			return -1;
		}

		const closest = rects.reduce(
			(acc, item, index) => {
				if (Math.abs(acc.position) < Math.abs(item.y) - 100) {
					return acc;
				}

				return {
					index,
					position: item.y
				};
			},
			{ index: 0, position: rects[0].y }
		);

		return closest.index;
	}
	updateUrl(id) {
		if (this.type === 'tab') {
			const args = queryArgsAsMap();
			args.set('tab', id);
			window.history.replaceState({}, '', getUrlWithQueryArgs(args));
			return;
		}
		window.history.replaceState({}, '', `#${id}`);
	}
}

export default ScrollSubNav;
