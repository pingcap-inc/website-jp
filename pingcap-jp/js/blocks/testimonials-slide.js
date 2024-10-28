import { loadEmblaCarousel } from '../util/load-dependencies';
import EmblaAutoplay, { stopAutoplayOnHover } from '../util/embla/autoplay';
import EmblaPagination from '../util/embla/pagination';
import { isDesktopViewport } from '../util/viewport';

class BlockTestimonialsSlide {
	constructor(el) {
		this.el = el;
		this.testimonialInitialized = false;
		this.initEmbla();
	}

	async initEmbla() {
		if (this.testimonialInitialized) {
			return;
		}

		try {
			const EmblaCarousel = await loadEmblaCarousel();
			const emblaRootEl = this.el.querySelector('.embla-instance');

			if (!emblaRootEl) {
				return;
			}

			const emblaEl = emblaRootEl.querySelector('.embla');
			const paginationEl = this.el.querySelector('.embla__pagination');
			const instance = {
				embla: EmblaCarousel(emblaEl, {
					align: 'start',
					draggable: !isDesktopViewport(),
					loop: true,
					duration: 40
				}),
				autoplay: null
			};

			if (instance.embla) {
				instance.autoplay = new EmblaAutoplay(instance.embla, 4000);

				stopAutoplayOnHover(emblaRootEl, instance.autoplay, 1000);
			}

			if (paginationEl) {
				instance.pagination = new EmblaPagination(instance.embla, paginationEl, {
					buttonClassName: 'embla__pagination-button'
				});
			}

			this.testimonialInitialized = true;
		} catch (err) {
			console.error('Embla Carousel dynamic import failed', err);
		}
	}
}

export default BlockTestimonialsSlide;
