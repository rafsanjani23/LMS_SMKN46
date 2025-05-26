@extends('components.layouts.layoutsForm')

@section('content')
<!-- Reset Password Card -->
<form class="card-container flex justify-center mt-44" action="{{ route('reset-password.send') }}" method="POST">
    
    @csrf
    <div class="card mt-24 bg-white/50 rounded-3xl min-w-[400px] transition-transform duration-500">
        <div class="card-body">
            <h2 class="card-header font-bold text-2xl mb-4">Reset Password</h2>
            <div class="w-full mb-4">
                <div class="flex items-center border-b border-gray-300 pb-2">
                    <i class="fa-solid fa-envelope text-gray-500 mr-2"></i>
                    <input type="text" placeholder="Alamat Email Anda" required name="email" class="w-full bg-transparent focus:outline-none placeholder-gray-400 text-gray-700">
                </div>
            </div>
            <button type="submit" class="btn hover:bg-[#4A5B92] hover:text-white">
                <p class="font-semibold">Submit</p>
            </button>
        </div>
    </div>
</form>
</div>
@endsection
