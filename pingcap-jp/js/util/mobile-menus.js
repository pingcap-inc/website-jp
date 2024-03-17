class MobileMenus {
	constructor() {
		this.mobileDefaultActiveClass = 'mobile-menu-default-active';
		this.mobileCtaActiveClass = 'mobile-menu-cta-active';
	}

	isOpen() {
		return (
			document.documentElement.classList.contains(this.mobileDefaultActiveClass) ||
			document.documentElement.classList.contains(this.mobileCtaActiveClass)
		);
	}

	closeAll() {
		document.documentElement.classList.remove(this.mobileDefaultActiveClass);
		document.documentElement.classList.remove(this.mobileCtaActiveClass);
	}

	openDefault() {
		document.documentElement.classList.add(this.mobileDefaultActiveClass);
	}

	openCTA() {
		document.documentElement.classList.add(this.mobileCtaActiveClass);
	}
}

export default new MobileMenus();
