import { loadEmblaCarousel } from '../util/load-dependencies';
import { enableNavButtons } from '../util/embla/util';
import EmblaPagination from '../util/embla/pagination';
import SiteEvents, { SiteEventNames } from '../util/site-events';
import EmblaAutoplay, { stopAutoplayOnHover } from '../util/embla/autoplay';

class BlockCarousel {
	constructor(el) {
		this.el = el;
		this.emblaInitialized = false;

		this.initEmbla();
	}

	async initEmbla() {
		// skip the initialization if the initilialized flag has already been set
		if (this.emblaInitialized) {
			return;
		}

		try {
			const EmblaCarousel = await loadEmblaCarousel();
			const emblaRootEl = this.el.querySelector('.embla-instance');

			if (!emblaRootEl) {
				return;
			}

			const emblaEl = emblaRootEl.querySelector('.embla');
			const emblaSlideEl = Array.from(this.el.querySelectorAll('.embla__slide'));
			const btnPrevEl = Array.from(this.el.querySelectorAll('.embla__nav-button--prev'));
			const btnNextEl = Array.from(this.el.querySelectorAll('.embla__nav-button--next'));
			const paginationEl = this.el.querySelector('.embla__pagination');

			const transitionSpeed = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-transition-speed') || 10, 10)
				: 10;

			const autoplayEnabled = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-autoplay-enabled') || 1, 10)
				: 1;

			const autoplaySpeed = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-autoplay-speed') || 4000, 10)
				: 4000;

			const loop = emblaSlideEl.length > 2 ? autoplayEnabled : false;

			const instance = {
				embla: EmblaCarousel(emblaEl, {
					loop,
					speed: transitionSpeed,
					containScroll: 'keepSnaps',
					draggable: false
				}),
				pagination: null,
				autoplay: autoplayEnabled
			};

			if (instance.embla) {
				instance.embla.on('init', () => {
					SiteEvents.publish(SiteEventNames.IMAGEBUDDY_TRIGGER_UPDATE);
					this.setBackgroundColor();
				});

				instance.embla.on('select', () => {
					this.setBackgroundColor();
				});

				if (btnPrevEl && btnNextEl) {
					enableNavButtons(instance.embla, btnPrevEl, btnNextEl);
				}

				if (paginationEl) {
					instance.pagination = new EmblaPagination(instance.embla, paginationEl, {
						buttonClassName: 'embla__pagination-button'
					});
				}

				if (autoplayEnabled) {
					instance.autoplay = new EmblaAutoplay(instance.embla, autoplaySpeed);

					stopAutoplayOnHover(emblaRootEl, instance.autoplay, 2000);
				}
			}

			this.emblaInitialized = true;
		} catch (err) {
			console.error('Embla Carousel dynamic import failed', err);
		}
	}

	setBackgroundColor() {
		const color = this.el.querySelector('.is-selected').getAttribute('data-color');
		if (color) {
			this.el.style.backgroundColor = color;
		}
	}
}

export default BlockCarousel;
