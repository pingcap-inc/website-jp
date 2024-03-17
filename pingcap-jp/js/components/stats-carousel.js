import { loadEmblaCarousel } from '../util/load-dependencies';
import EmblaAutoplay, { stopAutoplayOnHover } from '../util/embla/autoplay';
import { enableFadeTransition, enableNavButtons } from '../util/embla/util';

class StatsCircle {
	constructor(el) {
		this.el = el;

		this.initEmbla();
	}

	async initEmbla() {
		try {
			const EmblaCarousel = await loadEmblaCarousel();
			const emblaRootEl = this.el.querySelector('.embla-instance');

			if (!emblaRootEl) {
				return;
			}

			const emblaEl = emblaRootEl.querySelector('.embla');
			const btnPrevEl = this.el.querySelector('.embla__nav-button--prev');
			const btnNextEl = this.el.querySelector('.embla__nav-button--next');

			const transitionSpeed = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-transition-speed') || 10, 10)
				: 10;

			const enableAutoplay = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-enable-autoplay') || 0, 10)
				: 0;

			const autoplaySpeed = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-autoplay-speed') || 3000, 10)
				: 3000;

			const instance = {
				embla: EmblaCarousel(emblaEl, {
					loop: true,
					speed: transitionSpeed
				}),
				pagination: null,
				autoplay: null
			};

			if (instance.embla) {
				// enableFadeTransition(instance.embla, emblaEl);

				if (btnPrevEl && btnNextEl) {
					enableNavButtons(instance.embla, btnPrevEl, btnNextEl);
				}

				if (enableAutoplay && autoplaySpeed) {
					instance.autoplay = new EmblaAutoplay(instance.embla, autoplaySpeed);

					stopAutoplayOnHover(emblaRootEl, instance.autoplay, 2000);
				}
			}
		} catch (err) {
			console.error('Embla Carousel dynamic import failed', err);
		}
	}
}

export default StatsCircle;
