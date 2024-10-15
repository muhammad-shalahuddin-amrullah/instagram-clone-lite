<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-xs">
        <div class="text-center mb-8">
            <div class="relative inline-block">
                <button class="text-gray-500">English <i class="fas fa-chevron-down"></i></button>
            </div>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md">
            <div class="text-center mb-4">
                <img src="{{ asset('/images/logo-instagram.png') }}" alt="Instagram" class="h-10 w-30 mx-auto">
            </div>
            <form class="space-y-4" action="{{ route('register.store') }}" method="post">
                @csrf
                <input type="text" name="name" placeholder="Full name" value="{{ old('name') }}" class="w-full px-4 py-2 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
                <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" class="w-full px-4 py-2 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('username')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="w-full px-4 py-2 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
                <div class="relative">
                    <input id="password" name="password" type="password" placeholder="Password" value="{{ old('password') }}" class="w-full px-4 py-2 border rounded bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i id="togglePassword" class="fas fa-eye-slash absolute right-3 top-3 text-gray-500 cursor-pointer"></i>
                </div>
                @error('password')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
                <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded font-semibold">Sign Up</button>
            </form>
            <div class="text-center mt-4">
                <p class="text-gray-500">Already have an account? <a href="/login" class="text-blue-500 font-semibold">Sign in.</a></p>
            </div>
            <div class="flex items-center my-4">
                <hr class="flex-grow border-gray-300">
                <span class="mx-2 text-gray-500">OR</span>
                <hr class="flex-grow border-gray-300">
            </div>
            <button class="w-full py-2 bg-blue-600 text-white rounded font-semibold flex items-center justify-center">
                <i class="fab fa-facebook-f mr-2"></i> Sign Up with Facebook
            </button>
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
