class AIPage {
	static MAX_TENANT = 10000;
	static MAX_AGENT = 50;
	static MAX_BRANCH = 50;
	static ANIMATION_DURATION = 400;
	static RESULT_ANIMATION_DURATION = 600;
	static STEP_DELAY = 100;
	static LOOP_DELAY = 1500;
	static INIT_DELAY = 1000;
	static SCRAMBLE_INTERVAL = 30;
	static MIN_TENANT = 100;
	static MIN_AGENT = 5;
	static MIN_BRANCH = 1;

	constructor(el) {
		if (!el) {
			console.warn('AIPage: element is required');
			return;
		}

		this.el = el;
		this.isRunning = false;
		this.animationFrameId = null;
		this.intervalId = null;

		this.elements = this.initElements();
		if (!this.elements) {
			return;
		}

		this.tabInstance = {};
		this.tabEls = Array.from(this.el.querySelectorAll('.tabs'));
		this.buttons = Array.from(this.el.querySelectorAll('.tab-btn'));
		this.panels = Array.from(this.el.querySelectorAll('.tab-panel'));
		this.initTab();

		this.initAnimation();
	}

	initElements() {
		const elements = {
			values: {
				tenant: document.getElementById('tenant-val'),
				agent: document.getElementById('agent-val'),
				branch: document.getElementById('branch-val'),
				result: document.getElementById('result-val'),
			},
			cards: {
				tenant: document.getElementById('tenant-card'),
				agent: document.getElementById('agent-card'),
				branch: document.getElementById('branch-card'),
				result: document.getElementById('result-card'),
			},
		};

		const allElements = [
			...Object.values(elements.values),
			...Object.values(elements.cards),
		];
		const missingElements = allElements.filter((el) => !el);

		if (missingElements.length > 0) {
			console.warn('AIPage: Some required elements are missing');
			return null;
		}

		return elements;
	}

	static getRandomInt(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}

	static formatNumber(num) {
		return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	}

	static delay(ms) {
		return new Promise((resolve) => setTimeout(resolve, ms));
	}

	scrambleNumber(element, targetValue, duration = AIPage.ANIMATION_DURATION) {
		return new Promise((resolve) => {
			if (!element) {
				resolve();
				return;
			}

			const startTime = Date.now();
			const targetStr = AIPage.formatNumber(targetValue);
			const length = targetStr.length;

			element.classList.add('scrambling');

			this.intervalId = setInterval(() => {
				const elapsedTime = Date.now() - startTime;
				if (elapsedTime >= duration) {
					clearInterval(this.intervalId);
					element.textContent = targetStr;
					element.setAttribute('data-target', targetValue);
					element.classList.remove('scrambling');
					resolve();
				} else {
					let randomStr = '';
					for (let i = 0; i < length; i++) {
						randomStr +=
							targetStr[i] === ','
								? ','
								: Math.floor(Math.random() * 10);
					}
					element.textContent = randomStr;
				}
			}, AIPage.SCRAMBLE_INTERVAL);
		});
	}

	setActiveCard(card) {
		const { cards } = this.elements;
		Object.values(cards).forEach((c) => c.classList.remove('active'));
		if (card) {
			card.classList.add('active');
		}
	}

	async runAnimationSequence() {
		const { values, cards } = this.elements;
		const { MAX_TENANT, MAX_AGENT, MAX_BRANCH, MIN_TENANT, MIN_AGENT, MIN_BRANCH } =
			AIPage;

		const nextTenant = AIPage.getRandomInt(MIN_TENANT, MAX_TENANT);
		const nextAgent = AIPage.getRandomInt(MIN_AGENT, MAX_AGENT);
		const nextBranch = AIPage.getRandomInt(MIN_BRANCH, MAX_BRANCH);
		const nextResult = nextTenant * nextAgent * nextBranch;

		this.setActiveCard(cards.tenant);
		await this.scrambleNumber(values.tenant, nextTenant);
		await AIPage.delay(AIPage.STEP_DELAY);

		this.setActiveCard(cards.agent);
		await this.scrambleNumber(values.agent, nextAgent);
		await AIPage.delay(AIPage.STEP_DELAY);

		this.setActiveCard(cards.branch);
		await this.scrambleNumber(values.branch, nextBranch);
		await AIPage.delay(AIPage.STEP_DELAY);

		this.setActiveCard(cards.result);
		await this.scrambleNumber(values.result, nextResult, AIPage.RESULT_ANIMATION_DURATION);

		this.setActiveCard(null);
	}

	async runSimulationLoop() {
		this.isRunning = true;
		while (this.isRunning) {
			await this.runAnimationSequence();
			await AIPage.delay(AIPage.LOOP_DELAY);
		}
	}

	initAnimation() {
		const { values } = this.elements;
		Object.values(values).forEach((el) => {
			el.textContent = AIPage.formatNumber(0);
		});

		setTimeout(() => {
			if (!this.isRunning) {
				this.runSimulationLoop();
			}
		}, AIPage.INIT_DELAY);
	}

	stop() {
		this.isRunning = false;
		if (this.intervalId) {
			clearInterval(this.intervalId);
		}
		if (this.animationFrameId) {
			cancelAnimationFrame(this.animationFrameId);
		}
	}

	initTab() {
		this.tabEls.forEach((tabEl) => {
			const instanceId = tabEl.dataset.instance;
			if (!instanceId) return;

			this.tabInstance[instanceId] = {};
			const buttons = Array.from(tabEl.querySelectorAll('.tab-btn'));

			buttons.forEach((btn) => {
				const tabId = btn.dataset.tab;
				if (!tabId) return;

				this.tabInstance[instanceId][tabId] = btn.classList.contains('active');

				btn.addEventListener('click', () => {
					this.switchTab(tabId, instanceId);
				});
			});
		});
	}

	switchTab(tabId, instanceId) {
		if (!tabId || !instanceId) return;

		this.buttons.forEach((btn) => {
			const btnInstanceId = btn.closest('.tabs')?.dataset.instance;
			if (btnInstanceId === instanceId) {
				btn.classList.toggle('active', btn.dataset.tab === tabId);
			}
		});

		this.panels.forEach((panel) => {
			const panelInstanceId = panel.closest('.tabs')?.dataset.instance;
			if (panelInstanceId === instanceId) {
				panel.classList.toggle('active', panel.id === tabId);
			}
		});

		if (typeof Prism !== 'undefined' && Prism.highlightAll) {
			Prism.highlightAll();
		}
	}
}

export default AIPage;
