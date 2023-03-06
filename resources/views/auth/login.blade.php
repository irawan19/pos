<x-app-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Email / Username</label>
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Email / Username" aria-label="Auth" aria-describedby="email-addon" name="auth" value="{{Request::old('auth')}}" required autofocus>
        </div>
        <label>Password</label>
        <div class="mb-3">
            <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon"  name="password" required autocomplete="current-password">
        </div>
        <div style="text-align:left">
        <x-validation-errors class="mb-4" />
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        </div>
        <div class="text-center">
            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Login</button>
        </div>
    </form>
</x-app-layout>