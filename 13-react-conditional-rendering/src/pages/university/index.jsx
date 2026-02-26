import React from 'react';
import Course from './components/course/course.comp';

import './index.style.css';

const UniversityPage = () => {

    const courses = [
        {
            id: 1,
            name: 'Programming IV',
            students : [
                {
                    id: 1,
                    name: 'Alejandro',
                    gender: 'male',
                    grade: {
                        id: 1,
                        grade: 4
                    }
                },
                {
                    id: 2,
                    name: 'Luis',
                    gender: 'male',
                    grade: {
                        id: 2,
                        grade: 2.2
                    }
                },
                {
                    id: 3,
                    name: 'Patricia',
                    gender: 'female',
                    grade: {
                        id: 3,
                        grade: 3.4
                    }
                },
                {
                    id: 4,
                    name: 'Alfonso',
                    gender: 'male',
                    grade: {
                        id: 4,
                        grade: 4.1
                    }
                },
                {
                    id: 5,
                    name: 'Victoria',
                    gender: 'female',
                    grade: {
                        id: 5,
                        grade: 2.8
                    }
                },
                {
                    id: 6,
                    name: 'Carlos',
                    gender: 'male',
                    grade: {
                        id: 6,
                        grade: 3
                    }
                },
                {
                    id: 7,
                    name: 'Carolina',
                    gender: 'female',
                    grade: {
                        id: 7,
                        grade: 5
                    }
                }
            ]
        },
        {
            id: 2,
            name: 'English VI',
            students : [
                {
                    id: 8,
                    name: 'Juan',
                    gender: 'male',
                    grade: {
                        id: 8,
                        grade: 1.8
                    }
                },
                {
                    id: 9,
                    name: 'Liliana',
                    gender: 'female',
                    grade: {
                        id: 9,
                        grade: 3.8
                    }
                },
                {
                    id: 10,
                    name: 'Oscar',
                    gender: 'male',
                    grade: {
                        id: 10,
                        grade: 4.8
                    }
                },
                {
                    id: 11,
                    name: 'Juliana',
                    gender: 'female',
                    grade: {
                        id: 11,
                        grade: 2.6
                    }
                },
                {
                    id: 12,
                    name: 'Jhon',
                    gender: 'male',
                    grade: {
                        id: 12,
                        grade: 0.5
                    }
                },
                {
                    id: 13,
                    name: 'María Fernanda',
                    gender: 'female',
                    grade: {
                        id: 13,
                        grade: 2.9
                    }
                },
                {
                    id: 14,
                    name: 'Johana',
                    gender: 'female',
                    grade: {
                        id: 14,
                        grade: 4.7
                    }
                }
            ]
        },
        {
            id: 3,
            name: 'Databases II',
            students : [
                {
                    id: 15,
                    name: 'Kelly',
                    gender: 'female',
                    grade: {
                        id: 15,
                        grade: 4.5
                    }
                },
                {
                    id: 16,
                    name: 'Ricardo',
                    gender: 'male',
                    grade: {
                        id: 16,
                        grade: 2.5
                    }
                },
                {
                    id: 17,
                    name: 'Renata',
                    gender: 'female',
                    grade: {
                        id: 17,
                        grade: 3.0
                    }
                },
                {
                    id: 18,
                    name: 'Fabian',
                    gender: 'male',
                    grade: {
                        id: 18,
                        grade: 5
                    }
                },
                {
                    id: 19,
                    name: 'María Alejandra',
                    gender: 'female',
                    grade: {
                        id: 19,
                        grade: 5
                    }
                },
                {
                    id: 20,
                    name: 'José',
                    gender: 'male',
                    grade: {
                        id: 20,
                        grade: 3.8
                    }
                }
            ]
        }
    ];

    return (
        <div className="university">
            <div className="w-80 m-auto flex column flex-end mb-10">
                <h1 className="mb-0">Manizales University</h1>
                <small>Courses 2021</small>
            </div>
            {courses.map((course, index) => {
                return (
                    <React.Fragment key={course.id}>
                        <Course course={course} />
                    </React.Fragment>
                )
            })}
        </div>
    );    
}

export default UniversityPage;