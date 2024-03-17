import SiteEvents, { SiteEventNames } from '../util/site-events';

class BlockTabs {
	constructor(el) {
		this.el = el;
		this.navBtnEls = Array.from(this.el.querySelectorAll('.block-tabs__nav-button'));
		this.sectionEls = Array.from(this.el.querySelectorAll('.block-tabs__desktop-main .block-tabs__section-top'));

		this.navBtnEls.forEach((btnEl) => {
			btnEl.addEventListener('click', (e) => {
				if (!e.currentTarget || e.currentTarget.classList.contains('active')) {
					return;
				}

				this.switchDesktopSectionId(e.currentTarget.getAttribute('data-section-id') ?? '');
			});
		});
		this.sectionEls[0].classList.add('active');
	}

	switchDesktopSectionId(sectionId) {
		if (!sectionId) {
			return;
		}

		// update the "active" class for the nav button elements
		this.navBtnEls.forEach((navBtnEl) => {
			if (navBtnEl.getAttribute('data-section-id') === sectionId) {
				navBtnEl.classList.add('active');
			} else {
				navBtnEl.classList.remove('active');
			}
		});

		this.sectionEls.forEach(sectionEl => {
			if (sectionEl.getAttribute('data-section-id') === sectionId) {
				sectionEl.classList.add('active');
			} else {
				sectionEl.classList.remove('active');
			}
		})

		SiteEvents.publish(SiteEventNames.LAZYLOAD_TRIGGER_UPDATE);
	}
}

export default BlockTabs;
