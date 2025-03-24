<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiosk - Order Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 font-sans" x-data="{ showModal: false, selectedProduct: {} }">
    <header class="bg-green-600 text-white p-6 text-center">
        <h1 class="text-3xl font-bold">Welcome to Food For Life</h1>
    </header>

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
                    <div class="bg-white p-4 rounded-lg shadow-lg text-center">
                        @if($product->image)
                            <img src="{{ asset('product/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 mx-auto object-cover mb-4">
                        @else
                            <div class="w-32 h-32 mx-auto bg-gray-300 flex items-center justify-center text-gray-500">No Image</div>
                        @endif
                        <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                        <p class="text-gray-600">Php{{ $product->price }}</p>
                        <button @click="showModal = true; selectedProduct = { 
                                    name: '{{ $product->name }}', 
                                    price: '{{ $product->price }}', 
                                    image: '{{ asset('product/' . $product->image) }}', 
                                    details: '{{ $product->details ?? 'No details available' }}' 
                                }" 
                                class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            Add to cart
                        </button>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Section -->
            <div class="mt-6 flex justify-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center" x-cloak>
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center relative">
            <button @click="showModal = false" class="absolute top-2 right-2 text-gray-500">&times;</button>
            <template x-if="selectedProduct.image">
                <img :src="selectedProduct.image" alt="Product Image" class="w-32 h-32 mx-auto mb-4">
            </template>
            <h2 class="text-xl font-bold" x-text="selectedProduct.name"></h2>
            <p class="text-gray-600">Price: Php <span x-text="selectedProduct.price"></span></p>
            <p class="text-gray-600">Details: <span x-text="selectedProduct.details"></span></p>
            <button @click="showModal = false" class="mt-4 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Close</button>
        </div>
    </div>
</body>
</html>