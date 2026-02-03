<nav class="flex justify-between p-5 bg-white border-b-1 border-gray-200">  
           
    <h1>
        <a href="/" class="text-2xl font-extrabold">FabLab</a>
    </h1> 

    <div>
        <x-navlink href="/" :active="request()->is('/')">
            <x-icons.package/>
            Browse parts
        </x-navlink>
        <x-navlink href="/cart" :active="request()->is('cart')">
            <x-icons.cart/>
            Cart
        </x-navlink>
        @guest
        <x-navlink href="/login" :active="request()->is('login')">
            <x-icons.login/>
            Log In
        </x-navlink>
        <x-navlink href="/register" :active="request()->is('register')" class="border-gray-400" style="border-width:0.5px">
            <x-icons.signup/>
            Sign Up
        </x-navlink>
        @endguest

        @auth 
        <x-navlink href="profile" :active="request()->is('/profile')">Profile</x-navlink>
        <x-navlink href="logout" >Log Out</x-navlink>
        @endauth
    </div>

</nav>