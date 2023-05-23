import React, { createElement } from 'react';

export function ProductItem({ hit, components }) {
  return (
    <a href={
        route('product.show', {'slug' : hit.slug}) }  className="aa-ItemLink">
      <div className="aa-ItemContent">
        <div className="aa-ItemTitle">
          <components.Highlight hit={hit} attribute="nombre_producto" />
        </div>
      </div>
    </a>
  );
}
