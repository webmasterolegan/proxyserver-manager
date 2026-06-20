<script setup>
import { ref } from 'vue'
import Modal from './Modal.vue'
import ProxyServerForm from './ProxyServerForm.vue'
import ProxyServerDelete from './ProxyServerDelete.vue'

defineProps({
    proxyServers: {
        type: Array,
        required: true,
    },
})

const deleteModalOpen = ref(false)
const editModalOpen = ref(false)
const editableProxyServer = ref(null)
const proxyServerToDelete = ref(null)

const editModalProxyServer = (proxyServer) => {
    editModalOpen.value = true
    editableProxyServer.value = proxyServer
}

const deleteModalProxyServer = (proxyServer) => {
    deleteModalOpen.value = true
    proxyServerToDelete.value = proxyServer
}

</script>

<template>
    <div v-for="proxyServer in proxyServers" :key="proxyServer.id" class="rounded-md my-4 px-4 py-2 border border-gray-100 shadow-md relative">
        <p v-if="proxyServer.is_active" class="text-green-500">Доступен</p>
        <p v-else class="text-red-500">Не доступен</p>
        <p>{{ proxyServer.type }}:{{ proxyServer.ip_address }}:{{ proxyServer.port }}</p>
        <p v-if="proxyServer.last_checked_at">Последняя проверка: <b>{{ proxyServer.last_checked_at }}</b></p>
        <p v-else><b>Проверка доступности не производилась</b></p>
        <p>Дата обновления: <b>{{ proxyServer.updated_at }}</b></p>
        <p>Дата создания: <b>{{ proxyServer.created_at }}</b></p>

        <div class="mt-4 md:mt-0 md:absolute md:top-4 md:right-4 flex flex-row gap-2">
            <button type="button" class="bg-red-400 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-red-600 hover:shadow-md" @click="deleteModalProxyServer(proxyServer)">
                Удалить
            </button>

            <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded-md cursor-pointer hover:bg-gray-600 hover:shadow-md" @click="editModalProxyServer(proxyServer)">
                Редактировать
            </button>
        </div>
    </div>

    <Modal v-model:open="editModalOpen">
        <ProxyServerForm :proxyServer="editableProxyServer" />
    </Modal>

    <Modal v-model:open="deleteModalOpen">
        <ProxyServerDelete v-model:open="deleteModalOpen" :proxyServer="proxyServerToDelete" />
    </Modal>
</template>