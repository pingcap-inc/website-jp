import { gsap } from 'gsap';
import Typewriter from 'typewriter-effect/dist/core';

class AIPage {
	constructor(el) {
		this.el = el;

		this.tabNavEls = Array.from(this.el.querySelectorAll('.develop__tabs-tab'));
		this.tabContentEls = Array.from(this.el.querySelectorAll('.develop__tabs-content'));

		this.initSQLTypewriter();
		this.initDevelopTabs();
	}

	initSQLTypewriter() {
		const result3Lines = [
			'+-----------------------+---------------------+',
			'|&nbsp;embedding&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;d&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|',
			'+-----------------------+---------------------+',
			'| <span style="color: #D98026;">[1.6,5.3,3.9,4.9,3.4]</span> | <span style="color: #D98026;">0.09597214606787163</span> |',
			'| <span style="color: #D98026;">[5.3,6.2,4.7,9.4,3.2]</span> | <span style="color: #D98026;">0.15841034048519986</span> |',
			'| <span style="color: #D98026;">[4.6,6.2,2.9,5.5,2.4]</span> | <span style="color: #D98026;">0.21071371150541895</span> |',
			'| <span style="color: #D98026;">[7.4,8.3,3.6,9.5,1.5]</span> | <span style="color: #D98026;">0.28466052143741205</span> |',
			'| <span style="color: #D98026;">[8.2,2.7,5.9,4.5,1.1]</span> | <span style="color: #D98026;">0.35390651635892556</span> |',
			'+-----------------------+---------------------+',
			'<span style="color: #D98026;">5</span> <span style="color: #25AFF4;">rows in set</span> (<span style="color: #D98026;">0.02</span> sec)'
		];
		const typewriter = new Typewriter('#typewriter');
		typewriter
			.changeDelay(5)
			.typeString(
				'mysql> <span style="color: #25AFF4;">CREATE TABLE</span> vector_table(embedding VECTOR);<br />'
			)
			.pauseFor(50)
			.changeDelay(1)
			.pasteString(
				'Query OK, <span style="color: #D98026;">0</span> <span style="color: #25AFF4;">rows</span> affected (<span style="color: #D98026;">0.05</span> sec)<br /><br />',
				null
			)
			.changeDelay(5)
			.typeString(
				'mysql> <span style="color: #25AFF4;">INSERT INTO</span> vector_table <span style="color: #25AFF4;">VALUES</span><br />'
			)
			.typeString(
				`&nbsp;&nbsp;&nbsp;&nbsp;-> (<span style="color: #6CC;">'[5.3, 6.2, 4.7, 9.4, 3.2]'</span>),<br />`
			)
			.typeString(
				`&nbsp;&nbsp;&nbsp;&nbsp;-> (<span style="color: #6CC;">'[7.4, 8.3, 3.6, 9.5, 1.5]'</span>),<br />`
			)
			.typeString(
				`&nbsp;&nbsp;&nbsp;&nbsp;-> (<span style="color: #6CC;">'[1.6, 5.3, 3.9, 4.9, 3.4]'</span>),<br />`
			)
			.typeString(
				`&nbsp;&nbsp;&nbsp;&nbsp;-> (<span style="color: #6CC;">'[4.6, 6.2, 2.9, 5.5, 2.4]'</span>),<br />`
			)
			.typeString(
				`&nbsp;&nbsp;&nbsp;&nbsp;-> (<span style="color: #6CC;">'[8.2, 2.7, 5.9, 4.5, 1.1]'</span>);<br />`
			)
			.pauseFor(20)
			.pasteString(
				'Query OK, <span style="color: #D98026;">5</span> <span style="color: #25AFF4;">rows</span> affected (<span style="color: #D98026;">0.02</span> sec)<br />',
				null
			)
			.pasteString(
				'Records: <span style="color: #D98026;">5</span> Duplicates: <span style="color: #D98026;">0</span> Warnings: <span style="color: #D98026;">0</span><br /><br />',
				null
			)
			.typeString('mysql> <span style="color: #25AFF4;">SELECT</span><br />')
			.typeString(`&nbsp;&nbsp;&nbsp;&nbsp;-> embedding,<br />`)
			.typeString(
				`&nbsp;&nbsp;&nbsp;&nbsp;-> VEC_Cosine_Distance(embedding, <span style="color: #6CC;">'[1,2,3,4,5]'</span>) <span style="color: #25AFF4;">AS</span> d<br />`
			)
			.typeString(
				'&nbsp;&nbsp;&nbsp;&nbsp;-> <span style="color: #25AFF4;">FROM</span> vector_table<br />'
			)
			.typeString(
				'&nbsp;&nbsp;&nbsp;&nbsp;-> <span style="color: #25AFF4;">ORDER BY</span> d;<br />'
			)
			.pauseFor(20)
			.pasteString(result3Lines.join('<br />'), null)
			.start();
	}

	initDevelopTabs() {
		let autoSwitchInterval;
		let autoSwitchDelay = 4000;
		let currentTabContentEl = null;

		const showTab = (tabNavEl) => {
			const tabId = tabNavEl.getAttribute('data-tab');
			const newTabContentEl = document.querySelector(`#${tabId}`);
			if (newTabContentEl === currentTabContentEl) {
				return;
			}
			this.tabNavEls.forEach((btn) => btn.classList.remove('active'));
			tabNavEl.classList.add('active');

			this.tabContentEls.forEach((tabContentEl) => {
				if (tabContentEl === newTabContentEl) {
					gsap.fromTo(tabContentEl, { opacity: 0 }, { duration: 0.6, opacity: 1 });
				}
			});

			newTabContentEl.classList.add('active');
			currentTabContentEl && currentTabContentEl.classList.remove('active');
			currentTabContentEl = newTabContentEl;
		};

		const startAutoSwitch = () => {
			stopAutoSwitch();
			autoSwitchInterval = setInterval(() => {
				let activeTab = this.el.querySelector('.develop__tabs-tab.active');
				let nextTab = activeTab.nextElementSibling;

				if (!nextTab) {
					nextTab = this.tabNavEls[0];
				}

				showTab(nextTab);
			}, autoSwitchDelay);
		};

		const stopAutoSwitch = () => {
			clearInterval(autoSwitchInterval);
		};

		this.tabNavEls.forEach((tabNavEl) => {
			tabNavEl.addEventListener('mouseover', () => {
				stopAutoSwitch();
				showTab(tabNavEl);
			});
			tabNavEl.addEventListener('mouseout', () => {
				startAutoSwitch();
			});
		});

		this.tabContentEls.forEach((tabContentEl) => {
			tabContentEl.addEventListener('mouseover', () => {
				stopAutoSwitch();
			});
			tabContentEl.addEventListener('mouseout', () => {
				startAutoSwitch();
			});
		});

		showTab(this.tabNavEls[0]);
		startAutoSwitch();
	}
}

export default AIPage;
