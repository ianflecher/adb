<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiosk - Order Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function kioskApp() {
            return {
                orderType: '',
                paymentOption: '',
                totalPrice: 0, // We'll compute this from localStorage
                items: [],

                selectOrder(type) {
                    this.orderType = type;
                },

                selectPayment(option) {
                    this.paymentOption = option;
                    this.loadCartItems();  // Load items before checkout
                    localStorage.removeItem('cart');
                },

                loadCartItems() {
                    const cart = JSON.parse(localStorage.getItem('cart')) || [];

                    this.items = cart;

                    // Calculate total price
                    this.totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },

                goBack() {
                    window.location.href = "/user";
                },
            };
        }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100 font-sans" x-data="kioskApp()">

    <header class="bg-green-600 text-white p-6 text-center">
        <h1 class="text-3xl font-bold">Welcome to Food For Life</h1>
    </header>

    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">

        <h2 class="text-2xl font-semibold mb-4 text-center">Would you like to:</h2>
        <div class="flex justify-center gap-4 mb-8">
            <button @click="selectOrder('Dine In')" 
                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Dine In</button>
            <button @click="selectOrder('Take Out')" 
                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Take Out</button>
        </div>

        <template x-if="orderType">
            <div>
                <h2 class="text-2xl font-semibold mb-4 text-center">Choose your payment method:</h2>
                <div class="flex justify-center gap-4 mb-8">
                    <form action="/checkout" method="POST" class="inline-block">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="order_type" :value="orderType">
                        <input type="hidden" name="payment_option" :value="paymentOption">
                        <input type="hidden" name="order_status" value="Pending"> <!-- Added order_status -->
                        <input type="hidden" name="total_price" :value="totalPrice"> <!-- Added total_price -->
                        <input type="hidden" name="items" :value="JSON.stringify(items)"> <!-- Added items -->
                        <button type="submit" @click="selectPayment('Pay at Cashier')" 
                            class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">Pay at Cashier</button>
                    </form>
                    <form action="/checkout" method="POST" class="inline-block">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="order_type" :value="orderType">
                        <input type="hidden" name="payment_option" :value="paymentOption">
                        <input type="hidden" name="order_status" value="Pending"> <!-- Added order_status -->
                        <input type="hidden" name="total_price" :value="totalPrice"> <!-- Added total_price -->
                        <input type="hidden" name="items" :value="JSON.stringify(items)"> <!-- Added items -->
                        <button type="submit" @click="selectPayment('GCash')" 
                            class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">GCash</button>
                    </form>
                </div>
            </div>
        </template>

        <div class="text-center mt-6">
            <button @click="goBack()" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
                Back to Product List
            </button>
        </div>

    </div>

</body>
</html>
