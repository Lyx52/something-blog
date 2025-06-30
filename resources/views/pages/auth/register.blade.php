@extends("layouts/page-layout")

@section("content")
<div class="mx-auto mt-8 max-w-md overflow-hidden rounded-xl bg-white shadow-md md:max-w-2xl">
    <div class="p-8 flex flex-col w-full">
        <div class="text-xl font-semibold tracking-wide text-indigo-500 uppercase mx-auto mb-2">Register</div>
        <form class="pt-3" method="post" action="{{ route('auth.register') }}" autocomplete="off">
            @csrf
            <x-input
                label="Username"
                placeholder="Username"
                inputName="username"
                type="text"
                required
                autocomplete="off"
                :value="old('username') ?? ''"
            />

            <x-input
                label="Email"
                placeholder="email@example.com"
                inputName="email"
                type="email"
                required
                autocomplete="off"
                :value="old('email') ?? ''"
            />

            <x-input
                label="Password"
                placeholder="Password"
                inputName="password"
                type="password"
                required
                autocomplete="off"
            />

            <x-input
                label="Password Confirmation"
                placeholder="Password Confirmation"
                inputName="password_confirmation"
                type="password"
                required
                autocomplete="off"
            />

            <div class="mb-4">
                @error('generic')
                <p class="text-red-500 text-xs italic mt-2">{{$message}}</p>
                @enderror
                <x-button
                    buttonType="primary"
                    type="submit"
                    label="Register"
                />
            </div>

            <div class="text-center">
                Already have an account? <a href="{{ route('auth.login.page') }}" class="text-indigo-400">Login here</a>
            </div>
        </form>
    </div>
</div>
@endsection
