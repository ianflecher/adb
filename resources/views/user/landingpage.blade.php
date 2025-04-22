<!DOCTYPE html>
<html lang="en" x-data="kioskApp()" x-init="initCart">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiosk - Order Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-green-600 text-white p-6 text-center">
        <h1 class="text-3xl font-bold">Welcome to Food For Life</h1>
    </header>

    @if(session('success'))
        <div class="fixed top-0 left-0 w-full bg-green-500 text-white p-4 text-center">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- Cart Button -->
<div class="fixed top-6 right-6 z-10">
    <button @click="showCart = true" class="relative p-2 bg-green-600 rounded-full shadow-lg">
        <img src="{{ asset('cart.png') }}" alt="Cart" class="w-8 h-8">
        <span x-show="cart.length > 0" x-text="cart.length"
              class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center"
              x-cloak></span>
    </button>
</div>


    <!-- Cart Modal -->
    <div x-show="showCart" class="fixed inset-y-0 right-0 w-80 bg-white shadow-lg p-6 transition-transform duration-300" :class="showCart ? 'translate-x-0' : 'translate-x-full'" x-cloak>
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-green-600">Shopping Cart</h2>
            <button @click="showCart = false" class="text-gray-500 text-lg">&times;</button>
        </div>

        <template x-if="cart.length === 0">
            <p class="text-gray-600">Your cart is empty.</p>
        </template>

        <ul>
    <template x-for="(item, index) in cart" :key="index">
        <li class="flex items-start gap-4 py-2 border-b text-sm">
            <img :src="item.image" alt="Product" class="w-16 h-16 object-cover rounded shadow">

            <div class="flex-1">
                <p class="font-semibold" x-text="item.name"></p>
                <p class="text-gray-500">Php <span x-text="item.price"></span></p>
                <div class="flex items-center mt-2 space-x-2">
                    <button @click="decreaseQuantity(index)" class="px-2 py-1 bg-gray-300 rounded">–</button>
                    <span x-text="item.quantity"></span>
                    <button @click="increaseQuantity(index)" class="px-2 py-1 bg-gray-300 rounded">+</button>
                </div>
            </div>

            <button @click="removeFromCart(index)" class="text-red-500 hover:opacity-75">
                <img src="{{ asset('trash.png') }}" alt="Remove" class="w-5 h-5">
            </button>
        </li>
    </template>
</ul>


        <button @click="showCart = false" class="mt-4 w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Close</button>
        
        <button @click="checkout()" class="mt-4 w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Proceed to Checkout
            </button>

</form>

    </div>

    <div class="container mx-auto p-8 flex">
        <aside class="w-64 bg-white p-4 rounded-lg shadow-lg mr-8">
            <h2 class="text-xl font-bold mb-4 text-green-600">Categories</h2>
            <form method="GET" action="{{ route('user.landingpage') }}">
                <ul>
                    <li class="mb-2">
                        <button type="submit" name="category" value="" class="w-full text-left p-2 rounded-lg text-gray-700 hover:bg-green-100 {{ request('category') == '' ? 'bg-green-200 font-bold' : '' }}">
                            All Products
                        </button>
                    </li>
                    @foreach($categories as $category)
                        <li class="mb-2">
                            <button type="submit" name="category" value="{{ $category->id }}" class="w-full text-left p-2 rounded-lg text-gray-700 hover:bg-green-100 {{ request('category') == $category->id ? 'bg-green-200 font-bold' : '' }}">
                                {{ $category->category_name }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </form>
        </aside>

        <div class="flex-1">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white p-4 rounded-lg shadow-lg text-center flex flex-col justify-between">
                        <div class="flex flex-col items-center mb-4">
                            @if($product->image)
                                <img src="{{ asset('product/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover mb-4">
                            @else
                                <div class="w-32 h-32 bg-gray-300 flex items-center justify-center text-gray-500 mb-4">No Image</div>
                            @endif
                            <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                            <p class="text-gray-600">Php {{ number_format($product->price, 2) }}</p>
                        </div>
                        <button 
                            @click="selectedProduct = { 
                                id: '{{ $product->id }}',
                                name: '{{ $product->name }}', 
                                price: '{{ $product->price }}', 
                                image: '{{ asset('product/' . $product->image) }}', 
                                details: '{{ $product->details ?? 'No details available' }}' 
                            }; showModal = true" 
                            class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 focus:outline-none">
                            See details
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <!-- Product Modal -->
    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" x-cloak>
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center relative">
            <button @click="showModal = false" class="absolute top-2 right-2 text-gray-500">&times;</button>
            <template x-if="selectedProduct.image">
                <img :src="selectedProduct.image" alt="Product Image" class="w-32 h-32 mx-auto mb-4">
            </template>
            <h2 class="text-xl font-semibold" x-text="selectedProduct.name"></h2>
            <p class="text-gray-600">Price: Php <span x-text="selectedProduct.price"></span></p>
            <p class="text-gray-600 mb-4">Details: <span x-text="selectedProduct.details"></span></p>
            <button @click="addToCart(selectedProduct)" class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Add to Cart</button>
            <button @click="showModal = false" class="mt-2 bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500">Close</button>
        </div>
    </div>

    <script>
    function kioskApp() {
        return {
            showModal: false,
            showCart: false,
            selectedProduct: {},
            cart: [],

            initCart() {
                const savedCart = localStorage.getItem('cart');
                if (savedCart) {
                    this.cart = JSON.parse(savedCart);
                }
            },

            saveCart() {
                localStorage.setItem('cart', JSON.stringify(this.cart));
            },

            addToCart(product) {
            const existing = this.cart.find(item => item.id === product.id);
            if (existing) {
                existing.quantity++;
            } else {
                this.cart.push({ ...product, quantity: 1 });
            }

            // Save cart in localStorage
            this.saveCart();
            // Save cart in session (if you are doing AJAX or some server-side call)
            axios.post('/save-cart', { cart: this.cart }).then(response => {
                this.showModal = false;
                this.showCart = true;
                this.$refs.cartInput.value = JSON.stringify(this.cart);
            });
        },
            increaseQuantity(index) {
                this.cart[index].quantity++;
                this.saveCart();
            },

            decreaseQuantity(index) {
                if (this.cart[index].quantity > 1) {
                    this.cart[index].quantity--;
                } else {
                    this.removeFromCart(index);
                }
                this.saveCart();
            },

            removeFromCart(index) {
                this.cart.splice(index, 1);
                this.saveCart();
            },
            checkout() {
    window.location.href = 'user/checkout';
}

        }
    }
</script>

</body>
</html>
