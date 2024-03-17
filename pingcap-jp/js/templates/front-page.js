import { isDesktopViewport, whenAboveDesktop, whenBelowDesktop } from '../util/viewport';
import VideoUtil from '../util/video-util';

class TemplateFrontPage {
	constructor(el) {
		this.el = el;
		this.sectionEls = Array.from(this.el.querySelectorAll('.tmpl-front-page__section'));
		this.videoButtonEl = this.el.querySelector('.play-video-overlay');
		this.videoEl = this.el.querySelector('video');

		this.videoButtonEl.addEventListener('click', ()=> {
			this.el.querySelector('.banner-home__video-image').classList.add('hide');
			this.videoEl.play();

		});
	}

	loadMobileAssets() {
		if (this.mobileAssetsLoaded) {
			return;
		}

		const assets = [
			{
				type: 'video',
				sources: [
					{
						filename: 'home-banner.mov',
						type: 'video/mp4; codecs="hvc1"'
					},
					{
						filename: 'home-banner.webm',
						type: 'video/webm'
					}
				],
				loop: true,
				modifierClass: 'banner-video'
			}
		];

		assets.forEach((assetInfo, index) => {
			const assetType = assetInfo.type ?? '';
			const assetFile = assetInfo.filename ?? '';

			if (!assetType) {
				return;
			}

			let assetEl = null;

			switch (assetType) {
				case 'video':
					assetEl = document.createElement('video');
					assetEl.type = assetInfo.videoType ?? 'video/webm';
					assetEl.autoplay = assetInfo.autoplay ?? true;
					assetEl.muted = true;
					assetEl.loop = assetInfo.loop ?? true;

					if (Array.isArray(assetInfo.sources)) {
						assetInfo.sources.forEach((source) => {
							const sourceEl = document.createElement('source');
							sourceEl.src = this.assetUrlBase + (source.filename ?? '');
							sourceEl.type = source.type ?? '';

							assetEl.appendChild(sourceEl);
						});
					} else {
						assetEl.src = this.assetUrlBase + assetFile;
					}

					break;

				default:
					console.error(`invalid asset type specified: ${assetType}`);
					break;
			}

			if (assetEl) {
				const assetClasses = [
					'tmpl-front-page__transition-item',
					`tmpl-front-page__transition-item--${index}`
				];

				if (assetInfo.modifierClass) {
					assetClasses.push(
						`tmpl-front-page__transition-item--${assetInfo.modifierClass}`
					);
				}

				assetEl.setAttribute('playsinline', true);
				assetEl.setAttribute('class', assetClasses.join(' '));

				this.transitionItemsMobileEl.appendChild(assetEl);
			}
		});

		this.mobileAssetsLoaded = true;

		// force the videos to play after they have been added to the DOM
		setTimeout(() => {
			const videoEls = Array.from(this.animationContainerEl.querySelectorAll('video'));

			videoEls.forEach((videoEl) => videoEl.play());
		}, 0);
	}

