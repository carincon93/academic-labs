import React from 'react';

import './product-row.style.css';

const ProductRow = (props) => {
    return (
        <>
            <td>{props.name}</td>
            <td>{props.price}</td>
        </>
    );    
}

export default ProductRow;