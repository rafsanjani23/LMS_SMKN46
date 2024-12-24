@extends('dashboard.user')
@section('content')
	<div class="p-6 mb-48">
		<div class="max-w-5xl w-full mx-auto ">
			<div class="pl-16 pt-3 relative">
				<div class="w-[50px] h-[50px] bg-[#4A5B92] flex items-center justify-center rounded-full absolute top-[3px] left-0">
					<i class="fa-solid fa-book-bookmark text-xl text-[#D4DDF9]"></i>
				</div>
				<h2 class="text-2xl font-bold relative">
					{{ $material->title }}
				</h2>

				<div class="flex items-center gap-3">
					<p>{{ $classroom->teacher->fullname }}</p>
					<div class="size-1 rounded-full bg-black"></div>
					<p>{{ Carbon\Carbon::parse($material->created_at)->format('d F Y') }}</p>
				</div>

				<hr class="h-0.5 w-full bg-black my-5">

				<p>{{ $material->description }}</p>

				@if ($material->file_path != null)
					<a href="{{ Storage::url($material->file_path) }}" target="_blank" class="block my-5">
						<div class="bg-white border-2 border-[#919191] rounded-md flex items-center gap-4 px-6 py-4">
							<div class="min-w-[40px] min-h-[40px] bg-[#D4DDF9] flex items-center justify-center rounded-full">
								<i class="fa-regular fa-file text-xl text-[#4A5B92]"></i>
							</div>
							<div>
								<p class="font-bold">{{ $material->file_name }}</p>
								<p>{{ Str::upper($material->type) }}</p>
							</div>
						</div>
					</a>
				@else
					<div class="my-5">
						<p class="font-semibold">Link video:</p>
						<a href="{{ $material->video_link }}" class="text-blue-500 underline">{{ $material->video_link }}</a>
					</div>
				@endif


			</div>
		</div>
	</div>
@endsection
