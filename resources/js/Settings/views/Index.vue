<script setup>
    import { useMutation, useQuery, useQueryClient } from '@tanstack/vue-query';
    import { reactive, ref, watch } from 'vue';
    import apiClient from '../../utils/apiClient';
    import PageHeading from '../../components/PageHeading.vue';

    const { data, isLoading, isError, isSuccess } = useQuery({
        queryKey: ['settings'],
        queryFn: () => apiClient.get('/settings/desktop').then(req => req.data),
    });

    const settings = reactive({
        theme: data.value?.settingsValue.theme,
        font: data.value?.settingsValue.font,
        maintenanceMode: data.value?.settingsValue.maintenanceMode,
    });

    watch(data, _data => {
        if (_data) {
            settings.theme = _data.settingsValue.theme;
            settings.font = _data.settingsValue.font;
            settings.maintenanceMode = _data.settingsValue.maintenanceMode;
        }
    });

    const queryClient = useQueryClient();

    const { mutate, isPending: isUpdatePending } = useMutation({
        mutationKey: ['settings', 'edit'],
        mutationFn: async data => {
            console.log(data);
            const response = await apiClient.put('/settings/desktop', data);
            if (response.status === 204) {
                await queryClient.invalidateQueries([
                    'settings',
                    { exact: true },
                ]);
            }
        },
    });
</script>

<template>
    <PageHeading>Settings</PageHeading>

    <p class="alert alert-warning" v-if="isLoading">Loading...</p>
    <p class="alert alert-danger" v-if="isError">Error</p>

    <div class="row" v-if="isSuccess">
        <div class="col-5">
            <div class="row align-items-center">
                <div class="col-6 mb-2">
                    <h6>Theme</h6>
                </div>
                <div class="col-6 mb-2">
                    <select class="form-select w-auto" v-model="settings.theme">
                        <option value="red">Red</option>
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <h6>Font</h6>
                </div>
                <div class="col-6 mb-2">
                    <select class="form-select w-auto" v-model="settings.font">
                        <option value="poppins">Poppins</option>
                        <option value="consolas">Consolas</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <h6>Maintenance mode</h6>
                </div>
                <div class="col-6 mb-2">
                    <input
                        type="checkbox"
                        class="form-checkbox"
                        v-model="settings.maintenanceMode"
                    />
                </div>
                <div class="col">
                    <button
                        class="btn btn-dark"
                        @click="mutate(settings)"
                        :disabled="isUpdatePending"
                        v-text="isUpdatePending ? 'Saving...' : 'Save'"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
