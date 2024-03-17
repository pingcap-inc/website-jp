/**
 * Attach click handlers to the specified prev/next button elements that trigger
 * the Embla instance to scroll slides
 *
 * @param {Object} embla The Embla instance
 * @param {HTMLElement[]|HTMLElement} prevEl The previous button element(s)
 * @param {HTMLElement[]|HTMLElement} nextEl The next button element(s)
 */
export function enableNavButtons(embla, prevEl, nextEl) {
	if (!embla) {
		return;
	}

	if (Array.isArray(prevEl)) {
		prevEl.forEach((el) => el.addEventListener('click', embla.scrollPrev, false));
	} else {
		prevEl.addEventListener('click', embla.scrollPrev, false);
	}

	if (Array.isArray(nextEl)) {
		nextEl.forEach((el) => el.addEventListener('click', embla.scrollNext, false));
	} else {
		nextEl.addEventListener('click', embla.scrollNext, false);
	}
}

/**
 * Enable a fade effect on slide transitions
 *
 * @param {Object} embla The Embla instance
 * @param {HTMLElement} emblaRootEl The HTML root element for the specified Embla instance
 */
export function enableFadeTransition(embla, emblaRootEl) {
	if (!embla || !emblaRootEl) {
		return;
	}

	embla.dangerouslyGetEngine().translate.toggleActive(false);

	emblaRootEl.classList.add('embla--fade');

	const toggleEmblaReady = (event) => {
		const isResizeEvent = event === 'resize';
		const toggleClass = isResizeEvent ? 'remove' : 'add';

		emblaRootEl.classList[toggleClass]('embla--is-ready');

		if (isResizeEvent) {
			embla.reInit();
		}
	};

	embla.on('init', toggleEmblaReady);
	embla.on('resize', toggleEmblaReady);
	embla.on('reInit', toggleEmblaReady);

	embla.on('select', () => {
		embla.slideNodes().forEach((slideEl) => {
			if (!slideEl.classList.contains('is-selected')) {
				return;
			}

			console.log(slideEl, slideEl.getBoundingClientRect().height);
		});
	});
}
