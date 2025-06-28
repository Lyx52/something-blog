@extends("layouts/page-layout")

@section("content")
    <div class="mx-auto mt-8 max-w-md overflow-hidden rounded-xl bg-white shadow-md md:max-w-2xl">
        <div class="p-8 flex flex-col w-100">
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
                    <button
                        type="submit"
                        class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 transition duration-300 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline cursor-pointer">
                        Login
                    </button>
                </div>

                <div class="text-center">
                    Don't have an account? <a href="{{ route('auth.register.page') }}" class="text-indigo-400">Register here</a>
                </div>
            </form>
        </div>
    </div>
@endsection
