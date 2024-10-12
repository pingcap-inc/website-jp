import { gsap } from 'gsap';
class BlockTabsSlide {
	constructor(el) {
		this.el = el;

		this.tabNavEls = Array.from(
			this.el.querySelectorAll('.block-tabs-slide__desktop .block-tabs-slide__tab')
		);
		this.tabContentEls = Array.from(
			this.el.querySelectorAll('.block-tabs-slide__desktop .block-tabs-slide__content')
		);
		this.tabPanelEl = this.el.querySelector(
			'.block-tabs-slide__desktop .block-tabs-slide__panel'
		);

		this.currentIndex = 0;
		this.maxHeight = 0;
		this.intervalId = null;
		this.autoSwitchDelay = 4000;

		this.tabNavEls.forEach((tabNavEl, index) => {
			tabNavEl.addEventListener('mouseenter', () => {
				this.stopAutoSwitch();
				this.switchDesktopTab(index);
			});

			tabNavEl.addEventListener('mouseleave', () => {
				this.startAutoSwitch();
			});
		});
		this.tabContentEls.forEach((tabContentEl) => {
			tabContentEl.addEventListener('mouseenter', () => {
				this.stopAutoSwitch();
			});

			tabContentEl.addEventListener('mouseleave', () => {
				this.startAutoSwitch();
			});
		});

		this.switchDesktopTab(0);
		this.startAutoSwitch();
	}

	switchDesktopTab(index) {
		if (this.currentIndex === index && this.tabNavEls[index].classList.contains('active')) {
			return;
		}
		this.tabNavEls.forEach((tabNavEl) => tabNavEl.classList.remove('active'));
		this.tabContentEls.forEach((tabContentEl) => tabContentEl.classList.remove('active'));

		this.tabNavEls[index].classList.add('active');
		this.tabContentEls[index].classList.add('active');
		gsap.fromTo(this.tabContentEls[index], { opacity: 0 }, { duration: 0.6, opacity: 1 });

		this.currentIndex = index;

		const maxHeight = this.getMaxHeight();
		this.maxHeight = maxHeight;
		if (index !== 0) {
			this.tabPanelEl.style.height = maxHeight + 'px';
		}
	}

	startAutoSwitch() {
		this.intervalId = setInterval(() => {
			this.currentIndex = (this.currentIndex + 1) % this.tabNavEls.length;
			this.switchDesktopTab(this.currentIndex);
		}, this.autoSwitchDelay);
	}

	stopAutoSwitch() {
		clearInterval(this.intervalId);
	}

	getMaxHeight() {
		let maxHeight = this.maxHeight;
		this.tabContentEls.forEach((tabContentEl) => {
			const height = tabContentEl.scrollHeight;
			if (height > this.maxHeight) {
				maxHeight = height;
			}
		});
		return maxHeight;
	}
}

export default BlockTabsSlide;
