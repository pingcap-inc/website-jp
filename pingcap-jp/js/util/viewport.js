export function getTabletBreakpoint() {
	return parseInt(getComputedStyle(document.documentElement).getPropertyValue('--bp-medium'), 10);
}

export function getDesktopBreakpoint() {
	return parseInt(getComputedStyle(document.documentElement).getPropertyValue('--bp-large'), 10);
}

export function isMobileViewport() {
	return window.innerWidth < getTabletBreakpoint();
}

export function isTabletViewport() {
	return window.innerWidth >= getTabletBreakpoint() && window.innerWidth < getDesktopBreakpoint();
}

export function isDesktopViewport() {
	return window.innerWidth >= getDesktopBreakpoint();
}

export function createRootResizeObserver(cbFunc, compareFunc) {
	const resizeObserver = new ResizeObserver((entries) => {
		if (!entries[0]) {
			return;
		}

		if (compareFunc(entries[0].contentRect.width)) {
			resizeObserver.unobserve(document.documentElement);

			cbFunc();
		}
	});

	resizeObserver.observe(document.documentElement);
}

export function whenBelowDesktop(cbFunc) {
	const desktopWidth = getDesktopBreakpoint();

	createRootResizeObserver(cbFunc, (width) => width < desktopWidth);
}

export function whenAboveDesktop(cbFunc) {
	const desktopWidth = getDesktopBreakpoint();

	createRootResizeObserver(cbFunc, (width) => width >= desktopWidth);
}
