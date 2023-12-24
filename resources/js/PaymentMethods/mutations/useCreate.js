import { useMutation, useQueryClient } from "@tanstack/vue-query";
import apiClient from "../../utils/apiClient";
import { useRouter } from "vue-router";

export default () => {
    const queryClient = useQueryClient();
    const router = useRouter();

    return useMutation({
        mutationKey: ["payment-methods", "create"],
        mutationFn: async (data) => {
            const response = await apiClient.post("payment-methods", data);

            if (response.status === 201) {
                queryClient.invalidateQueries({
                    queryKey: ["payment-methods"],
                });
                router.push({ name: "payment-methods" });
            }
        },
    });
};
