<template>
    <div class="container-fluid">
        <div
            class="position-fixed col-2 bg-dark text-light d-flex flex-column align-items-center pt-3"
            :style="{
                height: '100vh',
                left: 0,
                top: 0,
            }"
        >
            <RouterLink to="/payment-methods" class="mb-2 link-warning"
                >Payment Methods</RouterLink
            >
            <RouterLink to="/settings" class="mb-2 link-warning"
                >Settings</RouterLink
            >
        </div>
        <div class="row justify-content-end">
            <div class="col-10" :style="{ minHeight: '100vh' }">
                <RouterView />
            </div>
        </div>
    </div>
</template>
