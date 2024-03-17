import Countdown from '../util/countdown';
import { getCookie } from '../util/cookie';
import { wpAPIget } from '../util/wp-rest-api';

import { loadEmblaCarousel } from '../util/load-dependencies';
import { enableNavButtons } from '../util/embla/util';
import EmblaAutoplay, { stopAutoplayOnHover } from '../util/embla/autoplay';
import EmblaPagination from '../util/embla/pagination';
import SiteEvents, { SiteEventNames } from '../util/site-events';

class ActivityPage {
	constructor(el) {
		this.el = el;
		this.emblaInitialized = false;
		this.countDownEl = this.el.querySelector('[data-role="countdown"]');

		if (this.countDownEl) {
			this.initCountdown();
		}

		this.navEls = Array.from(document.querySelectorAll('.activity-menu-link'));
		this.contentEls = [];
		this.downloadBtn = this.el.querySelector('[data-role="download"]');
		// this.moreBtn = Array.from(this.el.querySelectorAll('.more'));
		this.accountBtn = document.querySelector('[data-role="account"]');
		this.activityBtn = Array.from(document.querySelectorAll('[data-role="activity"]'));

		this.initEmbla();

		if (this.accountBtn) {
			this.fetchUser();
		}

		if (!this.navEls.length) {
			return;
		}

		// Array.from(this.el.querySelectorAll('.htap-demand__card-container')).forEach((el) => {
		// 	if(el.getAttribute('data-id') !== 'accordion_card_0'){
		// 		el.style.maxHeight = el.querySelector('.htap-demand__card').offsetHeight + 'px';
		// 	}
		// });

		// this.moreBtn.forEach((el) => {
		// 	el.addEventListener('click', (e) => {
		// 		const cardEl = this.el.querySelector(
		// 			`[data-id="accordion_card_${e.currentTarget.getAttribute('data-id')}"]`
		// 		);
		// 		const height = cardEl.querySelector('.htap-demand__card').offsetHeight;
		// 		if (e.currentTarget.classList.contains('active')) {
		// 			e.currentTarget.classList.remove('active');
		// 			cardEl.style.maxHeight = `${height}px`;
		// 		} else {
		// 			e.currentTarget.classList.add('active');
		// 			cardEl.style.maxHeight = '9999px';
		// 		}
		// 	});
		// });

		this.navEls.forEach((navEl, index) => {
			const id = navEl.getAttribute('href');
			if (!id.includes('#')) {
				return;
			}

			this.contentEls[index] = document.querySelector(id);
			navEl.addEventListener('click', (e) => {
				e.preventDefault();

				const currentId = e.currentTarget.getAttribute('href').replace('#', '');

				this.handleClick(currentId);
			});
		});
		window.addEventListener('scroll', this.handleScroll.bind(this));
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
			const btnPrevEl = Array.from(this.el.querySelectorAll('.embla__nav-button--prev'));
			const btnNextEl = Array.from(this.el.querySelectorAll('.embla__nav-button--next'));
			const paginationEl = this.el.querySelector('.embla__pagination');

			const transitionSpeed = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-transition-speed') || 10, 10)
				: 10;

			const autoplayEnabled = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-autoplay-enabled') || 1, 10)
				: false;

			const autoplaySpeed = emblaRootEl
				? parseInt(emblaRootEl.getAttribute('data-autoplay-speed') || 4000, 10)
				: 4000;

			const instance = {
				embla: EmblaCarousel(emblaEl, {
					align: "start",
					loop: autoplayEnabled,
					speed: transitionSpeed,
					containScroll: 'keepSnaps'
				}),
				pagination: null,
				autoplay: null
			};

			if (instance.embla) {
				instance.embla.on('init', () => {
					SiteEvents.publish(SiteEventNames.IMAGEBUDDY_TRIGGER_UPDATE);
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

	async fetchUser() {
		const res = await wpAPIget(
			'/htap-summit/api/me',
			{},
			{ headers: { Authorization: getCookie('csrftoken') } },
			true
		);
		if (res) {
			this.accountBtn.setAttribute('href', '/htap-summit/auth/account/');
			this.accountBtn.innerHTML = 'My Account';
			this.activityBtn.forEach((el) => {
				el.classList.add('disabled');
				el.setAttribute('href', '');
				el.innerHTML = 'Registered';
			});
			return;
		}
		this.accountBtn.setAttribute('href', '/htap-summit/auth/signup/');
		this.accountBtn.innerHTML = 'Register Now';
		this.activityBtn.forEach((el) => {
			el.classList.remove('disabled');
			el.setAttribute('href', '/htap-summit/auth/signup/');
			el.innerHTML = 'Register Now';
		});
	}

	initCountdown() {
		const endTime = this.countDownEl.getAttribute('data-end-time');
		const countdownTime = new Countdown(new Date(endTime).getTime());
		countdownTime.on('running', (time) => {
			var _days = document.querySelectorAll('.days');
			var _hours = document.querySelectorAll('.hours');
			var _minutes = document.querySelectorAll('.minutes');
			var _seconds = document.querySelectorAll('.seconds');

			this.setNumber(_days[0], Math.floor(time.days / 10), 1);
			this.setNumber(_days[1], time.days % 10, 1);

			this.setNumber(_hours[0], Math.floor(time.hours / 10), 1);
			this.setNumber(_hours[1], time.hours % 10, 1);

			this.setNumber(_minutes[0], Math.floor(time.minutes / 10), 1);
			this.setNumber(_minutes[1], time.minutes % 10, 1);

			this.setNumber(_seconds[0], Math.floor(time.seconds / 10), 1);
			this.setNumber(_seconds[1], time.seconds % 10, 1);
		});
	}

	setNumber(digit, number, on) {
		var digitSegments = [
			[1, 2, 3, 4, 5, 6],
			[2, 3],
			[1, 2, 7, 5, 4],
			[1, 2, 7, 3, 4],
			[6, 7, 2, 3],
			[1, 6, 7, 3, 4],
			[1, 6, 5, 4, 3, 7],
			[1, 2, 3],
			[1, 2, 3, 4, 5, 6, 7],
			[7, 6, 1, 2, 3, 4]
		];
		var segments = digit.querySelectorAll('.countdown-box__segment');
		var current = parseInt(digit.getAttribute('data-value'));

		// only switch if number has changed or wasn't set
		if (!isNaN(current) && current != number) {
			// unset previous number
			digitSegments[current].forEach(function (digitSegment, index) {
				setTimeout(function () {
					segments[digitSegment - 1].classList.remove('on');
				}, index * 45);
			});
		}

		if (isNaN(current) || current != number) {
			// set new number after
			setTimeout(function () {
				digitSegments[number].forEach(function (digitSegment, index) {
					setTimeout(function () {
						segments[digitSegment - 1].classList.add('on');
					}, index * 45);
				});
			}, 250);
			digit.setAttribute('data-value', number);
		}
	}

	setTabActive(id) {
		this.navEls.forEach((el) => {
			if (`#${id}` === el.getAttribute('href')) {
				el.classList.add('active');
			} else {
				el.classList.remove('active');
			}
		});
	}

	setScrollTo(id) {
		const topOffset =
			(document.querySelector('.activity-header')?.clientHeight || 0) +
			(document.querySelector('#wpadminbar')?.clientHeight || 0);

		window.scrollTo({
			top:
				document.querySelector(`#${id}`).getBoundingClientRect().top +
				window.pageYOffset -
				topOffset -
				20,
			behavior: 'smooth'
		});
	}

	handleClick(id) {
		this.setScrollTo(id);
		this.setTabActive(id);
	}

	handleScroll() {
		const activeIndex = this.getActiveElement(
			this.contentEls.map((d) => d.getBoundingClientRect())
		);

		this.setTabActive(this.contentEls[activeIndex].id);
	}
	getActiveElement(rects) {
		if (rects.length === 0) {
			return -1;
		}

		const closest = rects.reduce(
			(acc, item, index) => {
				if (Math.abs(acc.position) < Math.abs(item.y) - 100) {
					return acc;
				}

				return {
					index,
					position: item.y
				};
			},
			{ index: 0, position: rects[0].y }
		);

		return closest.index;
	}
	updateUrl(id) {
		window.history.replaceState({}, '', `#${id}`);
	}
}

export default ActivityPage;
