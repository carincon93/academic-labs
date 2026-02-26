import React, { useState } from 'react'
import type { ChangeEventHandler, FormEvent } from 'react'
import axios from 'axios'
import type { AxiosRequestConfig } from 'axios'

export const Survey: React.FC = () => {
    const [formData, setFormData] = useState<any>({})
    const [loading, setLoading] = useState<Boolean>(false)

    const handleSubmit = (e: FormEvent<HTMLFormElement>) => {
        e.preventDefault()

        const transformedArray = Object.keys(formData).map((key, index) => ({
            question_id: `${index + 1}`,
            answer: formData[key],
        }))

        transformedArray.map((item) => {
            const config: AxiosRequestConfig = {
                method: 'post',
                maxBodyLength: Infinity,
                url: '/api/survey',
                headers: {
                    'Content-Type': 'application/json',
                },
                data: item, // Assuming you want to send form data
            }

            axios
                .request(config)
                .then((response) => {
                    setLoading(true)

                    console.log(JSON.stringify(response.data))
                })
                .catch((error: any) => {
                    setLoading(false)

                    console.log(error)
                })
        })
    }

    const handleInputChange: ChangeEventHandler<HTMLSelectElement | HTMLTextAreaElement> = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value,
        })
    }

    return (
        <form onSubmit={(e) => handleSubmit(e)} className="p-6 flex flex-col space-y-10 laptop:max-w-lg m-auto -top-[70px] relative z-[999]">
            <div className="absolute inset-0 -z-10 h-full w-full bg-white bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px]">
                <div className="absolute left-0 right-0 top-0 -z-10 m-auto h-[310px] w-[310px] rounded-full bg-fuchsia-400 opacity-20 blur-[100px]"></div>
            </div>

            <h1 className="text-1xl relative -top-[52px] font-bold leading-6 text-center text-violet-900">
                Una vez revisado el prototipo deslice desde este punto para diligenciar la encuesta: <span className="inline-block relative text-4xl hand-animated">👇🏻</span>
            </h1>

            <picture className="mx-auto">
                <img src="/wenti-logo.png" alt="" />
            </picture>
            <div>
                <label>1. ¿En qué medida te resulta útil la función de gestión de Mis Tickets?</label>
                <select name="answer1" onChange={handleInputChange}>
                    <option value="">Seleccione una opción</option>
                    <option value="Muy útil">Muy útil</option>
                    <option value="Útil">Útil </option>
                    <option value="Neutral">Neutral </option>
                    <option value="Poco útil">Poco útil</option>
                    <option value="Nada útil">Nada útil</option>
                </select>
            </div>
            <div>
                <label>2. ¿Has utilizado funciones parecidas de carpooling para compartir viajes con otros usuarios?</label>
                <select name="answer2" onChange={handleInputChange}>
                    <option value="">Seleccione una opción</option>
                    <option value="Sí, frecuentemente"> Sí, frecuentemente</option>
                    <option value="Sí, ocasionalmente ">Sí, ocasionalmente </option>
                    <option value="No, pero me gustaría probarla">No, pero me gustaría probarla </option>
                    <option value="No, no me interesa">No, no me interesa</option>
                </select>
            </div>
            <div>
                <label>3. ¿Encuentras útil la opción de ver quién está vendiendo tickets para eventos?</label>
                <select name="answer3" onChange={handleInputChange}>
                    <option value="">Seleccione una opción</option>
                    <option value="Sí, muy útil">Sí, muy útil</option>
                    <option value="Sí, útil">Sí, útil </option>
                    <option value="Neutral">Neutral</option>
                    <option value="No muy útil">No muy útil</option>
                    <option value="No útil en absoluto">No útil en absoluto</option>
                </select>
            </div>
            <div>
                <label>4. ¿Encuentras útil la opción WentiMove para encontrar transporte oficial y seguro?</label>
                <select name="answer4" onChange={handleInputChange}>
                    <option value="">Seleccione una opción</option>
                    <option value="Sí, muy útil">Sí, muy útil</option>
                    <option value="Sí, útil">Sí, útil </option>
                    <option value="Neutral">Neutral</option>
                    <option value="No muy útil">No muy útil</option>
                    <option value="No útil en absoluto">No útil en absoluto</option>
                </select>
            </div>

            <div>
                <label>5. ¿Con qué frecuencia te has encontrado en la situación de no tener compañía para un evento que te interesaba?</label>
                <select name="answer5" onChange={handleInputChange}>
                    <option value="">Seleccione una opción</option>
                    <option value="Frecuentemente">Frecuentemente</option>
                    <option value="Ocasionalmente">Ocasionalmente</option>
                    <option value="Raramente">Raramente</option>
                    <option value="Nunca">Nunca</option>
                </select>
            </div>
            <div>
                <label>6. ¿Alguna vez has dejado de asistir a un evento porque no tenías con quién ir?</label>
                <select name="answer6" onChange={handleInputChange}>
                    <option value="">Seleccione una opción</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div>
                <label>7. ¿Cuál es tu principal medio para enterarte de eventos en Colombia?</label>
                <select name="answer7" onChange={handleInputChange}>
                    <option value="">Seleccione una opción</option>
                    <option value="Redes sociales (Facebook, Instagram, Twitter, TikTok, etc.)">Redes sociales (Facebook, Instagram, Twitter, TikTok, etc.)</option>
                    <option value="Sitios web y aplicaciones especializadas en eventos">Sitios web y aplicaciones especializadas en eventos</option>
                    <option value="Recomendaciones de amigos o conocidos">Recomendaciones de amigos o conocidos</option>
                    <option value="Publicidad en medios tradicionales (radio, televisión, periódicos)">Publicidad en medios tradicionales (radio, televisión, periódicos)</option>
                </select>
            </div>
            <div>
                <label>8. ¿A través de qué medios sueles comprar tus tickets para eventos en Colombia?</label>
                <select name="answer8" onChange={handleInputChange}>
                    <option value="">Seleccione una opción</option>
                    <option value="Sitios web de venta de boletos (Ticketmaster, TuBoleta, etc.)">Sitios web de venta de boletos (Ticketmaster, TuBoleta, etc.)</option>
                    <option value="Aplicaciones móviles de venta de boletos">Aplicaciones móviles de venta de boletos</option>
                    <option value="Taquillas físicas en lugares de eventos">Taquillas físicas en lugares de eventos</option>
                    <option value="Vendedores en redes sociales">Vendedores en redes sociales</option>
                </select>
            </div>
            <div>
                <label>9. ¿De 0 a 10 qué tan probable sería que recomiendes la aplicación basándote en el prototipo?</label>
                <select name="answer9" onChange={handleInputChange}>
                    <option value="">Seleccione una opción</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div>
                <label>10. ¿Qué otras características o funciones te gustaría ver en la aplicación?</label>
                <textarea name="answer10" onChange={handleInputChange}></textarea>
            </div>
            <button type="submit" className="bg-fuchsia-700 p-4 text-white">
                {loading ? 'Enviado 👍🏻' : 'Enviar'}
            </button>
        </form>
    )
}
