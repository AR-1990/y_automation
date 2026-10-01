<!DOCTYPE html>
<html lang="en" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - AISM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen selection:bg-indigo-100 selection:text-indigo-900">

    <div class="w-full max-w-md p-8">
        <!-- Logo -->
        <div class="text-center mb-10">
            <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-indigo-200">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Welcome Back</h1>
            <p class="text-slate-500 mt-1 font-medium">Sign in to AISM Engine</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100">
            
            @if($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-xl text-sm mb-6 font-medium">
                {{ $errors->first() }}
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all"
                        placeholder="admin@koder360.com">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-slate-700">Password</label>
                        <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">Forgot?</a>
                    </div>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all"
                        placeholder="••••••••">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 cursor-pointer">
                    <label for="remember" class="ml-2 text-sm font-medium text-slate-600 cursor-pointer">Remember me for 30 days</label>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3.5 rounded-xl hover:bg-indigo-700 shadow-sm shadow-indigo-200 transition-all active:scale-[0.98]">
                    Sign In to Dashboard
                </button>
            </form>
        </div>
        
        <p class="text-center text-slate-400 text-sm mt-8 font-medium">
            Protected by Koder360 Security
        </p>
    </div>

</body>
</html>