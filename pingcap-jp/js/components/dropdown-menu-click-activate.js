class DropdownMenuClickActivate {
	constructor(el) {
		this.el = el;
		this.activatorEl = this.el.querySelector('.dropdown-menu-activate');
		this.otherHoverMenuEls = Array.from(
			document.querySelectorAll(
				'.site-header__dropdown-menu-container:not(.site-header__dropdown-menu-container--click-activate)'
			)
		);

		if (this.activatorEl) {
			this.activatorEl.addEventListener('click', () => {
				if (this.el.classList.contains('active')) {
					this.closeMenu();
				} else {
					this.openMenu();
				}
			});
		}
	}

	openMenu() {
		this.el.classList.add('active');
		document.addEventListener('click', this.outsideClickHandler);

		this.otherHoverMenuEls.forEach((menuEl) => {
			menuEl.addEventListener('mouseover', this.closeMenu);
		});
	}

	closeMenu = () => {
		this.el.classList.remove('active');
		document.removeEventListener('click', this.outsideClickHandler);

		this.otherHoverMenuEls.forEach((menuEl) => {
			menuEl.removeEventListener('mouseover', this.closeMenu);
		});
	};

	outsideClickHandler = (e) => {
		if (!e.srcElement || e.srcElement === this.activatorEl) {
			return;
		}

		const closestContainerEl = e.srcElement.closest(
			'.site-header__dropdown-menu-container--click-activate'
		);

		if (!closestContainerEl || closestContainerEl !== this.el) {
			this.closeMenu();
		}
	};
}

export default DropdownMenuClickActivate;
