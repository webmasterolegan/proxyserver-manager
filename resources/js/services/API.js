/** 
 * Сервис для работы с API (без автроизации и прочих излишеств)
 */

const BASE_HEADERS = {
    'Content-Type': 'application/json',
}

export default {
    get: async (url) => {
        const response = await fetch(url, {
            headers: BASE_HEADERS,
        })
        return { status: response.status, data: await response.json() }
    },

    post: async (url, data) => {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: BASE_HEADERS,
        });
        return { status: response.status, data: await response.json() }
    },

    put: async (url, data) => {
        const response = await fetch(url, {
            method: 'PUT',
            body: JSON.stringify(data),
            headers: BASE_HEADERS,
        });
        return { status: response.status, data: await response.json() }
    },

    delete: async (url) => {
        const response = await fetch(url, {
            method: 'DELETE',
            headers: BASE_HEADERS,
        });
        return { status: response.status, data: await response.json() }
    },
}