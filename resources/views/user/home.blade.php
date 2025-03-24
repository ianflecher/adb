<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiosk Home</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 flex items-center justify-center h-screen relative">

    <!-- Admin Login Image Button (Top Right) -->
    <a href="{{ url('/admin') }}" class="absolute top-4 right-4">
        <img src="admin.png" alt="Admin Login" class="w-12 h-12">
    </a>    

    <div class="bg-green h-screen w-screen flex">
        <!-- Left: Image Section -->
        <div class="w-1/2 flex items-center justify-center p-4">
            <img src="home.jpg" alt="Food for Life" class="w-full h-full object-cover rounded-lg">
        </div>

        <!-- Right: Text Section -->
        <div class="w-1/2 flex flex-col items-center justify-center text-center p-6">
            <h1 class="text-5xl font-extrabold text-blue-600">Welcome To Food for Life</h1>
            <p class="text-xl text-gray-700 mt-4">Select an option to continue</p>

            <div class="mt-6 flex flex-col gap-4 w-3/4">
                <a href="{{ url('/user') }}" class="w-full">
                    <button class="px-6 py-4 bg-green-500 text-white rounded-lg text-2xl font-semibold hover:bg-green-600 w-full">
                        Start
                    </button>
                </a>                
                <button class="px-6 py-4 bg-gray-500 text-white rounded-lg text-2xl font-semibold hover:bg-gray-600 w-full">
                    Help
                </button>
            </div>
        </div>
    </div>

</body>
</html>
