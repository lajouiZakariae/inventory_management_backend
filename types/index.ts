export interface Category {
    // columns
    id: number;
    name: string;
    description: string | null;
}

export interface CouponCode {
    // columns
    id: number;
    code: string;
    amount: number;
}

export interface History {
    // columns
    id: number;
    operation: string;
    product_id: number;

    // relations
    product: Product;
}

export interface Media {
    // columns
    id: number;
    alt_text: string;
    path: string;
    type: string;
    product_id: number;

    // relations
    product: Product;
}

export interface Order {
    // columns
    id: number;
    full_name: string;
    email: string;
    phone_number: string;
    status: string;
    city: string;
    payment_method_id: number;
    zip_code: string;
    coupon_code_id: number;
    address: string;
    delivery: boolean;

    // relations
    payment_method: PaymentMethod;
    coupon_code: CouponCode;
}

export interface OrderItem {
    // columns
    id: number;
    order_id: number;
    product_id: number;
    quantity: number;

    // relations
    order: Order;
    poduct: Product;
}

export interface PaymentMethod {
    // columns
    id: number;
    name: string;
    description: string | null;
}

export interface Product {
    // columns
    id: number;
    title: string;
    description: string | null;
    cost: number;
    price: number;
    stock_quantity: number;
    published: boolean;
    category_id: number;
    store_id: number | null;

    // relations
    category: Category;
    store: Store;
    media: Media[];
}

export interface Purchase {
    // columns
    id: number;
    supplier_id: number;
    delivery_date: string;
    paid: boolean;
    payment_method_id: number | null;
    store_id: number;

    // relations
    supplier: Supplier;
    payment_method: PaymentMethod;
    store: Store;
}

export interface PurchaseItem {
    // columns
    id: number;
    purchase_id: number;
    product_id: number;
    quantity: number;

    // relations
    purchase: Purchase;
    product: Product;
}

export interface Review {
    // columns
    id: number;
    email: string;
    body: string;
    product_id: number;
    approved: boolean;

    // relations
    product: Product;
}

export interface Role {
    // columns
    id: number;
    name: string;
}

export interface Setting {
    // columns
    id?: number;
    platform: string;
    settings_value: Record<string, unknown>;
    settings_default?: Record<string, unknown>;
}

export interface Store {
    // columns
    id: number;
    name: string;
    address: string | null;
    latitude: number | null;
    longitude: number | null;
}

export interface Supplier {
    // columns
    id: number;
    name: string;
    email: string;
    phone_number: string;
    address: string;
    created_at?: string | null;
    updated_at?: string | null;
}

export interface User {
    // columns
    id: number;
    first_name: string;
    last_name: string;
    role_id: number;
    email: string;
}
