<script setup>
    defineProps({ msg: String });
</script>

<template>
    <div class="text-danger m-0 mt-2">{{ msg }}</div>
</template>

<style scoped>
    div {
        font-size: 15px;
    }
</style>
