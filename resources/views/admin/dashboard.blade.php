<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Admin Header Section -->
    <header class="bg-blue-600 text-white p-6">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Welcome, {{ session('admin_name') }}</h1>
            <a href="{{ route('admin.logout') }}" class="text-white hover:text-gray-300">Logout</a>
        </div>
    </header>

    <!-- Main Content Section -->
    <div class="container mx-auto p-8">
        @if(session('success'))
                <div class="bg-green-500 text-white p-4 mb-6 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

        <!-- Add New Product Button -->
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('product.add') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Add New Product</a>
            
            <!-- Category Dropdown -->
            <form method="GET" action="{{ route('admin.dashboard') }}">
                <select name="category" class="border p-2 rounded-lg" onchange="this.form.submit()">
                    <option value="" {{ request('category') == '' ? 'selected' : '' }}>All Products</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Products Table Section -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Manage Products</h2>

            <!-- Product List Table -->
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr>
                        <th class="border-b p-3 text-left">Product Name</th>
                        <th class="border-b p-3 text-left">Category</th>
                        <th class="border-b p-3 text-left">Price</th>
                        <th class="border-b p-3 text-left">Image</th>
                        <th class="border-b p-3 text-left">Item Details</th>
                        <th class="border-b p-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="border-b p-3">{{ $product->name }}</td>
                            <td class="border-b p-3">{{ $product->category ? $product->category->category_name : 'No Category' }}</td>
                            <td class="border-b p-3">Php{{ $product->price }}</td>
                            <td class="border-b p-3">
                                @if($product->image)
                                    <img src="{{ asset('product/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td class="border-b p-3">{{ $product->details ?? 'No Details Available' }}</td>
                            <td class="border-b p-3">
                                <a href="{}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline ml-4" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>                
            </table>

            <!-- Pagination -->
            @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $products->appends(request()->query())->links() }}
            @endif
        </div>
    </div>
</body>
</html>
