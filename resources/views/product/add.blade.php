<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Add Product Form with Admin Image -->
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto mt-8">
        <!-- Admin Image Inside Form -->
        <div class="text-center mb-6">
            <img src="/admin.png" alt="Admin" class="mx-auto h-16 mb-4">
            <h2 class="text-2xl font-bold text-gray-700">Add Product</h2>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Product Name -->
            <div class="mb-4">
                <input type="text" name="name" placeholder="Product Name"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Category Selection -->
            <div class="mb-4">
                <select name="category" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>Select Category</option>
                    <option value="fruits_vegetables">Fruits and Vegetables</option>
                    <option value="legumes_beans">Legumes and Beans</option>
                    <option value="grains_cereals">Grains and Cereals</option>
                    <option value="nuts_seeds">Nuts and Seeds</option>
                    <option value="plant_based_proteins">Plant-Based Proteins</option>
                    <option value="dairy_alternatives">Dairy Alternatives</option>
                    <option value="breads_wraps">Breads and Wraps</option>
                    <option value="condiments_sauces">Condiments and Sauces</option>
                    <option value="vegan_snacks">Vegan Snacks</option>
                    <option value="desserts_sweets">Desserts and Sweets</option>
                </select>                
            </div>

            <!-- Product Image -->
            <div class="mb-4">
                <input type="file" name="image"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Price -->
            <div class="mb-4">
                <input type="text" name="price" placeholder="Price"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Item Details -->
            <div class="mb-4">
                <textarea name="details" placeholder="Item Details"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-500 text-white py-3 rounded-lg font-semibold hover:bg-blue-600">
                Add Product
            </button>
        </form>
    </div>

</body>

</html>
