import { isDesktopViewport, whenAboveDesktop, whenBelowDesktop } from '../util/viewport';
import SiteEvents, { SiteEventNames } from '../util/site-events';
// import videoUtil from '../util/video-util';

class BannerDefaultVideo {
	constructor(el) {
		this.el = el;
		this.imageContainerEl = this.el.querySelector('.banner-default__image-container');
		this.tmplSideImage = this.el.querySelector('.banner-default__tmpl-side-image');
		this.tmplSideImageVideo = this.el.querySelector('.banner-default__tmpl-side-image-video');
		this.loadedMobileAssets = false;
		this.loadedDesktopAssets = false;

		if (!this.el.classList.contains('banner-default--has-video')) {
			return;
		}

		// if (!videoUtil.canPlayWebM()) {
		// 	this.loadMobileAssets();

		// 	this.el.classList.remove('banner-default--has-video');

		// 	return;
		// }

		// if (isDesktopViewport()) {
		// 	this.loadDesktopAssets();

		// 	whenBelowDesktop(() => {
		// 		this.loadMobileAssets();
		// 	});
		// } else {
		// 	this.loadMobileAssets();

		// 	whenAboveDesktop(() => {
		// 		this.loadDesktopAssets();
		// 	});
		// }

		this.loadDesktopAssets();
	}

	appendTemplateElement(tmplEl) {
		if (!tmplEl) {
			return;
		}

		const tmplClone = tmplEl.content.cloneNode(true);

		this.imageContainerEl.appendChild(tmplClone);
	}

	loadMobileAssets() {
		if (this.loadedMobileAssets) {
			return;
		}

		this.appendTemplateElement(this.tmplSideImage);

		// Set a timeout of 0 so that this action is pushed to the next frame.
		// If this timeout isn't used the markup will not have been added to the
		// DOM before the ImageBuddy update is triggered.
		setTimeout(() => {
			SiteEvents.publish(SiteEventNames.LAZYLOAD_TRIGGER_UPDATE);
		}, 0);

		this.loadedMobileAssets = true;
	}

	loadDesktopAssets() {
		if (this.loadedDesktopAssets) {
			return;
		}

		this.appendTemplateElement(this.tmplSideImageVideo);

		this.loadedDesktopAssets = true;

		// force the video to play after it has been added to the DOM
		setTimeout(() => {
			const videoEl = this.imageContainerEl.querySelector('.banner-default__image-video');

			if (videoEl) {
				videoEl.play();
			}
		}, 0);
	}
}

export default BannerDefaultVideo;
