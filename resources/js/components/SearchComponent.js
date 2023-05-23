import React, { createElement } from 'react';
import { getAlgoliaResults } from '@algolia/autocomplete-js';
import algoliasearch from 'algoliasearch';
import { Autocomplete } from './Autocomplete';
import { ProductItem } from './ProductItem';
import ReactDOM from "react-dom";
import '@algolia/autocomplete-theme-classic';

const appId = '0ID0C37YVA';
const apiKey = '3dd4698c6490dbfba80fff6e8fa01adb';
const searchClient = algoliasearch(appId, apiKey);

function SearchComponent() {
  return (
    <div className="app-container">
      <Autocomplete
        openOnFocus={true}
        getSources={({ query }) => [
          {
            sourceId: 'productos',
            getItems() {
              return getAlgoliaResults({
                searchClient,
                queries: [
                  {
                    indexName: 'productos',
                    query,
                  },
                ],
              });
            },
            templates: {
              item({ item, components }) {
                return <ProductItem hit={item} components={components} />;
              },
            },
          },
        ]}
      />
    </div>
  );
}

export default SearchComponent;

if (document.getElementById("search-component")) {
    const element = document.getElementById("search-component");
    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<SearchComponent {...props} />, element);
}
