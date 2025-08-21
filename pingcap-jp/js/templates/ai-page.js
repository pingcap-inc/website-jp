class AIPage {
	constructor(el) {
		this.el = el;

		this.tabInstance = {};
		this.tabEls = Array.from(this.el.querySelectorAll('.tabs'));
		this.buttons = Array.from(this.el.querySelectorAll('.tab-btn'));
		this.panels = Array.from(this.el.querySelectorAll('.tab-panel'));

		this.initTab();
	}

	initTab() {
		this.tabEls.forEach((tabEl) => {
			this.tabInstance[tabEl.dataset.instance] = {};
			const buttons = Array.from(tabEl.querySelectorAll('.tab-btn'));
			buttons.forEach((btn) => {
				this.tabInstance[tabEl.dataset.instance][btn.dataset.tab] = Boolean(
					btn.classList.contains('active')
				);
				btn.addEventListener('click', () => {
					this.switchTab(btn.dataset.tab, tabEl.dataset.instance);
				});
			});
		});
		console.log(this.tabInstance);
	}

	switchTab(tabId, instanceId) {
		this.buttons.forEach((btn) => {
			if (btn.parentElement.parentElement.dataset.instance !== instanceId) {
				return;
			}
			btn.classList.toggle('active', btn.dataset.tab === tabId);
		});

		this.panels.forEach((panel) => {
			if (panel.parentElement.parentElement.dataset.instance !== instanceId) {
				return;
			}
			panel.classList.toggle('active', panel.id === tabId);
			Prism && Prism.highlightAll();
		});
	}
}

export default AIPage;