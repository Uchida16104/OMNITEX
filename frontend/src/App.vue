<template>
  <main class="page">
    <section class="card">
      <h1>Unified Polyglot Dashboard</h1>

      <p class="lead">
        Frontend: https://omnitex.vercel.app
        <br />
        Backend: {{ apiBaseUrl }}
      </p>

      <button
        class="button"
        :disabled="loading"
        @click="runNetworkAnalysis"
      >
        {{ loading ? "Running..." : "Run Network Analysis" }}
      </button>

      <div v-if="error" class="alert error">
        {{ error }}
      </div>

      <div v-if="result" id="result" class="result">
        <h2>Result</h2>
        <pre>{{ result }}</pre>
      </div>
    </section>
  </main>
</template>

<script setup>
import { computed, ref } from "vue";

const apiBaseUrl = import.meta.env.VITE_API_BASE_URL ?? "https://omnitex-python-fastapi-service.onrender.com";

const loading = ref(false);
const error = ref("");
const result = ref("");

const endpointUrl = computed(() => `${apiBaseUrl.replace(/\/$/, "")}/network/analyze`);

async function runNetworkAnalysis() {
  loading.value = true;
  error.value = "";
  result.value = "";

  try {
    const response = await fetch(endpointUrl.value, {
      method: "GET",
      headers: {
        Accept: "application/json",
      },
    });

    const contentType = response.headers.get("content-type") || "";
    const payload = contentType.includes("application/json")
      ? await response.json()
      : { raw: await response.text() };

    if (!response.ok) {
      throw new Error(
        `HTTP ${response.status} ${response.statusText}: ${JSON.stringify(payload)}`
      );
    }

    result.value = JSON.stringify(payload, null, 2);
  } catch (err) {
    error.value = err instanceof Error ? err.message : String(err);
  } finally {
    loading.value = false;
  }
}
</script>

<style scoped>
.page {
  min-height: 100vh;
  padding: 24px;
  background: #f6f7fb;
  color: #111827;
  font-family: Arial, Helvetica, sans-serif;
}

.card {
  max-width: 900px;
  margin: 0 auto;
  background: #ffffff;
  border: 1px solid #e5e7eb;
  border-radius: 16px;
  padding: 24px;
  box-shadow: 0 10px 30px rgba(17, 24, 39, 0.08);
}

h1 {
  margin: 0 0 12px;
  font-size: 28px;
  line-height: 1.2;
}

.lead {
  margin: 0 0 20px;
  color: #4b5563;
  line-height: 1.6;
}

.button {
  appearance: none;
  border: 0;
  border-radius: 12px;
  padding: 12px 18px;
  background: #111827;
  color: #ffffff;
  font-weight: 700;
  cursor: pointer;
}

.button:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.alert {
  margin-top: 16px;
  padding: 12px 14px;
  border-radius: 12px;
  white-space: pre-wrap;
}

.error {
  background: #fef2f2;
  color: #b91c1c;
  border: 1px solid #fecaca;
}

.result {
  margin-top: 16px;
  padding: 16px;
  border-radius: 12px;
  background: #f9fafb;
  border: 1px solid #e5e7eb;
}

pre {
  margin: 0;
  white-space: pre-wrap;
  word-break: break-word;
  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
}
</style>