	loadDesktopAssets() {
		if (this.desktopAssetsLoaded) {
			return;
		}

		const assets = [
			{
				type: 'video',
				// filename: 'home-banner.webm',
				sources: [
					{
						filename: 'home-banner.mov',
						type: 'video/mp4; codecs="hvc1"'
					},
					{
						filename: 'home-banner.webm',
						type: 'video/webm'
					}
				],
				loop: true,
				modifierClass: 'banner-video'
			},
			{
				type: 'image',
				filename: 'home-person.png',
				modifierClass: 'image-scale'
			},
			{
				type: 'image',
				filename: 'home-graphs.png',
				modifierClass: 'image-scale'
			},
			{
				type: 'image',
				filename: 'home-blocks.png',
				modifierClass: 'image-scale'
			},
			{
				type: 'video',
				// filename: 'home-last-section.webm',
				sources: [
					{
						filename: 'home-last-section.mov',
						type: 'video/mp4; codecs="hvc1"'
					},
					{
						filename: 'home-last-section.webm',
						type: 'video/webm'
					}
				],
				loop: false,
				autoplay: false,
				modifierClass: 'last-video-transform'
			}
		];

		assets.forEach((assetInfo, index) => {
			const assetType = assetInfo.type ?? '';
			const assetFile = assetInfo.filename ?? '';

			if (!assetType) {
				return;
			}

			let assetEl = null;

			switch (assetType) {
				case 'image':
					assetEl = document.createElement('img');
					assetEl.src = this.assetUrlBase + assetFile;
					assetEl.alt = `animation transition item ${index}`;
					break;

				case 'video':
					assetEl = document.createElement('video');
					assetEl.type = assetInfo.videoType ?? 'video/webm';
					assetEl.autoplay = assetInfo.autoplay ?? true;
					assetEl.muted = true;
					assetEl.loop = assetInfo.loop ?? true;

					if (Array.isArray(assetInfo.sources)) {
						assetInfo.sources.forEach((source) => {
							const sourceEl = document.createElement('source');
							sourceEl.src = this.assetUrlBase + (source.filename ?? '');
							sourceEl.type = source.type ?? '';

							assetEl.appendChild(sourceEl);
						});
					} else {
						assetEl.src = this.assetUrlBase + assetFile;
					}

					break;

				default:
					console.error(`invalid asset type specified: ${assetType}`);
					break;
			}

			if (assetEl) {
				const assetClasses = [
					'tmpl-front-page__transition-item',
					`tmpl-front-page__transition-item--${index}`
				];

				if (assetInfo.modifierClass) {
					assetClasses.push(
						`tmpl-front-page__transition-item--${assetInfo.modifierClass}`
					);
				}

				assetEl.setAttribute('class', assetClasses.join(' '));

				this.transitionItemsDesktopEl.appendChild(assetEl);
			}
		});

		this.desktopAssetsLoaded = true;

		// force the videos to play after they have been added to the DOM
		setTimeout(() => {
			const videoEls = Array.from(this.animationContainerEl.querySelectorAll('video'));

			videoEls.forEach((videoEl) => videoEl.play());
		}, 0);
	}

	createObservers() {
		if (this.observersCreated || !this.animationContainerEl) {
			return;
		}

		// section observers
		this.sectionEls.forEach((sectionEl, index) => {
			const sectionIndex = index + 1;

			const observer = new IntersectionObserver(
				(observerEntries) => {
					const targetEntry = observerEntries[0] || null;

					if (targetEntry.isIntersecting) {
						const curSectionIndex = parseInt(
							this.animationContainerEl.getAttribute('data-section') ?? '-1',
							10
						);

						if (curSectionIndex === sectionIndex) {
							return;
						}

						this.animationContainerEl.setAttribute('data-section', sectionIndex);

						const transitionEl = this.el.querySelector(
							`.tmpl-front-page__transition-item--${sectionIndex}`
						);

						if (transitionEl) {
							const tagName = transitionEl?.tagName?.toLowerCase() ?? '';

							if (tagName === 'video' && transitionEl.readyState === 4) {
								transitionEl.pause();
								transitionEl.currentTime = 0;
								transitionEl.play();
							}
						}
					}
				},
				{
					threshold: 1,
					rootMargin: '-15% 0px -15% 0px'
				}
			);

			observer.observe(sectionEl);
		});

		// banner observer
		const bannerObserver = new IntersectionObserver(
			(observerEntries) => {
				const targetEntry = observerEntries[0] || null;

				if (targetEntry.isIntersecting) {
					this.animationContainerEl.setAttribute('data-section', '0');
				}
			},
			{
				threshold: 1
			}
		);

		bannerObserver.observe(this.el.querySelector('.banner'));

		// set observersCreated flag
		this.observersCreated = true;
	}
}

export default TemplateFrontPage;
