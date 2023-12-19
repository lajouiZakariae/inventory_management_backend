import PaymentMethodsIndex from './PaymentMethods/views/Index.vue';
import PaymentMethodsCreate from './PaymentMethods/views/Create.vue';
import PaymentMethodsEdit from './PaymentMethods/views/Edit.vue';

import SettingsIndex from './Settings/views/Index.vue';

export default [
    {
        name: 'payment-methods',
        path: '/payment-methods',
        component: PaymentMethodsIndex,
    },
    {
        name: 'payment-methods.create',
        path: '/payment-methods/create',
        component: PaymentMethodsCreate,
    },
    {
        name: 'payment-methods.edit',
        path: '/payment-methods/:id/edit',
        component: PaymentMethodsEdit,
    },
    {
        name: 'settings.index',
        path: '/settings',
        component: SettingsIndex,
    },
];
