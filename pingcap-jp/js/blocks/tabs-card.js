import SiteEvents, { SiteEventNames } from '../util/site-events';

class BlockTabsCard {
	constructor(el) {
		this.el = el;
		this.navBtnEls = Array.from(this.el.querySelectorAll('.card-media'));

        if(!this.navBtnEls.length) {
            return;
        }

        this.switchDesktopSectionId(0);
		SiteEvents.publish(SiteEventNames.LAZYLOAD_TRIGGER_UPDATE);

		this.navBtnEls.forEach((btnEl,index) => {
			btnEl.addEventListener('click', (e) => {
				if (!e.currentTarget || e.currentTarget.classList.contains('active')) {
					return;
				}

				this.switchDesktopSectionId(index || 0);
			});
		});
	}

	switchDesktopSectionId(sectionId) {
		const desktopMainEls = document.querySelectorAll('.block-tabs__card-section');
	
		// update the "active" class for the nav button elements
		this.navBtnEls.forEach((navBtnEl,index) => {
			if (index === sectionId) {
				navBtnEl.classList.add('active');
			} else {
				navBtnEl.classList.remove('active');
			}
		});
        
		desktopMainEls.forEach((el,index) => {
			if (index === sectionId) {
				el.classList.add('active');
			} else {
				el.classList.remove('active');
			}
		});

		SiteEvents.publish(SiteEventNames.LAZYLOAD_TRIGGER_UPDATE);
	}
}

export default BlockTabsCard;
