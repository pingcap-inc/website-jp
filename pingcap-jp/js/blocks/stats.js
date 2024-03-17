import StatsCircle from '../components/stats-circle';

class BlockStats {
	constructor(el) {
		this.el = el;
		this.blockInnerEl = this.el.querySelector('.block-inner');
		this.isCarousel =
			this.blockInnerEl && this.blockInnerEl.classList.contains('block-inner--carousel');

		this.animateStatsCircles = Array.from(
			this.el.querySelectorAll('.stats-circle--animate')
		).map((statsCircleEl) => new StatsCircle(statsCircleEl));

		if (!this.isCarousel) {
			this.createObserver();
		}
	}

	createObserver() {
		if (!this.animateStatsCircles.length) {
			return;
		}

		let vpThreshold = 0.5;

		if (window.innerWidth < 1025) {
			// medium threshold
			vpThreshold = 0.25;
		} else if (window.innerWidth < 641) {
			// small threshold
			vpThreshold = 0.15;
		}

		const observer = new IntersectionObserver(
			(observerEntries) => {
				const targetEntry = observerEntries[0] || null;

				if (!targetEntry) {
					observer.disconnect();
					return;
				}

				if (targetEntry.intersectionRatio > 0) {
					observer.disconnect();

					this.animateStatsCircles.forEach((statsCircleEl) => statsCircleEl.runCounter());
				}
			},
			{
				threshold: vpThreshold
			}
		);

		observer.observe(this.el);
	}
}

export default BlockStats;
