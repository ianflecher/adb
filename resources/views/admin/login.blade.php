<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96 text-center">
        <img src="{{ asset('admin.png') }}" alt="Admin Logo" class="w-24 h-24 mx-auto mb-4">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Admin Login</h2>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="mb-4">
                <input type="email" name="email" placeholder="Email"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <input type="password" name="password" placeholder="Password"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg font-semibold hover:bg-blue-600">
                Login
            </button>
        </form>

        <a href="{{ url('/') }}" class="block mt-4 text-blue-500 hover:underline">Back to Home</a>
    </div>

</body>
</html>
