function readSlideHeights(embla) {
	return embla.slideNodes().map((slideNode) => slideNode.getBoundingClientRect().height);
}

function adaptContainerToSlide(embla, slideHeights) {
	const currentSlideHeight = slideHeights[embla.selectedScrollSnap()];

	embla.containerNode().style.height = `${currentSlideHeight}px`;
}

export function useAdaptiveSlideHeights(embla) {
	let slideHeights = [];

	const storeSlideHeights = () => {
		slideHeights = readSlideHeights(embla);
	};

	const setContainerHeight = () => {
		adaptContainerToSlide(embla, slideHeights);
	};

	embla.on('init', storeSlideHeights);
	embla.on('init', setContainerHeight);
	embla.on('resize', storeSlideHeights);
	embla.on('resize', setContainerHeight);
	embla.on('select', setContainerHeight);
}
