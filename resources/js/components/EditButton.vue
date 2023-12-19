<script setup>
    defineProps({ to: Object });
</script>

<template>
    <RouterLink
        class="btn text-light"
        :style="{ backgroundColor: '#24a0ed' }"
        :to="to"
    >
        <font-awesome-icon icon="fa-solid fa-pencil" />
    </RouterLink>
</template>
