/**
 * Returns the loaded dependency object by name or null if no dependency has
 * been loaded
 *
 * @param {string} depName The dependency name
 * @returns Object|null
 */
function getLoadedDependency(depName) {
	if (typeof window.appDependencies === 'undefined') {
		window.appDependencies = {};
	}

	if (Object.keys(window.appDependencies).indexOf(depName) === -1) {
		return null;
	}

	return window.appDependencies[depName];
}

/**
 * Set a loaded dependency object by name
 *
 * @param {string} depName The dependency name
 * @param {Object} loadedObject The dependency object
 */
function setLoadedDependency(depName, loadedObject) {
	if (typeof window.appDependencies === 'undefined') {
		window.appDependencies = {};
	}

	window.appDependencies[depName] = loadedObject;
}

/**
 * Load the Embla Carousel library. Returns a promise with the library object
 * when successful.
 *
 * @returns {Promise<object>}
 */
export function loadEmblaCarousel() {
	return new Promise((resolve, reject) => {
		if (typeof window.EmblaCarousel !== 'undefined') {
			resolve(window.EmblaCarousel);
		}

		const existingInstance = getLoadedDependency('embla-carousel');

		if (existingInstance) {
			resolve(existingInstance);
		}

		import(/* webpackChunkName: "embla-carousel" */ 'embla-carousel')
			.then((Embla) => {
				setLoadedDependency('embla-carousel', Embla.default);
				resolve(Embla.default);
			})
			.catch((err) => {
				reject(err);
			});
	});
}

/**
 * Load the PrismJS library. Returns a promise with the library object
 * when successful.
 *
 * @returns {Promise<object>}
 */
export function loadPrismJS() {
	return new Promise((resolve, reject) => {
		if (typeof window.Prism !== 'undefined') {
			resolve(window.Prism);
		}

		const existingInstance = getLoadedDependency('prismjs');

		if (existingInstance) {
			resolve(existingInstance);
		}

		import(/* webpackChunkName: "prismjs" */ 'prismjs')
			.then((Prism) => {
				setLoadedDependency('prismjs', Prism.default);
				resolve(Prism.default);
			})
			.catch((err) => {
				reject(err);
			});
	});
}
