<script setup>
    import { reactive, ref, watch, watchEffect } from 'vue';
    import useCreate from '../mutations/useCreate';
    import FormInputError from '../../components/FormInputError.vue';
    import PageHeading from '../../components/PageHeading.vue';

    const paymentMethod = reactive({ name: '', description: '' });

    const errors = ref({ name: null, description: null });

    const { mutate, isPending, error, isSuccess } = useCreate();

    watch(error, val => {
        if (val) {
            errors.value.name = val.response.data.errors?.name?.at(0);
            errors.value.description =
                val.response.data.errors?.description?.at(0);
        }
    });

    const createPaymentMethod = data => {
        // const errorMessages = {
        //     'string.empty': 'The name field is required.',
        //     'string.min': 'too short',
        //     'string.max': 'too long',
        // };

        // const schema = Joi.object({
        //     name: Joi.string()
        //         .required()
        //         .min(3)
        //         .max(255)
        //         .messages(errorMessages),
        //     description: Joi.string()
        //         .allow('')
        //         .min(3)
        //         .max(500)
        //         .messages(errorMessages),
        // });

        // const validation = schema.validate(data);

        // errors.value.name = null;
        // errors.value.description = null;

        // validation.error?.details.forEach(element => {
        //     errors.value[element.context.key] = element.message;
        // });

        // if (!validation.error)
        mutate(data);
    };
</script>

<template>
    <PageHeading>Add Payment Method</PageHeading>
    <form>
        <div class="row">
            <div class="col-7 mx-auto mt-4">
                <!-- Form Input -->
                <div class="row align-items-center mb-2">
                    <div class="col-3">
                        <label for="name">Name</label>
                    </div>

                    <div class="col-9">
                        <input
                            type="text"
                            id="name"
                            :class="{
                                'form-control': true,
                                'border-danger': errors.name && !isSuccess,
                            }"
                            v-model="paymentMethod.name"
                        />
                    </div>

                    <div class="col-9 ms-auto" style="height: 30px">
                        <FormInputError
                            v-if="errors.name && !isSuccess"
                            :msg="errors.name"
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
                            :class="{
                                'border-danger':
                                    errors.description && !isSuccess,
                            }"
                            cols="30"
                            rows="4"
                            v-model="paymentMethod.description"
                        ></textarea>
                    </div>
                    <div class="col-9 ms-auto" style="height: 30px">
                        <FormInputError
                            v-if="errors.description"
                            :msg="errors.description"
                        />
                    </div>
                </div>
                <!-- /Form Input -->
                <div class="row justify-content-end">
                    <div class="col-9">
                        <button
                            class="btn btn-success w-100"
                            @click.prevent="createPaymentMethod(paymentMethod)"
                            :disabled="isPending"
                            v-text="isPending ? 'Saving...' : 'Save'"
                        ></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
