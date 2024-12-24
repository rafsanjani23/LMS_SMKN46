@extends('dashboard.user')
@section('content')
	<div class="sm:p-6 p-4 mb-8">
		<div class="max-w-5xl w-full bg-white mx-auto rounded-md">
			<div class="sm:p-7 p-5">
				<div class="flex items-center justify-between">
					<div class="flex items-center sm:gap-10 gap-5 sm:text-2xl text-lg font-bold text-[#757575]">
						<a href="{{ route('student.classwork', $classroom) }}"
							class="{{ str_contains(request()->path(), 'classwork') ? 'text-[#4A5B92] border-b-[3px] border-[#4A5B92]' : '' }}">
							Classwork
						</a>
						<a href="{{ route('student.classwork.people', $classroom) }}"
							class="{{ str_contains(request()->path(), 'people') ? 'text-[#4A5B92] border-b-[3px] border-[#4A5B92]' : '' }}">People</a>
					</div>
				</div>

				<div class="mt-7">
					<div class="flex md:flex-row flex-col gap-5">
						<div class="md:w-[250px] w-full md:h-[200px] sm:h-[300px] h-[250px] rounded-md overflow-hidden flex-shrink-0">
							<img class="w-full h-full object-cover" src="{{ Storage::url($classroom->thumbnail_class) }}" alt="">
						</div>
						<div>
							<h2 class="font-bold text-3xl">{{ $classroom->title }}</h2>
							<p class="font-semibold text-lg my-3">Kelas {{ $classroom->classToNumber() }}</p>
							<p class="font-semibold text-lg">{{ $classroom->teacher->fullname }}</p>
							<p class="mt-4">{{ $classroom->instructions }}</p>
						</div>
					</div>


					{{-- Material --}}
					<div class="flex flex-col gap-4 mt-8">
						@forelse ($materials as $index => $material)
							@if ($material->material_type == 'video')
								<div class="w-full bg-[#e8e8e8] flex items-center justify-between rounded-md overflow-hidden">
									<a href="{{ route('student.material', ['classroom' => $classroom, 'material' => $material]) }}"
										class="block w-full py-4 h-full">
										<div class="flex items-center gap-x-6 sm:pl-10 pl-4">
											<i class="fa-solid fa-play text-4xl text-[#4A5B92]"></i>
											<p class="font-medium text-lg">{{ $material->title }}</p>
										</div>
									</a>
								</div>
							@elseif ($material->material_type == 'file')
								<div class="w-full bg-[#e8e8e8] flex items-center justify-between rounded-md overflow-hidden">
									<a href="{{ route('student.material', ['classroom' => $classroom, 'material' => $material]) }}"
										class="block w-full py-4 h-full">
										<div class="flex items-center gap-x-6  sm:pl-10 pl-4">
											<i class="fa-regular fa-file text-4xl text-[#4A5B92]"></i>
											<p class="font-medium text-lg">{{ $material->title }}</p>
										</div>
									</a>
								</div>
							@else
								<div class="w-full bg-[#e8e8e8] flex items-center justify-between rounded-md overflow-hidden">
									<a href="{{ route('student.show.assignment', ['classroom' => $classroom, 'material' => $material]) }}"
										class="block w-full py-4 h-full">
										<div class="flex items-center gap-x-6  sm:pl-10 pl-4">
											<i class="fa-regular fa-file-lines text-4xl text-[#4A5B92]"></i>
											<p class="font-medium text-lg">{{ $material->title }}</p>
										</div>
									</a>
								</div>
							@endif
						@empty
							<p class="text-lg w-full text-center mt-10">No material available</p>
						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
