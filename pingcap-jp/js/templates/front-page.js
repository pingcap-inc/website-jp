import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

import { isDesktopViewport } from '../util/viewport';
import { loadEmblaCarousel } from '../util/load-dependencies';
import EmblaAutoplay, { stopAutoplayOnHover } from '../util/embla/autoplay';
import EmblaPagination from '../util/embla/pagination';
import SiteEvents, { SiteEventNames } from '../util/site-events';

gsap.registerPlugin(ScrollTrigger);

class TemplateFrontPage {
	constructor(el) {
		this.el = el;
		this.pillarsEl = this.el.querySelector('.pillars');

		this.initLogoWall();

		if (typeof Prism !== 'undefined' && Prism.highlightAll) {
			Prism.highlightAll();
		}

		// gsap.fromTo(
		// 	'.banner-home__text-container',
		// 	{ opacity: 0, y: 50 },
		// 	{ opacity: 1, y: 0, duration: 1 }
		// );
		// gsap.fromTo(
		// 	'.banner-home__desc-container',
		// 	{ opacity: 0, y: 50 },
		// 	{ opacity: 1, y: 0, duration: 1 }
		// );

		// gsap.fromTo(
		// 	'.case-framer',
		// 	{
		// 		y: 50,
		// 		opacity: 0
		// 	},
		// 	{
		// 		y: 0,
		// 		opacity: 1,
		// 		duration: 1,
		// 		stagger: 0.1,
		// 		scrollTrigger: {
		// 			trigger: '.case-framer',
		// 			start: 'top 100%',
		// 			end: 'bottom 20%'
		// 		}
		// 	}
		// );

		const blockTitle = gsap.utils.toArray('.block-title');
		blockTitle.forEach((block) => {
			gsap.fromTo(
				block,
				{
					y: 50,
					opacity: 0
				},
				{
					y: 0,
					opacity: 1,
					duration: 1,
					stagger: 0.1,
					scrollTrigger: {
						trigger: block,
						start: 'top 100%',
						end: 'bottom 20%'
					}
				}
			);
		});

		// this.testimonialInitialized = false;
		// this.initTestimonials();
		this.initTabCodeAnimation();

		Array.from(this.el.querySelectorAll('.button-link')).forEach((el) => {
			el.addEventListener('click', (e) => {
				if (el.getAttribute('href').includes('#demo')) {
					e.preventDefault();
					const topOffset =
						document.querySelector('.site-header').clientHeight +
						(document.querySelector('#wpadminbar')?.clientHeight || 0);
					window.scrollTo({
						top:
							document.querySelector('#demo').getBoundingClientRect().top +
							window.pageYOffset -
							topOffset,
						behavior: 'smooth'
					});
				}
			});
		});

		var lottiePlayer = document.querySelector('dotlottie-player');
		if (lottiePlayer) {
			lottiePlayer.addEventListener('ready', function () {
				var poster = document.querySelector('.banner-home__hero-poster');
				if (poster) {
					poster.style.opacity = '0';
				}
				this.classList.add('is-ready');
			});
		}
	}

	initTabCodeAnimation() {
		if (!this.pillarsEl) return;

		this.prismReady = false;

		const codeBoxes = this.pillarsEl.querySelectorAll('.code-box');
		codeBoxes.forEach((box) => {
			const codeEl = box.querySelector('code');
			if (!codeEl) return;

			codeEl.dataset.rawHtml = codeEl.innerHTML;
			codeEl.innerHTML = '';
			codeEl.dataset.typed = 'false';
		});

		// Desktop: trigger on tab switch
		const desktopContents = this.pillarsEl.querySelectorAll(
			'.block-tabs-slide__desktop .block-tabs-slide__content'
		);
		const observer = new MutationObserver((mutations) => {
			mutations.forEach((m) => {
				const codeEl = m.target.querySelector('code[data-raw-html]');
				if (!codeEl) return;

				if (m.target.classList.contains('active')) {
					// Reset and replay when tab becomes active
					this.stopTypeCode(codeEl);
					codeEl.innerHTML = '';
					codeEl.dataset.typed = 'false';
					delete codeEl.dataset.fullHtml;
					if (this.prismReady) this.typeCode(codeEl);
				} else {
					// Stop animation when tab becomes inactive
					this.stopTypeCode(codeEl);
					codeEl.dataset.typed = 'false';
					codeEl.innerHTML = '';
				}
			});
		});
		desktopContents.forEach((content) => {
			observer.observe(content, { attributes: true, attributeFilter: ['class'] });
		});

		// Mobile: trigger on scroll
		const mobileBoxes = this.pillarsEl.querySelectorAll(
			'.block-tabs-slide__mobile code[data-raw-html]'
		);
		mobileBoxes.forEach((codeEl) => {
			ScrollTrigger.create({
				trigger: codeEl.closest('.code-box'),
				start: 'top 85%',
				once: true,
				onEnter: () => this.typeCode(codeEl)
			});
		});

		// Wait for Prism to be ready before starting first animation
		SiteEvents.subscribe(SiteEventNames.PRISM_READY, () => {
			this.prismReady = true;
			const firstActive = this.pillarsEl.querySelector(
				'.block-tabs-slide__desktop .block-tabs-slide__content.active code[data-raw-html]'
			);
			if (firstActive) this.typeCode(firstActive);
		});
	}

