import { loadEmblaCarousel } from '../util/load-dependencies';
import EmblaAutoplay, { stopAutoplayOnHover } from '../util/embla/autoplay';
import { enableNavButtons } from '../util/embla/util';
import { useAdaptiveSlideHeights } from '../util/embla/adaptive-height';
import EmblaPagination from '../util/embla/pagination';
import SiteEvents, { SiteEventNames } from '../util/site-events';

class BlockTestimonials {
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
			const btnPrevEl = Array.from(this.el.querySelectorAll('.embla__nav-button--prev'));
			const btnNextEl = Array.from(this.el.querySelectorAll('.embla__nav-button--next'));
			const paginationDesktopEl = this.el.querySelector(
				'.block-testimonials__nav-desktop .embla__pagination'
			);
			const paginationMobileEl = this.el.querySelector(
				'.block-testimonials__nav-mobile .embla__pagination'
			);

			const transitionSpeed = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-transition-speed') || 10, 10)
				: 10;

			const enableAutoplay = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-enable-autoplay') || 0, 10)
				: 0;

			const autoplaySpeed = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-autoplay-speed') || 3000, 10)
				: 3000;

			const adaptiveSlideHeights = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-adaptive-slide-heights') || 1, 10)
				: 1;

			const instance = {
				embla: EmblaCarousel(emblaEl, {
					loop: true,
					speed: transitionSpeed
				}),
				paginationDesktop: null,
				paginationMobile: null,
				autoplay: null
			};

			if (instance.embla) {
				if (adaptiveSlideHeights) {
					useAdaptiveSlideHeights(instance.embla);
				}

				instance.embla.on('init', () => {
					SiteEvents.publish(SiteEventNames.LAZYLOAD_TRIGGER_UPDATE);
				});

				if (btnPrevEl && btnNextEl) {
					enableNavButtons(instance.embla, btnPrevEl, btnNextEl);
				}

				if (paginationDesktopEl) {
					instance.paginationDesktop = new EmblaPagination(
						instance.embla,
						paginationDesktopEl,
						{
							buttonClassName: 'embla__pagination-button'
						}
					);
				}

				if (paginationMobileEl) {
					instance.paginationDesktop = new EmblaPagination(
						instance.embla,
						paginationMobileEl,
						{
							buttonClassName: 'embla__pagination-button'
						}
					);
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

export default BlockTestimonials;
