<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto mt-8">
        <div class="text-center mb-6">
            <img src="/admin.png" alt="Admin" class="mx-auto h-16 mb-4">
            <h2 class="text-2xl font-bold text-gray-700">Add Product</h2>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <input type="text" name="name" placeholder="Product Name"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <select name="category_id" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>                
            </div>

            <div class="mb-4">
                <input type="file" name="image"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <input type="text" name="price" placeholder="Price"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <textarea name="details" placeholder="Item Details"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>

            <button type="submit"
                class="w-full bg-blue-500 text-white py-3 rounded-lg font-semibold hover:bg-blue-600">
                Add Product
            </button>
        </form>
    </div>
</body>

</html>
