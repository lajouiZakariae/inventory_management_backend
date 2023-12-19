<script setup>
    defineProps({ id: Number, name: String, url: String });
</script>

<template>
    <tr>
        <td>
            <span>{{ name }}</span>
        </td>

        <td>
            <EditButton
                :to="{ name: 'payment-methods.edit', params: { id } }"
            />
            <DeleteButton :url="url" query-key="payment-methods" />
        </td>
    </tr>
</template>

<style scoped>
    i {
        cursor: pointer;
    }
</style>