	stopTypeCode(codeEl) {
		const timerId = codeEl._typeTimerId;
		const rafId = codeEl._typeRafId;
		if (timerId) clearTimeout(timerId);
		if (rafId) cancelAnimationFrame(rafId);
		codeEl._typeTimerId = null;
		codeEl._typeRafId = null;
	}

	typeCode(codeEl) {
		if (codeEl.dataset.typed === 'typing') return;
		codeEl.dataset.typed = 'typing';

		// Ensure we have syntax-highlighted HTML
		if (!codeEl.dataset.fullHtml) {
			codeEl.innerHTML = codeEl.dataset.rawHtml;
			if (typeof Prism !== 'undefined') {
				Prism.highlightElement(codeEl);
			}
			codeEl.dataset.fullHtml = codeEl.innerHTML;
		}

		const fullHTML = codeEl.dataset.fullHtml;
		const codeBody = codeEl.closest('.code-body');
		let i = 0;
		let output = '';
		const charDelay = 10;

		const tick = () => {
			if (codeEl.dataset.typed !== 'typing') return;

			if (i >= fullHTML.length) {
				codeEl.dataset.typed = 'true';
				codeEl._typeTimerId = null;
				codeEl._typeRafId = null;
				// Re-apply Prism if needed
				if (typeof Prism !== 'undefined') {
					Prism.highlightElement(codeEl);
					codeEl.dataset.fullHtml = codeEl.innerHTML;
				}
				return;
			}

			// If we hit a tag, add the whole tag at once
			if (fullHTML[i] === '<') {
				const closeIndex = fullHTML.indexOf('>', i);
				if (closeIndex !== -1) {
					output += fullHTML.substring(i, closeIndex + 1);
					i = closeIndex + 1;
				} else {
					output += fullHTML[i];
					i++;
				}
			} else if (fullHTML[i] === '&') {
				// Handle HTML entities like &amp; &lt; etc.
				const semiIndex = fullHTML.indexOf(';', i);
				if (semiIndex !== -1 && semiIndex - i < 10) {
					output += fullHTML.substring(i, semiIndex + 1);
					i = semiIndex + 1;
				} else {
					output += fullHTML[i];
					i++;
				}
			} else {
				output += fullHTML[i];
				i++;
			}

			codeEl.innerHTML = output;

			// Auto-scroll code body to bottom
			if (codeBody) {
				codeBody.scrollTop = codeBody.scrollHeight;
			}

			codeEl._typeRafId = requestAnimationFrame(() => {
				codeEl._typeTimerId = setTimeout(tick, charDelay);
			});
		};

		codeEl.innerHTML = '';
		tick();
	}

	initLogoWall() {
		const track = this.el.querySelector('.logo-wall-track');
		if (!track) return;

		const items = Array.from(track.children);
		const gap = parseFloat(getComputedStyle(track).columnGap) || 0;
		const images = track.querySelectorAll('img');

		const measure = () => {
			const originalWidth = track.scrollWidth + gap;
			track.style.setProperty('--scroll-width', `${originalWidth}px`);
			items.forEach((item) => {
				track.appendChild(item.cloneNode(true));
			});
		};

		let loaded = 0;
		const total = images.length;

		if (total === 0) {
			measure();
			return;
		}

		const onLoad = () => {
			loaded++;
			if (loaded >= total) measure();
		};

		images.forEach((img) => {
			if (img.complete) {
				onLoad();
			} else {
				img.addEventListener('load', onLoad, { once: true });
				img.addEventListener('error', onLoad, { once: true });
			}
		});
	}

	async initTestimonials() {
		if (this.testimonialInitialized) {
			return;
		}

		try {
			const EmblaCarousel = await loadEmblaCarousel();
			const emblaRootEl = this.el.querySelector('.embla-instance');
			const emblaContainerEl = this.el.querySelector('.embla__container');

			if (!emblaRootEl) {
				return;
			}

			const emblaEl = emblaRootEl.querySelector('.embla');
			const paginationEl = this.el.querySelector('.embla__pagination');
			const instance = {
				embla: EmblaCarousel(emblaEl, {
					axis: isDesktopViewport() ? 'y' : 'x',
					align: 'start',
					draggable: !isDesktopViewport(),
					loop: 1,
					duration: 40
				}),
				autoplay: null
			};

			if (instance.embla) {
				instance.autoplay = new EmblaAutoplay(instance.embla, 4000);

				stopAutoplayOnHover(emblaContainerEl, instance.autoplay, 1000);
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

export default TemplateFrontPage;
