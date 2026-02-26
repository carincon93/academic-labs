import React from 'react';

import './grade.style.css';

const Grade = (props) => {
    return (
        <div className={props.grade.grade < 3 ? 'grade text-red bolder' : 'grade'}>
            {props.grade.grade}
        </div>
    );    
}

export default Grade;