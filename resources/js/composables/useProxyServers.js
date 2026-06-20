import { ref } from 'vue'
import API from '../services/API'

const proxyServers = ref(null)

const extractApiErrorMessage = (data) => {
    if (!data) {
        return 'Неизвестная ошибка'
    }

    if (typeof data === 'string') {
        return data
    }

    if (data.message) {
        return data.message
    }

    if (data.errors) {
        return Object.values(data.errors).flat().join(' ')
    }

    return 'Неизвестная ошибка'
}

/**
 * Хранилище прокси серверов
 */
export default function useProxyServers() {
    const error = ref(null)
    const loading = ref(false)

    /**
     * Получить список прокси серверов
     */
    const getProxyServers = async () => {
        if (proxyServers.value) {
            return proxyServers.value
        }

        loading.value = true
        error.value = null
        proxyServers.value = null

        try {
            const response = await API.get('/api/proxy-servers')

            if (response.status === 200) {
                proxyServers.value = response.data

                return proxyServers.value
            }

            if (response.status === 204) {
                proxyServers.value = []

                return proxyServers.value
            }

            error.value = extractApiErrorMessage(response.data)

            return null
        } catch (e) {
            error.value = e.message || 'Не удалось загрузить список прокси серверов'

            return null
        } finally {
            loading.value = false
        }
    }

    /**
     * Создать прокси сервер
     */
    const createProxyServer = async (proxyServerData) => {
        loading.value = true
        error.value = null

        try {
            const response = await API.post('/api/proxy-servers', proxyServerData)

            if (response.status === 201) {
                if (!proxyServers.value) {
                    proxyServers.value = []
                }

                proxyServers.value.push(response.data)

                return response.data
            }

            error.value = extractApiErrorMessage(response.data)

            return null
        } catch (e) {
            error.value = e.message || 'Не удалось создать прокси сервер'

            return null
        } finally {
            loading.value = false
        }
    }

    /**
     * Обновить прокси сервер
     */
    const updateProxyServer = async (proxyServerData) => {
        loading.value = true
        error.value = null

        try {
            const response = await API.put(`/api/proxy-servers/${proxyServerData.id}`, proxyServerData)

            if (response.status === 200) {
                proxyServers.value = proxyServers.value.map(
                    proxyServer => proxyServer.id === proxyServerData.id ? response.data : proxyServer
                )

                return response.data
            }

            error.value = extractApiErrorMessage(response.data)

            return null
        } catch (e) {
            error.value = e.message || 'Не удалось обновить прокси сервер'

            return null
        } finally {
            loading.value = false
        }
    }

    /**
     * Удалить прокси сервер
     */
    const deleteProxyServer = async (proxyServerId) => {
        loading.value = true
        error.value = null

        try {
            const response = await API.delete(`/api/proxy-servers/${proxyServerId}`)

            if (response.status === 200) {
                proxyServers.value = proxyServers.value.filter(proxyServer => proxyServer.id !== proxyServerId)

                return true
            }

            error.value = extractApiErrorMessage(response.data)

            return null
        } catch (e) {
            error.value = e.message || 'Не удалось удалить прокси сервер'

            return null
        } finally {
            loading.value = false
        }
    }

    return {
        proxyServers,
        error,
        loading,
        getProxyServers,
        createProxyServer,
        updateProxyServer,
        deleteProxyServer,
    }
}
