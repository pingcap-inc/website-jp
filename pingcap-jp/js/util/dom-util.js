export function removeAllChildNodes(parentEl) {
	while (parentEl.firstChild) {
		parentEl.removeChild(parentEl.firstChild);
	}
}
