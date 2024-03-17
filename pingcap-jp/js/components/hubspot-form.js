import { PhoneNumberUtil } from 'google-libphonenumber';
import countriesData from '../util/countriesData';

class HubspotFrom {
	constructor(el) {
		this.el = el;

		window.addEventListener('message', (event) => {
			if (event.data.type === 'hsFormCallback' && event.data.eventName === 'onFormReady') {
				this.formEl = this.el.querySelector('form');
				this.submitBtnEl = this.el.querySelector('[type="submit"]');
				this.countryEl = this.el.querySelector('[name="country_picklist__sfdc_"]');
				this.phoneEl = this.el.querySelector('[name="phone"]');

				if (this.countryEl && this.phoneEl) {
					this.phoneUtil = PhoneNumberUtil.getInstance();
					this.countryEl.addEventListener('change', (e) => {
						this.validationPhone(this.countryEl.value, this.phoneEl.value);
					});
					this.phoneEl.addEventListener('change', (e) => {
						this.validationPhone(this.countryEl.value, this.phoneEl.value);
					});
					this.handleSubmit();
				}
			}
		});
	}

	isValidNumberForRegion(country, phone) {
		return this.phoneUtil.isValidNumberForRegion(
			this.phoneUtil.parse(phone, countriesData[country]),
			countriesData[country]
		);
	}

	validationPhone(country, phone) {
		if (!country || !phone) {
			return false;
		}

		if (!this.isValidNumberForRegion(country, phone)) {
			this.showErrorMsg();
			return false;
		}

		this.removeErrorMsg();
	}

	showErrorMsg() {
		if (this.errorMsgEl) {
			return;
		}

		const errorMsgEl = document.createElement('ul');
		errorMsgEl.setAttribute('class', 'no-list hs-error-msgs inputs-list');
		errorMsgEl.setAttribute('role', 'errorMsg');
		errorMsgEl.innerHTML =
			'<li><label class="hs-error-msg">Phone Number is invalid.</label></li>';

		this.el.querySelector('.hs-phone').appendChild(errorMsgEl);
		this.errorMsgEl = errorMsgEl;
	}

	removeErrorMsg() {
		this.errorMsgEl && this.el.querySelector('.hs-phone').removeChild(this.errorMsgEl);
		this.errorMsgEl = '';
	}

	handleSubmit() {
		this.submitBtnEl.addEventListener('click', (e) => {
			if (
				this.countryEl.value &&
				this.phoneEl.value &&
				!this.isValidNumberForRegion(this.countryEl.value, this.phoneEl.value)
			) {
				e.preventDefault();

				console.log('validation failed');
				return false;
			}
		});
	}
}

export default HubspotFrom;
