export function stopAutoplayOnHover(
	hoverEl,
	autoplayInstance,
	{ debounce = 300, timeout = 2000 } = {}
) {
	if (!hoverEl || !autoplayInstance) return () => {};

	let debounceTimeout = null;
	let stopTimeout = null;
	let isStopped = false;

	function clearDebounce() {
		if (debounceTimeout !== null) {
			clearTimeout(debounceTimeout);
			debounceTimeout = null;
		}
	}

	function clearStopTimeout() {
		if (stopTimeout !== null) {
			clearTimeout(stopTimeout);
			stopTimeout = null;
		}
	}

	function onMouseLeave() {
		clearDebounce();
		clearStopTimeout();
		if (isStopped) {
			autoplayInstance.play();
			isStopped = false;
		}
	}

	function onMouseEnter() {
		clearDebounce();
		debounceTimeout = setTimeout(() => {
			clearStopTimeout();
			stopTimeout = setTimeout(() => {
				autoplayInstance.stop();
				isStopped = true;
			}, timeout);
		}, debounce);
	}

	function cleanup() {
		clearDebounce();
		clearStopTimeout();
		hoverEl.removeEventListener('mouseenter', onMouseEnter);
		hoverEl.removeEventListener('mouseleave', onMouseLeave);
	}

	hoverEl.addEventListener('mouseenter', onMouseEnter);
	hoverEl.addEventListener('mouseleave', onMouseLeave);

	return cleanup;
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
