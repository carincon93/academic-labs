import React from 'react';
import Grade from '../grade/grade.comp';

import './student.style.css';

const Student = (props) => {
    return (
        <div className="student flex justify-space-between items-center">
            <div className="flex items-center flex-1 min-w-200">
                <figure>
                    <img src="https://image.freepik.com/free-vector/collection-avatars-men-women_23-2147667741.jpg" alt={props.student.gender === 'male' ? 'male' : 'female'} className={props.student.gender === 'male' ? 'male' : 'female'}/>
                </figure>
                <p>
                    {props.student.name}
                </p>
            </div>
            <p className="flex-1">
                {props.student.gender}
            </p>
            <Grade grade={props.student.grade} />
        </div>
    );    
}

export default Student;