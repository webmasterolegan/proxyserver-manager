<script setup>
import ProxyServersList from './comonents/ProxyServersList.vue'
import { onMounted, ref } from 'vue'
import useProxyServers from './composables/useProxyServers'
import ProxyServerForm from './comonents/ProxyServerForm.vue'
import Modal from './comonents/Modal.vue'

const { proxyServers, getProxyServers } = useProxyServers()
const addProxyServerModalOpen = ref(false)

onMounted(async () => {
    await getProxyServers()
})

</script>

<template>
    <div>
        <h1 class="text-4xl font-bold text-center my-4">Proxy Manager</h1>

        <button type="button" class="w-full bg-blue-400 hover:bg-blue-600 hover:shadow-md text-white px-4 py-2 rounded-md cursor-pointer" @click="addProxyServerModalOpen = true">
            Добавить прокси сервер
        </button>

        <div v-if="proxyServers?.length > 0">
            <ProxyServersList :proxyServers="proxyServers" />
        </div>

        <div v-else>
            <p>Прокси серверы отсутствуют. Начните их добавлять.</p>
        </div>
    </div>

    <Modal v-model:open="addProxyServerModalOpen">
        <ProxyServerForm :proxyServer="{ is_active: false, type: 'http', port: 80, ip_address: '' }" />
    </Modal>
</template>