import { useMutation, useQueryClient } from '@tanstack/vue-query';
import apiClient from '../../utils/apiClient';
import { useRouter } from 'vue-router';

export default id => {
    const queryClient = useQueryClient();
    const navi = useRouter();

    return useMutation({
        mutationKey: ['payment-methods', id, 'edit'],
        mutationFn: async ({ url, data }) => {
            console.log(url, data);
            const response = await apiClient.put(url, data);
            if (response.status === 204) {
                await queryClient.invalidateQueries(['payment-methods', id]);
                navi.push({ name: 'payment-methods' });
            }
        },
    });
};
