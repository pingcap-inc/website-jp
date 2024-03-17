import { getUrlQueryArg } from '../util/url-util';

class PackageDownload {
	constructor(el) {
		this.filter = {};
		this.el = el;

		this.buttonEl = this.el.querySelector('.package-download__download-button');
		this.checkboxEl = this.el.querySelector('.package-download__download-checkbox input');
		this.errorMsg = this.el.querySelector('.package-download__download-error-message');
		this.selectEls = Array.from(this.el.querySelectorAll('.package-download__filter-control'));

		if (this.selectEls.length) {
			const selectEls = this.selectEls.find(
				(el) => el.getAttribute('data-role') === 'version'
			);
			const optionsEls = selectEls.querySelectorAll('option');
			selectEls.value = getUrlQueryArg('version', optionsEls[0].value);

			this.selectEls.forEach((el) => {
				this.filter[el.getAttribute('data-role')] = el.value;
				el.addEventListener('change', (e) => {
					if (el.getAttribute('data-role') === 'version') {
						this.renderTypeOptions(e.currentTarget.value);
					}
					this.handleFilter(el.getAttribute('data-role'), e.currentTarget.value);
				});
			});

			this.checkboxEl.addEventListener('change', () => {
				if (this.checkboxEl.checked) {
					this.errorMsg.classList.add('hide');
				} else {
					this.errorMsg.classList.remove('hide');
				}
			});

			this.buttonEl.addEventListener('click', () => {
				this.handleDownload();
			});
		}
	}

	renderTypeOptions(version) {
		const selectEls = this.selectEls.find((el) => el.getAttribute('data-role') === 'type');
		const optionsEls = selectEls.querySelectorAll('option');
		optionsEls.forEach((el) => {
			if (version < 'v6.1.0' && el.value == 'arm64') {
				el.style.display = 'none';
			} else {
				el.style.display = 'block';
			}
		});
		selectEls.value = optionsEls[0].value;
		this.filter['type'] = optionsEls[0].value;
	}

	handleFilter(name, value) {
		this.filter[name] = value;
	}

	handleDownload() {
		if (!this.checkboxEl.checked) {
			this.errorMsg.classList.remove('hide');
			return;
		}

		const link = document.createElement('a');
		const fileName = `${this.filter.package}-${this.filter.version}-linux-${this.filter.type}`;
		link.download = fileName;
		link.href = `https://download.pingcap.org/${fileName}.tar.gz`;
		window.gtag &&
			window.gtag({
				event: 'product_download',
				tidb_download_version: `${fileName}.tar.gz`
			});
		link.click();
	}
}

export default PackageDownload;
