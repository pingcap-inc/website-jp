function getLanguageFromClassname(el) {
	const classAttr = el.getAttribute('class');

	if (!classAttr) {
		return '';
	}

	let retLangName = '';
	const elClasses = classAttr.split(' ');

	elClasses.forEach((elClass) => {
		const classNameLower = elClass.toLowerCase();

		if (classNameLower.indexOf('language-') !== -1) {
			let langName = classNameLower.replace('language-', '');

			// alias for prism language file name
			if (langName === 'shell') {
				langName = 'bash';
			}

			retLangName = langName;
		}
	});

	return retLangName;
}

export function getRequestedLanguages(codeEls) {
	return codeEls.reduce((acum, el) => {
		const langName = getLanguageFromClassname(el);

		if (!langName) {
			return acum;
		}

		if (acum.indexOf(langName) === -1) {
			acum.push(langName);
		}

		return acum;
	}, []);
}

export function getPrismAssetBase() {
	const base = window?.siteConfig?.prism?.assetBase ?? '/wp-content/themes/pingcap/prism-js';

	return typeof base === 'string' ? base : '';
}

export function getPrismAvailablePlugins() {
	const plugins = window?.siteConfig?.prism?.availablePlugins ?? [];

	return Array.isArray(plugins) ? plugins : [];
}

export function getPrismAvailableLanguages() {
	const langs = window?.siteConfig?.prism?.availableLanguages ?? [];

	return Array.isArray(langs) ? langs : [];
}

export function getPrismAvailableThemes() {
	const themes = window?.siteConfig?.prism?.availableThemes ?? [];

	return Array.isArray(themes) ? themes : [];
}

export async function loadPlugin(plugin) {
	return new Promise((resolve, reject) => {
		const assetBase = getPrismAssetBase();
		const availablePlugins = getPrismAvailablePlugins();

		if (availablePlugins.indexOf(plugin) === -1) {
			reject(new Error(`Prism plugin '${plugin}' is not available`));
			return;
		}

		const scriptEl = document.createElement('script');

		scriptEl.setAttribute('src', `${assetBase}/plugins/prism-${plugin}.min.js`);

		scriptEl.addEventListener('load', () => {
			resolve(true);
		});

		scriptEl.addEventListener('error', (err) => {
			reject(err);
		});

		document.querySelector('body').appendChild(scriptEl);
	});
}

export async function loadLanguage(lang) {
	return new Promise((resolve, reject) => {
		const assetBase = getPrismAssetBase();
		const availableLangs = getPrismAvailableLanguages();

		if (availableLangs.indexOf(lang) === -1) {
			reject(new Error(`Prism language '${lang}' is not available`));
			return;
		}

		const scriptEl = document.createElement('script');

		scriptEl.setAttribute('src', `${assetBase}/languages/prism-${lang}.min.js`);

		scriptEl.addEventListener('load', () => {
			resolve(true);
		});

		scriptEl.addEventListener('error', (err) => {
			reject(err);
		});

		document.querySelector('body').appendChild(scriptEl);
	});
}

export async function loadTheme(theme) {
	return new Promise((resolve, reject) => {
		const assetBase = getPrismAssetBase();
		const availableThemes = getPrismAvailableThemes();

		if (!availableThemes.length) {
			reject(new Error('No Prism themes are available'));
			return;
		}

		if (availableThemes.indexOf(theme) === -1) {
			console.error(`Prism theme '${theme}' is not available`);

			// set default theme
			theme = availableThemes[0];
		}

		const themeLinkEl = document.createElement('link');
		themeLinkEl.setAttribute('rel', 'stylesheet');
		themeLinkEl.setAttribute('type', 'text/css');
		themeLinkEl.setAttribute('href', `${assetBase}/themes/${theme}.min.css`);

		themeLinkEl.addEventListener('load', () => {
			resolve(true);
		});

		themeLinkEl.addEventListener('error', (err) => {
			reject(err);
		});

		document.querySelector('head').appendChild(themeLinkEl);
	});
}

export function autodetectCodeElLanguage(codeEl, Prism) {
	const parentEl = codeEl.parentElement;

	if (!parentEl || parentEl.nodeName.toLowerCase() !== 'pre') {
		return;
	}

	const manualLang = getLanguageFromClassname(codeEl);

	if (manualLang) {
		return;
	}

	let autoLang = Prism.util.getLanguage(codeEl);

	if (!autoLang || autoLang === 'none') {
		autoLang = 'shell';
	}

	codeEl.classList.add(`language-${autoLang}`);
	parentEl.classList.add(`language-${autoLang}`);
}
