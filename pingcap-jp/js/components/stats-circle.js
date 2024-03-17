class StatsCircle {
	constructor(el) {
		this.el = el;
		this.counterValueEl = this.el.querySelector('.stats-circle__counter-value');
		this.animate = this.counterValueEl.classList.contains('stats-circle--animate');
		this.interval = parseInt(this.counterValueEl.getAttribute('data-interval') || '1', 10);
		this.delay = parseInt(this.counterValueEl.getAttribute('data-delay') || '50', 10);
		this.endNum = parseInt(this.counterValueEl.getAttribute('data-number-end') || '1', 10);
		this.numberFormatter = new Intl.NumberFormat('en-US');
	}

	runCounter() {
		if (!this.counterValueEl) {
			return;
		}

		const currentNum = parseInt(
			this.counterValueEl.getAttribute('data-number-current') || '1',
			10
		);

		if (currentNum >= this.endNum) {
			return;
		}

		setTimeout(() => {
			requestAnimationFrame(() => {
				let newNumber = currentNum + this.interval;

				if (newNumber > this.endNum) {
					newNumber = this.endNum;
				}

				this.counterValueEl.textContent = this.numberFormatter.format(newNumber);
				this.counterValueEl.setAttribute('data-number-current', newNumber);

				this.runCounter();
			});
		}, this.delay);
	}
}

export default StatsCircle;
