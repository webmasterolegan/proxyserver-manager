<script setup>
import { ref, defineProps } from 'vue'
import useProxyServers from '../composables/useProxyServers'

const { 
    createProxyServer,
    updateProxyServer,
    loading,
    error
} = useProxyServers()

const props = defineProps({
    proxyServer: {
        type: Object,
        required: true,
        default: () => ({
            is_active: false,
            type: 'http',
            port: 80,
            ip_address: '',
        }),
    },
})

const editableProxyServer = ref({
    id: props.proxyServer?.id ?? null,
    is_active: props.proxyServer.is_active,
    type: props.proxyServer.type,
    port: props.proxyServer.port,
    ip_address: props.proxyServer.ip_address,
})

const frontendErrorMessage = ref(null)
const successMessage = ref(null)

const saveProxyServer = async () => {
    frontendErrorMessage.value = null
    successMessage.value = null

    if (!validateProxyServer()) {
        frontendErrorMessage.value = 'Некорректные данные прокси сервера'
        return
    }

    const result = props.proxyServer.id
        ? await updateProxyServer(editableProxyServer.value)
        : await createProxyServer(editableProxyServer.value)

    if (!result) {
        frontendErrorMessage.value = error.value
        return
    }

    successMessage.value = 'Прокси сервер успешно сохранен'
}

const validateProxyServer = () => {
    if (editableProxyServer.value.is_active === undefined || typeof editableProxyServer.value.is_active !== 'boolean') {
        return false
    }

    if (editableProxyServer.value.type === undefined || !['http', 'https', 'socks5'].includes(editableProxyServer.value.type)) {
        return false
    }
    if (
        editableProxyServer.value.port === undefined
        ||
        typeof editableProxyServer.value.port !== 'number'
        || 
        editableProxyServer.value.port < 1
        ||
        editableProxyServer.value.port > 65535
    ) {
        return false
    }

    if (
        editableProxyServer.value.ip_address === undefined
        ||
        typeof editableProxyServer.value.ip_address !== 'string'
        ||
        !/^(\d{1,3}\.){3}\d{1,3}$/.test(editableProxyServer.value.ip_address)
    ) {
        return false
    }

    return true
}
</script>

<template>
    <div>
        <h1 class="text-xl font-bold">
            <template v-if="proxyServer.id">
                Редактировать прокси сервер ID: {{ proxyServer.id }}
            </template>
            <template v-else>
                Добавить прокси сервер
            </template>
        </h1>

        <p v-if="frontendErrorMessage || error" class="text-red-500">
            {{ frontendErrorMessage || error }}
        </p>

        <p v-if="successMessage" class="text-green-500">
            {{ successMessage }}
        </p>

        <form @submit.prevent="saveProxyServer">
            <div class="flex flex-row gap-2">
                <label for="is_active">Активен</label>
                <input type="checkbox" id="is_active" v-model="editableProxyServer.is_active">
            </div>

            <div class="flex flex-row gap-2">
                <label for="type">Тип</label>
                <select id="type" v-model="editableProxyServer.type">
                    <option value="http">HTTP</option>
                    <option value="https">HTTPS</option>
                    <option value="socks5">SOCKS5</option>
                </select>
            </div>

            <div class="flex flex-row gap-2">
                <label for="port">Порт</label>
                <input type="number" id="port" v-model="editableProxyServer.port" min="1" max="65535" required>
            </div>

            <div class="flex flex-row gap-2">
                <label for="ip_address">IP адрес</label>
                <input type="text" id="ip_address" v-model="editableProxyServer.ip_address" required>
            </div>

            <button type="submit" :disabled="loading" class="bg-blue-400 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-blue-600 hover:shadow-md">
                {{ proxyServer.id ? 'Обновить' : 'Добавить' }}
            </button>
        </form>
    </div>
</template>
