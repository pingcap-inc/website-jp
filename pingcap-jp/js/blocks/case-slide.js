import { loadEmblaCarousel } from '../util/load-dependencies';
import EmblaAutoplay, { stopAutoplayOnHover } from '../util/embla/autoplay';
import EmblaPagination from '../util/embla/pagination';
import { isDesktopViewport } from '../util/viewport';
import { enableNavButtons } from '../util/embla/util';

class BlockCaseSlide {
	constructor(el) {
		this.el = el;
		this.emblaInitialized = false;
		this.initEmbla();
	}

	async initEmbla() {
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
			const btnPrevEl = Array.from(this.el.querySelectorAll('.embla__nav-button--prev'));
			const btnNextEl = Array.from(this.el.querySelectorAll('.embla__nav-button--next'));
			const paginationEl = this.el.querySelector('.embla__pagination');
			const instance = {
				embla: EmblaCarousel(emblaEl, {
					align: 'center',
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
			if (btnPrevEl && btnNextEl) {
				enableNavButtons(instance.embla, btnPrevEl, btnNextEl);
			}

			if (paginationEl) {
				instance.pagination = new EmblaPagination(instance.embla, paginationEl, {
					buttonClassName: 'embla__pagination-button'
				});
			}

			this.emblaInitialized = true;
		} catch (err) {
			console.error('Embla Carousel dynamic import failed', err);
		}
	}
}

export default BlockCaseSlide;
