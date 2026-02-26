import React from 'react';
import Checklist from '../checklist/checklist.comp';

import './task.style.css';

const Task = (props) => {
    return (
        <div className={"task-container " +props.classes +" flex mb-10 items-center justify-space-between"}>
            <small className="category">
                {props.todo.category}
            </small>
            {props.todo.tasks.map((task) => {
                return (
                    <div key={task.id} className="flex-1">
                        <small>{task.description}</small>
                        <Checklist checklist={task.checklist} />
                    </div>
                )
            })}
        </div>
    );    
}

export default Task;