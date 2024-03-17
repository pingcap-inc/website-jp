import PostsList from './posts-list';
import { queryArgsAsMap, getUrlWithQueryArgs, getUrlQueryArg } from '../../util/url-util';
import { loadEmblaCarousel } from '../../util/load-dependencies';
import { enableNavButtons } from '../../util/embla/util';
import EmblaAutoplay, { stopAutoplayOnHover } from '../../util/embla/autoplay';
import EmblaPagination from '../../util/embla/pagination';
import SiteEvents, { SiteEventNames } from '../../util/site-events';

class PostsListCaseStudy extends PostsList {
	constructor(el) {
		super(el);

		this.setEndpoint(this.cardsContainer.getAttribute('data-endpoint') ?? 'wp/v2/case-study');
		this.setPostDisplayCallback((cardMarkup) => cardMarkup);

		this.tmplArchiveCaseStudyEl = document.querySelector('.tmpl-archive-case-study');
		this.featuredInitialized = false;

		this.formSearchEl = document.querySelector(
			'.banner-case-study-archive__filters form#form_filter_search'
		);
		this.filterIndustryEl = document.querySelector(
			'.banner-case-study-archive__filters select#filter_industry'
		);
		this.filterTagEl = document.querySelector('.banner-case-study-archive__filters select#filter_tag');

		this.filterIndustrySlug = getUrlQueryArg('industry', '');
		this.filterTagSlug = getUrlQueryArg('tag', '');
		this.filterSearch = getUrlQueryArg('search', '');

		if (this.loadMore) {
			this.loadMore.on('load', () => this.loadCaseStudyPosts());
		}

		if (this.formSearchEl) {
			this.formSearchEl.addEventListener('submit', (e) => {
				e.preventDefault();

				const inputEl = e.currentTarget.querySelector('input');

				if (inputEl) {
					this.filterSearch = inputEl.value.trim();

					this.updateURL();
					this.clearCardsContainer();
					this.loadCaseStudyPosts();
				}
			});
		}

		if (this.filterIndustryEl) {
			this.filterIndustryEl.addEventListener('change', (e) => {
				this.filterIndustrySlug = e.currentTarget.value ?? '';

				this.updateURL();
				this.clearCardsContainer();
				this.loadCaseStudyPosts();
			});
		}

		if (this.filterTagEl) {
			this.filterTagEl.addEventListener('change', (e) => {
				this.filterTagSlug = e.currentTarget.value ?? '';

				this.updateURL();
				this.clearCardsContainer();
				this.loadCaseStudyPosts();
			});
		}

		this.initEmbla();
	}

	loadCaseStudyPosts() {
		const config = {
			industry_slug: this.filterIndustrySlug,
			tag_slug: this.filterTagSlug,
			search: this.filterSearch
		};

		// if (this.tmplArchiveCaseStudyEl) {
		// 	if (config.industry_slug || config.tag_slug || config.search) {
		// 		this.tmplArchiveCaseStudyEl.classList.add('tmpl-archive-case-study--filtered');
		// 	} else {
		// 		this.tmplArchiveCaseStudyEl.classList.remove('tmpl-archive-case-study--filtered');
		// 		this.initEmbla();
		// 	}
		// }

		this.loadMorePosts(config);
	}

	updateURL() {
		const args = queryArgsAsMap();

		if (this.filterIndustrySlug) {
			args.set('industry', this.filterIndustrySlug);
		} else {
			args.delete('industry');
		}

		if (this.filterTagSlug) {
			args.set('tag', this.filterTagSlug);
		} else {
			args.delete('tag');
		}

		if (this.filterSearch) {
			args.set('search', this.filterSearch);
		} else {
			args.delete('search');
		}

		window.history.replaceState({}, '', getUrlWithQueryArgs(args));
	}

	async initEmbla() {
		// skip the initialization if the initilialized flag has already been
		// set or if the "tmpl-archive-case-study--filtered" class exists on the
		// template archive element
		if (
			this.featuredInitialized ||
			(this.tmplArchiveCaseStudyEl &&
				this.tmplArchiveCaseStudyEl.classList.contains('tmpl-archive-case-study--filtered'))
		) {
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
			const paginationEl = this.el.querySelector(
				'.posts-list-case-study__featured-nav .embla__pagination'
			);

			const transitionSpeed = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-transition-speed') || 10, 10)
				: 10;

			const autoplayEnabled = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-autoplay-enabled') || 1, 10)
				: 1;

			const autoplaySpeed = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-autoplay-speed') || 4000, 10)
				: 4000;

			const instance = {
				embla: EmblaCarousel(emblaEl, {
					loop: autoplayEnabled,
					speed: transitionSpeed,
					containScroll: 'keepSnaps'
				}),
				pagination: null,
				autoplay: null
			};

			if (instance.embla) {
				instance.embla.on('init', () => {
					SiteEvents.publish(SiteEventNames.LAZYLOAD_TRIGGER_UPDATE);
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

			this.featuredInitialized = true;
		} catch (err) {
			console.error('Embla Carousel dynamic import failed', err);
		}
	}
}

export default PostsListCaseStudy;
