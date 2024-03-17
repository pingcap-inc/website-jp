export function stopAutoplayOnHover(hoverEl, autoplayInstance, timeout = 2000) {
	let mouseOverTimeout = 0;

	const mouseLeaveCb = () => {
		clearTimeout(mouseOverTimeout);
	};

	const mouseEnterCb = () => {
		mouseOverTimeout = setTimeout(() => {
			autoplayInstance.stop();

			hoverEl.removeEventListener('mouseenter', mouseEnterCb);
			hoverEl.removeEventListener('mouseleave', mouseLeaveCb);
		}, timeout);
	};

	hoverEl.addEventListener('mouseenter', mouseEnterCb);
	hoverEl.addEventListener('mouseleave', mouseLeaveCb);
}

class EmblaAutoplay {
	/**
	 * Initialize autoplay support for the provided Embla instance
	 *
	 * @param {Object} embla The Embla instance
	 * @param {number} interval The autoplay interval in ms
	 */
	constructor(embla, interval) {
		this.emblaInstance = embla;
		this.interval = interval;
		this.timer = 0;

		if (this.emblaInstance) {
			this.emblaInstance.on('init', this.play);
			this.emblaInstance.on('pointerDown', this.stop);
		}
	}

	/**
	 * Start the autoplay timer
	 */
	play = () => {
		this.stop();

		requestAnimationFrame(() => {
			this.timer = window.setTimeout(this.next, this.interval);
		});
	};

	/**
	 * Stop the autoplay timer
	 */
	stop = () => {
		window.clearTimeout(this.timer);

		this.timer = 0;
	};

	/**
	 * Advance to the next slide
	 */
	next = () => {
		if (this.emblaInstance.canScrollNext()) {
			this.emblaInstance.scrollNext();
		} else {
			this.emblaInstance.scrollTo(0);
		}

		this.play();
	};
}

export default EmblaAutoplay;
