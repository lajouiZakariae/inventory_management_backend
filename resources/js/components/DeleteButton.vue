<script setup>
    import { useMutation, useQueryClient } from '@tanstack/vue-query';
    import apiClient from '../utils/apiClient';

    const queryClient = useQueryClient();

    const { queryKey } = defineProps({
        url: String,
        queryKey: String,
    });

    const { mutate, isPending, isSuccess } = useMutation({
        mutationFn: async url => {
            const response = await apiClient.delete(url);
            if (response.status === 204)
                await queryClient.invalidateQueries([queryKey]);
        },
    });
</script>

<template>
    <button
        @click="mutate(url)"
        :disabled="isPending || isSuccess"
        class="btn btn-danger ms-2"
    >
        <font-awesome-icon icon="fa-solid fa-trash" />
    </button>
</template>
