import React from 'react';

import './search-bar.style.css';

const SearchBar = () => {
    return (
        <div className="search-bar">
            <div className="mt-10">
                <input type="search" id="search" placeholder="Search..." className="input-search" />
            </div>

            <div className="mt-10">
                <input type="checkbox" id="in-stock" />
                <label htmlFor="in-stock">Only show products in stock</label>
            </div>
        </div>
    );    
}

export default SearchBar;