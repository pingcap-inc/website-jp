import Modal from '../components/modal';
import { getVideoEmbedURL } from './video-url';

/**
 * Show a video modal with the specified video URL
 *
 * @param {string} videoUrl The video URL
 */
export function showVideoModal(videoUrl) {
	if (!videoUrl) {
		return;
	}

	const embedUrl = getVideoEmbedURL(videoUrl);

	Modal.show('', {
		modalClass: 'modal modal-video'
	});

	const isDirectURL = embedUrl.toLowerCase().indexOf('.mp4') !== -1;

	const templateMarkup = `
		<div class="modal__video-container">
			${
				isDirectURL
					? `
				<video class="modal__video-embed" src="${embedUrl}" controls autoplay></video>
			`
					: `
				<iframe class="modal__video-embed"
					src="${embedUrl}"
					width="640"
					height="360"
					frameborder="0"
					allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
					allowfullscreen>
				</iframe>
			`
			}
		</div>
	`;

	// set the content to begin the iframe load but do not remove the loading animation
	Modal.setContent(templateMarkup, false);

	const iframeEl = document.querySelector('.modal__video-embed');

	// wait for the 'load' event to fire before removing the loading animation
	iframeEl.addEventListener(isDirectURL ? 'loadeddata' : 'load', () => {
		Modal.setLoading(false);
	});
}

export function showFormModal(el) {
	const formId = el.getAttribute('data-form-id');
	const sfdcCampaignId = el.getAttribute('data-sdfc-campaign-id');
	const portalId = el.getAttribute('data-portal-id') || '4466002';
	const region = el.getAttribute('data-region') || 'na1';

	if (!formId && !portalId) {
		return;
	}

	Modal.show('', {
		modalClass: 'modal modal-form',
		closeDuration: 0
	});

	Modal.setContent('<div class="modal__form-container"></div>');

	hbspt.forms.create({
		portalId,
		formId,
		region,
		sfdcCampaignId,
		target: '.modal-form .modal__form-container',
		onFormReady: function () {
			Modal.setLoading(false);
		},
		onFormSubmitted: function () {
			const content = document.querySelector('.modal__content-container');
			if (content) {
				content.scrollTo({ top: 0, behavior: 'smooth' });
			}
		}
	});
}

export function showTiUDSummaryModal(el) {
	const tmpl = el.querySelector('.card').outerHTML;

	Modal.show(tmpl, {
		modalClass: 'modal modal-tiud-agenda',
		closeDuration: 0
	});
}
