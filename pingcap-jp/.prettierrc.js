module.exports = {
	tabWidth: 4,
	useTabs: true,
	singleQuote: true,
	jsxSingleQuote: false,
	printWidth: 100,
	trailingComma: 'none',
	overrides: [
		{
			files: '*.scss',
			options: {
				singleQuote: false
			}
		},
		{
			files: '*.css',
			options: {
				singleQuote: false
			}
		}
	]
};
