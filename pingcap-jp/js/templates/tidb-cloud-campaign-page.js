class CampaignPage {
	constructor(el) {
		this.el = el;
		this.moreContentEls = Array.from(el.querySelectorAll('.more-content'));
		this.moreButtonEls = Array.from(el.querySelectorAll('.more'));
		this.handleMore();
		this.handleMenu();
	}
	handleMenu() {
		const navbarEl = document.querySelector('.navbar-toggle');
		const navEl = document.querySelector('.tmpl-tidb-cloud-campaign__header nav');
		const navMenuEls = document.querySelectorAll('.tmpl-tidb-cloud-campaign__header .nav-menu');
		navbarEl.addEventListener('click', () => {
			if (navEl.classList.contains('active')) {
				navEl.classList.remove('active');
			} else {
				navEl.classList.add('active');
			}
		});
		navMenuEls.forEach((el) => {
			el.addEventListener('click', () => {
				navEl.classList.remove('active');
			});
		});
	}
	handleMore() {
		this.moreButtonEls.forEach((buttonEl, index) => {
			const contentEl = this.moreContentEls[index];
			buttonEl.addEventListener('click', () => {
				const ulContentEl = contentEl.querySelector('ul');
				let originalHeight = buttonEl.scrollHeight;
				if (ulContentEl) {
					originalHeight = 349;
				}
				if (contentEl.classList.contains('expanded')) {
					contentEl.classList.remove('expanded');
					contentEl.style.height = originalHeight + 'px';
				} else {
					contentEl.classList.add('expanded');
					contentEl.style.height = contentEl.scrollHeight + 'px';
				}
			});
		});
	}
}

export default CampaignPage;
