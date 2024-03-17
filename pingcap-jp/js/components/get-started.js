class GetStarted {
	constructor(el) {
		this.el = el;
		this.selectorEls = Array.from(this.el.querySelectorAll('.get-started__selector'));
		this.curPlatformIndex = 0;

		this.selectorEls.forEach((selectorEl) => {
			selectorEl.addEventListener('click', (e) => {
				const btnEl = e.currentTarget;

				if (!btnEl) {
					return;
				}

				const platformIndex = parseInt(
					btnEl.getAttribute('data-platform-index') ?? '0',
					10
				);

				this.switchPlatform(platformIndex);
			});
		});
	}

	switchPlatform(platformIndex) {
		// check if the section is already active
		if (this.curPlatformIndex === platformIndex) {
			return;
		}

		// reset active state of all section selectors and sections
		const sectionEls = Array.from(this.el.querySelectorAll('.get-started__platform-section'));

		sectionEls.map((sectionEl) => sectionEl.classList.remove('active'));

		this.selectorEls.map((selectorEl) => selectorEl.classList.remove('active'));

		// set the active state for the clicked section selector button
		const targetSelectorEl = this.el.querySelector(
			`.get-started__selector[data-platform-index="${platformIndex}"]`
		);

		if (targetSelectorEl) {
			targetSelectorEl.classList.add('active');
		}

		// set the active state for the associated section element
		const targetSectionEl = this.el.querySelector(
			`.get-started__platform-section[data-platform-index="${platformIndex}"]`
		);

		if (targetSectionEl) {
			targetSectionEl.classList.add('active');
		}

		// set the current platform index variable
		this.curPlatformIndex = platformIndex;
	}
}

export default GetStarted;
