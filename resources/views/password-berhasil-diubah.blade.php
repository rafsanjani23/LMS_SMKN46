@extends('components.layouts.layoutsForm')

@section('content')
<div class="flex flex-col items-center justify-center h-screen text-center">
    <img src="https://cdn-icons-png.flaticon.com/256/6486/6486200.png" alt="Reset Password Sent" class="mb-6">
    <p class="text-lg font-semibold text-gray-700">Password berhasil diubah!</p>
    <a href="/login" class="inline-block bg-[#4A5B92] text-white px-4 py-2 rounded">Kembali ke Halaman Login</a>
</div>
@endsection
