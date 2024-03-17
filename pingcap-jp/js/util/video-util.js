class VideoUtil {
	constructor() {
		this.videoEl = document.createElement('video');
	}

	canPlayWebM() {
		const canPlay = this.videoEl.canPlayType('video/webm; codecs="vp9"');

		if (!canPlay.trim()) {
			return false;
		}

		return true;
	}
}

export default new VideoUtil();
