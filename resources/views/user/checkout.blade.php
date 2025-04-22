<!DOCTYPE html>
<html lang="en" x-data="kioskApp()" x-init="initCart">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiosk - Order Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
function kioskApp() {
    return {
        cart: JSON.parse(localStorage.getItem('cart')) || [],
        paymentOption: '',
        csrfToken: '{{ csrf_token() }}',
        initCart() {
            if (!this.cart) {
                this.cart = [];
            }
        },
        updateCart() {
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        goBack() {
            window.location.href = "/user";
        },
        checkout() {
            window.location.href = 'payment';
        }
    };
}
</script>

</head>
<body class="bg-gray-100 font-sans">

    <header class="bg-green-600 text-white p-6 text-center">
        <h1 class="text-3xl font-bold">Welcome to Food For Life</h1>
    </header>

    <div class="max-w-3xl mx-auto p-6 mt-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Checkout</h2>

        <div x-show="cart.length > 0">
            <div class="border-b-2 pb-4 mb-6">
                <h3 class="text-xl font-medium text-gray-800">Your Cart</h3>
                <ul class="space-y-4 mt-4">
                    <template x-for="(item, index) in cart" :key="index">
                        <li class="flex justify-between items-center">
                            <div class="flex items-center space-x-4 w-3/4">
                                <img :src="item.image" alt="Product Image" class="w-16 h-16 object-cover rounded-md">
                                <div>
                                    <span class="text-lg font-semibold" x-text="`${item.name} x ${item.quantity}`"></span>
                                    <div class="text-gray-600" x-text="`Php ${Number(item.price).toFixed(2)} each`"></div>
                                </div>
                            </div>
                            <span class="text-lg font-semibold text-gray-800 w-1/4 text-right" x-text="`Php ${(item.price * item.quantity).toFixed(2)}`"></span>
                        </li>
                    </template>
                </ul>

                <div class="mt-6 flex justify-between items-center">
                    <span class="font-semibold text-xl w-3/4">Total:</span>
                    <span class="font-semibold text-xl w-1/4 text-right" x-text="`Php ${(cart.reduce((acc, item) => acc + (item.price * item.quantity), 0)).toFixed(2)}`"></span>
                </div>
            </div>
  

            <!-- Buttons -->
            <div class="mt-6 flex justify-between">
                <button @click="goBack()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Continue Ordering
                </button>

                <button @click="checkout()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Place Order
                </button>
            </div>
        </div>

        <div x-show="cart.length === 0" class="text-gray-600">
            Your cart is empty.
        </div>

    </div>
</body>
</html>
