import React from 'react';
import ProductCategoryRow from '../product-category-row/product-category-row.comp';
import ProductRow from '../product-row/product-row.comp';

import './product-table.style.css';

const products = [
    {category: "Sporting Goods", price: "$49.99", stocked: true, name: "Football"},
    {category: "Sporting Goods", price: "$9.99", stocked: true, name: "Baseball"},
    {category: "Sporting Goods", price: "$29.99", stocked: false, name: "Basketball"},
    {category: "Electronics", price: "$99.99", stocked: true, name: "iPod Touch"},
    {category: "Electronics", price: "$399.99", stocked: false, name: "iPhone 5"},
    {category: "Electronics", price: "$199.99", stocked: true, name: "Nexus 7"}
];

const ProductTable = () => {
    return (
        <table className="product-table">
            <thead>
                <tr className="text-left">
                    <th>Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <ProductCategoryRow category="Sporting Goods"/>
                {products.map((product) =>
                    <tr key={product.name} className={`product-row${product.stocked ? '' : ' text-red'}`}>
                        {product.category === "Sporting Goods" ?
                            <>
                                <ProductRow key={product.name} name={product.name} price={product.price} stocked={product.stocked}/>
                            </>
                            : null
                        }
                    </tr>
                )}

                <ProductCategoryRow category="Electronics"/>
                {products.map((product) =>
                    <tr key={product.name} className={`product-row${product.stocked ? '' : ' text-red'}`}>
                        {product.category === "Electronics" ?
                            <>
                                <ProductRow key={product.name} name={product.name} price={product.price} stocked={product.stocked}/>
                            </>
                            : null
                        }
                    </tr>
                )}
            </tbody>
        </table>
    );    
}   

export default ProductTable;