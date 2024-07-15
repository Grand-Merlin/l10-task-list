<!DOCTYPE html>
<html>

<head>
    <title>Laravel Task List App</title>
    {{-- inclut Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- inclut Alpine.js --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    {{-- Désactiver le formatteur blade pour le code qui suit, pour éviter de casser les synthaxe de tailwind assurant que le CSS reste fonctionnel --}}
    {{-- blade-formatter-disable --}}
        <style type="text/tailwindcss">
            .btn{
                @apply rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-100 text-slate-700
            }
            .link{
                @apply font-medium text-gray-700 underline decoration-pink-500
            }
            label{
                @apply block uppercase text-slate-700 mb-2
            }
            input, textarea{
                @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none
            }
            .error{
                @apply text-red-500 text-sm
            }
        </style>
        {{-- On reactive le formatreur blade pour le reste du code --}}
        {{-- blade-formatter-enable --}}

    @yield('styles')
</head>

<body class="container mx-auto mt-10 mb-10 max-w-lg">
    <h1 class="mb-4 text-2xl">@yield('title')</h1>
    <!-- Initialise la variable 'flash' à true avec Alpine.js -->
    <div x-data="{ flash: true }">
            {{-- permet d'afficher le message flash stocké dans la session de l'utilisateur --}}
            @if (session()->has('success'))
                
                <!-- Affiche l'élément si la variable 'flash' est vraie -->
                <div x-show="flash"
                class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
                role="alert">
                <strong class="font-bold">Success</strong>
                <div>{{ session('success')}}</div>
                
                {{-- absolute = positionner par rapport a son 1er ancetre positionner (relative, absolute ou fixe) --}}
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" 
                    {{-- Lorsque l'utilisateur clique sur le SVG, la variable 'flash' est définie sur false --}}
                    @click="flash = false"
                    stroke="currentColor" class="h-6 w-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        </div>
        @endif
        @yield('content')
    </div>
</body>

</html>
