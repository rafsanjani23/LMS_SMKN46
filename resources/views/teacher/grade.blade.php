@extends('dashboard.user')
@section('content')
	<div class="max-w-[1000px] px-5 w-full h-full mx-auto pb-14">
		{{-- My Classes --}}
		<div class="my-10">
			<h2 class="text-3xl mb-4 font-bold">Grade</h2>
			<hr class="h-0.5 w-full bg-black mb-5">
			<div class="w-full flex flex-col">
				@forelse ($assignments as $assignment)
					<a href="{{ route('show.grade.submission', $assignment) }}" class="block my-3">
						<div class="bg-white border-2 border-[#686464] rounded-md flex items-center gap-4 px-6 py-4">
							<div class="min-w-[40px] min-h-[40px] bg-[#D4DDF9] flex items-center justify-center rounded-full">
								<i class="fa-regular fa-file-lines text-xl text-[#4A5B92]"></i>
							</div>
							<div>
								<p class="font-bold">{{ $assignment->title }}</p>
								<p>Class: {{ $assignment->classroom->title }}</p>
							</div>
						</div>
					</a>
				@empty
				@endforelse
			</div>
		</div>
	</div>
@endsection
