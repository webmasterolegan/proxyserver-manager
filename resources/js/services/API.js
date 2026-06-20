/** 
 * Сервис для работы с API (без автроизации и прочих излишеств)
 */

const BASE_HEADERS = {
    'Content-Type': 'application/json',
}

const parseResponse = async (response) => {
    const text = await response.text()

    return {
        status: response.status,
        data: text ? JSON.parse(text) : null,
    }
}

export default {
    get: async (url) => {
        const response = await fetch(url, {
            headers: BASE_HEADERS,
        })

        return parseResponse(response)
    },

    post: async (url, data) => {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: BASE_HEADERS,
        })

        return parseResponse(response)
    },

    put: async (url, data) => {
        const response = await fetch(url, {
            method: 'PUT',
            body: JSON.stringify(data),
            headers: BASE_HEADERS,
        })

        return parseResponse(response)
    },

    delete: async (url) => {
        const response = await fetch(url, {
            method: 'DELETE',
            headers: BASE_HEADERS,
        })

        return parseResponse(response)
    },
}