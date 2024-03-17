import App from './App';
import '../css/master.scss';
import '../css/editor-styles.scss';
import '../css/phosphor-icons.scss';

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', () => {
		window.app = new App();
	});
} else {
	window.app = new App();
}
