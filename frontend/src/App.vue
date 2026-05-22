<template>
  <main class="p-4">
    <h1>Unified Polyglot Dashboard</h1>

    <button
      hx-get="/api/network/status"
      hx-trigger="click"
      hx-target="#result">
      Run Network Analysis
    </button>

    <div id="result"></div>
  </main>
</template>

<script setup>
import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()
</script>
