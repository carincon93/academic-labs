import React from 'react';
import Student from '../student/student.comp';

import './course.style.css';

const Course = (props) => {
    return (
        <div className="course">
            <header className="bg-white box-shadow">
                <h4 className="m-0">{props.course.name}</h4>
                <div className="flex justify-space-between">
                    <p className="min-w-200 flex-1">Name</p>
                    <p className="flex-1">Gender</p>
                    <p>Grade</p>
                </div>
            </header>
            {props.course.students.map((student, index) => {
                return (
                    <React.Fragment key={student.id}>
                        <Student student={student}/>
                    </React.Fragment>
                )
            })}
        </div>
    );    
}

export default Course;