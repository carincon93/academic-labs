import React, { useState } from 'react';

import './form.style.css';

const Form = (props) => {
    const [category, setCategory] = useState('');
    const [taskDescription, setTaskDescription] = useState('');
    const [checklistDescription, setChecklistDescription] = useState('');

    function submit(e) {
        e.preventDefault();
        let todos = [...props.todos]; 

        todos.push({
            id: todos.length + 1,
            category: category,
            tasks : [
                {
                    id: todos.length + 1,
                    description: taskDescription,
                    checklist: {
                        id: todos.length + 1,
                        description: checklistDescription
                    }
                },
            ]
        });

        props.setTodo(todos);

        console.log(`category: ${category}`);
        console.log(`task: ${taskDescription}`);
        console.log(`checklist: ${checklistDescription}`);
    }
    return (
        <div className="form-container card">
            <form onSubmit={(e) => submit(e)}>
                <div>
                    <label htmlFor="category">Category</label>
                    <input type="text" id="category" className="box-shadow" name="category" value={category} autoComplete="off" onChange={(e) => setCategory(e.target.value)}/>
                </div>

                <div>
                    <label htmlFor="task-description">Task description</label>
                    <textarea name="task-description" id="task-description" className="box-shadow" cols="30" rows="10" value={taskDescription} onChange={(e) => setTaskDescription(e.target.value)}></textarea>
                </div>
                
                <div>
                    <label htmlFor="checklist-description">Checklist description</label>
                    <textarea name="checklist-description" id="checklist-description" className="box-shadow" cols="30" rows="10" value={checklistDescription} onChange={(e) => setChecklistDescription(e.target.value)}></textarea>
                </div>

                <div>
                    <button type="submit">Save task</button>
                </div>
            </form>
        </div>
    );    
}

export default Form;