import React from 'react';

import './checklist.style.css';

const Checklist = (props) => {
    return (
        <div className="checklist">
            <p>
                <small>{props.checklist.description}</small></p>
        </div>
    );    
}

export default Checklist;