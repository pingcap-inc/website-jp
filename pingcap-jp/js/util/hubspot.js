export async function submitHubspotForm(fields, hsPortalId, hsFormId) {
	return new Promise((resolve, reject) => {
		const xhr = new XMLHttpRequest();
		const url = `https://api.hsforms.com/submissions/v3/integration/submit/${hsPortalId}/${hsFormId}`;

		const data = {
			fields
		};

		xhr.open('POST', url);
		xhr.setRequestHeader('Content-Type', 'application/json');

		xhr.onreadystatechange = () => {
			if (xhr.readyState !== 4) {
				return;
			}

			const resJson = JSON.parse(xhr.responseText ?? '');

			if (xhr.status === 200) {
				resolve(resJson);
			} else {
				reject(resJson);
			}
		};

		xhr.send(JSON.stringify(data));
	});
}
