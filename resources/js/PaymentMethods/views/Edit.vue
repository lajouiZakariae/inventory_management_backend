<script setup>
    import { reactive, ref, watch, watchEffect } from 'vue';
    import { useQuery } from '@tanstack/vue-query';
    import { useRoute } from 'vue-router';
    import apiClient from '../../utils/apiClient';
    import useUpdate from '../mutations/useUpdate';
    import PageHeading from '../../components/PageHeading.vue';

    const { id } = useRoute().params;

    const { isLoading, data, isError, error, isSuccess } = useQuery({
        queryKey: ['payment-methods', id],
        queryFn: async () => {
            const res = await apiClient.get('/payment-methods/' + id);
            return res.data;
        },
    });

    const { mutate } = useUpdate(id);

    const paymentMethod = reactive({
        name: data.value?.name,
        description: data.value?.description,
    });

    watch(data, newVal => {
        paymentMethod.name = newVal.name;
        paymentMethod.description = newVal.description;
    });
</script>

<template>
    <PageHeading>Edit Payment Method</PageHeading>

    <form>
        <div class="row">
            <div class="col-7 mx-auto mt-4">
                <p v-if="isLoading">Loading...</p>

                <p v-if="isError && error.response.status === 404">
                    Resource Not Found
                </p>

                <template v-if="isSuccess">
                    <!-- Form Input -->
                    <div class="row align-items-center mb-2">
                        <div class="col-3">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-9">
                            <input
                                type="text"
                                id="name"
                                class="form-control"
                                v-model="paymentMethod.name"
                            />
                        </div>
                    </div>
                    <!-- /Form Input -->
                    <!-- Form Input -->
                    <div class="row mb-2">
                        <div class="col-3">
                            <label for="description">Description</label>
                        </div>
                        <div class="col-9">
                            <textarea
                                id="description"
                                class="form-control"
                                cols="30"
                                rows="4"
                                v-model="paymentMethod.description"
                            ></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-9">
                            <button
                                class="btn btn-success w-100"
                                @click.prevent="
                                    mutate({
                                        url: data.url,
                                        data: paymentMethod,
                                    })
                                "
                            >
                                Save
                            </button>
                        </div>
                    </div>
                    <!-- /Form Input -->
                </template>
            </div>
        </div>
    </form>
</template>
