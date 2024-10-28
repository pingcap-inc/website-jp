class MobileMenus {
	constructor() {
		this.mobileDefaultActiveClass = 'mobile-menu-default-active';
		this.mobileCtaActiveClass = 'mobile-menu-cta-active';
		this.timer = null;
		this.mobileMenuEls = Array.from(
			document.querySelectorAll('.mobile-menu-default__primary-group')
		);
		this.openMenuItem();
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
		this.mobileMenuEls.forEach((menuEl) => {
			menuEl.classList.remove('active');
		});
	}

	openDefault() {
		const height = document.querySelector('header').offsetHeight;
		const helloBarHeight = document.querySelector('.site-header__hello-bar')?.offsetHeight ?? 0;
		const adminBarHeight = document.querySelector('#wpadminbar')?.offsetHeight ?? 0;

		if (document.querySelector('header').getBoundingClientRect().top - adminBarHeight) {
			clearTimeout(this.timer);
			window.scrollTo({
				top: helloBarHeight,
				behavior: 'smooth'
			});
			this.timer = setTimeout(() => {
				document.querySelector('.mobile-menu-default').style.top = `${
					height + adminBarHeight
				}px`;
				document.documentElement.classList.add(this.mobileDefaultActiveClass);
			}, 100);
		} else {
			document.querySelector('.mobile-menu-default').style.top = `${
				height + adminBarHeight
			}px`;
			document.documentElement.classList.add(this.mobileDefaultActiveClass);
		}
	}

	openMenuItem() {
		this.mobileMenuEls.forEach((menuEl) => {
			const labelEl = menuEl?.querySelector('.mobile-menu-default__primary-title-label');
			labelEl &&
				labelEl.addEventListener('click', () => {
					this.mobileMenuEls.forEach((el) => {
						if (menuEl !== el) {
							el.classList.remove('active');
						}
					});

					menuEl.classList.toggle('active');
				});
		});
	}
}

export default new MobileMenus();
