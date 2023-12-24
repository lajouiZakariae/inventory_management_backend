<script setup>
import { useQuery, useQueryClient } from "@tanstack/vue-query";
import { ref, watch } from "vue";
import apiClient from "../../utils/apiClient";

import Tablerow from "../components/TableRow.vue";

const sortBy = ref("latest");
const queryClient = useQueryClient();

const { data, isLoading, isError, isSuccess } = useQuery({
    queryKey: ["payment-methods"],
    queryFn: () =>
        apiClient
            .get(`/payment-methods?sortBy=${sortBy.value}`)
            .then((req) => req.data),
});

watch(sortBy, (_) =>
    queryClient.invalidateQueries({ queryKey: ["payment-methods"] })
);
</script>

<template>
    <PageHeading>Payments Methods</PageHeading>

    <RouterLink
        :to="{ name: 'payment-methods.create' }"
        class="btn btn-dark mb-2"
    >
        Add
    </RouterLink>

    <div class="d-flex justify-content-end align-items-center mb-2">
        <label for="sortBy">Sort By</label>
        <select id="sortBy" class="form-select ms-2 w-auto" v-model="sortBy">
            <option value="oldest">Oldest</option>
            <option value="latest">Latest</option>
        </select>
    </div>

    <p class="alert alert-warning" v-if="isLoading">Loading...</p>
    <p class="alert alert-danger" v-if="isError">Error</p>

    <table class="table" v-if="isSuccess">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <Tablerow
                v-if="data && data.length > 0"
                v-for="paymentMethod in data"
                v-bind="paymentMethod"
                :key="paymentMethod.id"
            />
            <tr v-else>
                <td colspan="2">
                    <EmptyBox>You don't have any payment method.</EmptyBox>
                </td>
            </tr>
        </tbody>
    </table>
</template>
