import Emitter from '../util/emitter';

export const CountdownStatus = {
	running: 'running',
	stoped: 'stoped'
};

export const CountdownEventName = {
    START: 'start',
    STOP: 'stop',
    RUNNING: 'running',
}

export function fillZero(num) {
    return `0${num}`.slice(-2);
}

export default class Countdown extends Emitter {
	static COUNT_IN_MILLISECOND = 1 * 100;
	static SECOND_IN_MILLISECOND = 10 * Countdown.COUNT_IN_MILLISECOND;
	static MINUTE_IN_MILLISECOND = 60 * Countdown.SECOND_IN_MILLISECOND;
	static HOUR_IN_MILLISECOND = 60 * Countdown.MINUTE_IN_MILLISECOND;
	static DAY_IN_MILLISECOND = 24 * Countdown.HOUR_IN_MILLISECOND;

	// private endTime: number;
	remainTime = 0;
	status = CountdownStatus.stoped;
	// private step: number;

	constructor(endTime, step = 1e3) {
		super();

		this.endTime = endTime;
		this.step = step;
		console.log(this.endTime);
		this.start();
	}

	start() {
		this.emit(CountdownEventName.START);

		this.status = CountdownStatus.running;
		this.countdown();
	}

	stop() {
		this.emit(CountdownEventName.STOP);

		this.status = CountdownStatus.stoped;
	}

	countdown() {
		if (this.status !== CountdownStatus.running) {
			return;
		}

		this.remainTime = Math.max(this.endTime - Date.now(), 0);

		this.emit(CountdownEventName.RUNNING, this.parseRemainTime(this.remainTime), this.remainTime);


		if (this.remainTime > 0) {
			setTimeout(() => this.countdown(), this.step);
		} else {
			this.stop();
		}
	}

	parseRemainTime(remainTime) {
		let time = remainTime;

		const days = Math.floor(time / Countdown.DAY_IN_MILLISECOND);
		time = time % Countdown.DAY_IN_MILLISECOND;

		const hours = Math.floor(time / Countdown.HOUR_IN_MILLISECOND);
		time = time % Countdown.HOUR_IN_MILLISECOND;

		const minutes = Math.floor(time / Countdown.MINUTE_IN_MILLISECOND);
		time = time % Countdown.MINUTE_IN_MILLISECOND;

		const seconds = Math.floor(time / Countdown.SECOND_IN_MILLISECOND);
		time = time % Countdown.SECOND_IN_MILLISECOND;

		const count = Math.floor(time / Countdown.COUNT_IN_MILLISECOND);

		return {
			days,
			hours,
			minutes,
			seconds,
			count
		};
	}
}
