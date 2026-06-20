<script setup>
import useProxyServers from '../composables/useProxyServers'
import { ref } from 'vue'

const { deleteProxyServer, loading, error } = useProxyServers()

const open = defineModel('open', {
    type: Boolean,
    required: false,
    default: false,
})

const props = defineProps({
    proxyServer: {
        type: Object,
        required: true,
    },
})

const successMessage = ref(null)

const deleteProxyServerAction = () => {
    deleteProxyServer(props.proxyServer.id)
    successMessage.value = 'Прокси сервер успешно удален'

    setTimeout(() => {
        successMessage.value = null
        open.value = false
    }, 3000)
}

</script>

<template>
    <div>
        <h1>Удаление прокси сервера</h1>

        <p v-if="successMessage" class="text-green-500">{{ successMessage }}</p>

        <p>
            Вы уверены, что хотите удалить прокси сервер <b>{{ proxyServer.ip_address }}:{{ proxyServer.port }}</b>?
        </p>
        <button type="button" class="bg-red-400 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-red-600 hover:shadow-md" @click="deleteProxyServerAction">
            Удалить
        </button>
    </div>
</template>