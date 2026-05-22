<template>
  <main class="p-4">
    <h1>Unified Polyglot Dashboard</h1>

    <button
      type="button"
      @click="runNetworkAnalysis"
      :disabled="loading"
      class="mt-4 rounded border px-4 py-2"
    >
      {{ loading ? 'Running...' : 'Run Network Analysis' }}
    </button>

    <div id="result" class="mt-4">
      <p v-if="error" class="text-red-600">
        {{ error }}
      </p>

      <pre v-else-if="result">{{ result }}</pre>
    </div>
  </main>
</template>

<script setup>
import { ref } from 'vue'

const result = ref('')
const error = ref('')
const loading = ref(false)

async function runNetworkAnalysis() {
  loading.value = true
  error.value = ''
  result.value = ''

  try {
    const response = await fetch('http://omnitex-python-fastapi-service.onrender.com:8000/api/network/analyze', {
      method: 'GET',
      headers: {
        'Accept': 'application/json',
      },
    })

    if (!response.ok) {
      throw new Error(`HTTP ${response.status}`)
    }

    const data = await response.json()
    result.value = JSON.stringify(data, null, 2)
  } catch (err) {
    error.value = `Request failed: ${err?.message ?? String(err)}`
  } finally {
    loading.value = false
  }
}
</script>
