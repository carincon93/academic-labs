import { xata } from '@/utils/xata'
import type { APIRoute } from 'astro'

export const GET: APIRoute = async () => {
    const response = await xata.db.survey.getAll()

    return new Response(JSON.stringify(response), { status: 200, headers: { 'Content-Type': 'application/json' } })
}

export const POST: APIRoute = async ({ request }) => {
    const data = await request.json()

    const response = await xata.db.survey.create(data)

    return new Response(JSON.stringify(response), { status: 200, headers: { 'Content-Type': 'application/json' } })
}
