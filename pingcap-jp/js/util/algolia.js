import algoliasearch from 'algoliasearch/lite';

export const AlgoliaClient = algoliasearch(ALGOLIA_APPLICATION_ID, ALGOLIA_API_KEY);
