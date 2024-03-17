class CardTierTabs {
	constructor(el) {
		this.el = el;
		const navBtnEls = Array.from(this.el.querySelectorAll('.js-tabs-nav'));
		if (navBtnEls.length) {
			navBtnEls.forEach((btnEl) => {
				btnEl.addEventListener('click', (e) => {
					if (!e.currentTarget || e.currentTarget.classList.contains('active')) {
						return;
					}
					this.switchProviderSectionId(e.currentTarget.getAttribute('data-section-id'));
				});
			});
		}
	}

	switchProviderSectionId(id) {
		const navBtnEls = Array.from(this.el.querySelectorAll('.js-tabs-nav'));
		const contentEls = Array.from(this.el.querySelectorAll('.js-tabs-content'));
		navBtnEls.forEach((navBtnEl) => {
			if (navBtnEl.getAttribute('data-section-id') === id) {
				navBtnEl.classList.add('active');
				this.currentTab = navBtnEl.getAttribute('data-section-name');
			} else {
				navBtnEl.classList.remove('active');
			}
		});
		contentEls.forEach((contentEl) => {
			console.log(contentEl.getAttribute('data-section-id'), id);
			if (contentEl.getAttribute('data-section-id') === id) {
				contentEl.classList.add('active');
			} else {
				contentEl.classList.remove('active');
			}
		});
	}
}

export default CardTierTabs;
