@extends("layouts/page-layout")

@section("content")
    <div class="mx-auto mt-8 max-w-md overflow-hidden rounded-xl bg-white shadow-md md:max-w-2xl">
        <div class="p-8 flex flex-col w-full">
            <div class="text-xl font-semibold tracking-wide text-indigo-500 uppercase mx-auto mb-2">Login</div>
            <form class="pt-3" method="post" action="{{ route('auth.login') }}">
                @csrf
                <x-input
                    label="Email"
                    placeholder="Email"
                    inputName="email"
                    type="email"
                    required
                    autocomplete
                    :value="old('email') ?? ''"
                />

                <x-input
                    label="Password"
                    placeholder="Password"
                    inputName="password"
                    type="password"
                    required
                    autocomplete
                />

                <div class="mb-4">
                    @error('generic')
                    <p class="text-red-500 text-xs italic my-2">{{$message}}</p>
                    @enderror
                    <x-button
                        buttonType="primary"
                        type="submit"
                        label="Login"
                    />
                </div>

                <div class="text-center">
                    Don't have an account? <a href="{{ route('auth.register.page') }}" class="text-indigo-400">Register here</a>
                </div>
            </form>
        </div>
    </div>
@endsection
