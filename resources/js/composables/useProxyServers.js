import { ref } from 'vue'
import API from '../services/API'

const proxyServers = ref(null)

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

        const response = await API.get('/api/proxy-servers')
        if (response.status === 200) {
            proxyServers.value = response.data
            loading.value = false

            return proxyServers.value
        }

        loading.value = false
        error.value = response.data.message

        return response
    }

    /**
     * Создать прокси сервер
     */
    const createProxyServer = async (proxyServerData) => {
        loading.value = true
        error.value = null

        const response = await API.post('/api/proxy-servers', proxyServerData)
        if (response.status === 201) {
            proxyServers.value.push(response.data)
            loading.value = false

            return response
        }

        loading.value = false
        error.value = response.data.message

        return response
    }

    /**
     * Обновить прокси сервер
     */
    const updateProxyServer = async (proxyServerData) => {
        loading.value = true
        error.value = null

        const response = await API.put(`/api/proxy-servers/${proxyServerData.id}`, proxyServerData)

        if (response.status === 200) {
            proxyServers.value = proxyServers.value.map(proxyServer => proxyServer.id === proxyServerData.id ? response.data : proxyServer)
            loading.value = false

            return response
        }

        loading.value = false
        error.value = response.data.message

        return response
    }

    /**
     * Удалить прокси сервер
     */
    const deleteProxyServer = async (proxyServerId) => {
        loading.value = true
        error.value = null

        const response = await API.delete(`/api/proxy-servers/${proxyServerId}`)
        if (response.status === 200) {
            proxyServers.value = proxyServers.value.filter(proxyServer => proxyServer.id !== proxyServerId)
            loading.value = false

            return response
        }

        loading.value = false
        error.value = response.data.message

        return response
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