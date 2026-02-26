import React from 'react';

import './product-category-row.style.css';

const ProductCategoryRow = (props) => {
    return (
        <tr className="product-category-row">
            <td colSpan="2" className="text-center">
                {props.category}
            </td>
        </tr>
    );    
}

export default ProductCategoryRow;