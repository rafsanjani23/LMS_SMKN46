@extends('dashboard.user')

@section('content')
	<div class="p-6 mb-10">
		<div class="max-w-5xl w-full mx-auto ">
			<div>
				<h2 class="text-3xl font-bold mb-4">{{ $title ?? 'Upload Material' }}</h2>
				<hr class="h-0.5 w-full bg-black mb-10">

				<form action="{{ route('add.material', $classroom->id) }}" method="post" class="p-7 text-xl bg-white rounded-md"
					enctype="multipart/form-data" id="add-material-form">
					@csrf
					<div class="flex flex-col gap-y-8">
						<div class="flex flex-col justify-center gap-3 relative">
							<label class="px-3 font-medium text-[#414141] text-opacity-50" for="title">Title<span
									class="text-red-500">*</span></label>
							<input id="title" name="title" type="text" placeholder="Type your title here..."
								class="w-full py-4 px-3 text-[#414141] text-opacity-50 bg-[#e8e8e8] focus:outline-none rounded-md" required>
							@error('title')
								<div class="text-red-600 text-xs absolute bottom-[-20px]">
									{{ $message }}
								</div>
							@enderror
						</div>

						<div class="flex flex-col justify-center gap-3 relative">
							<label class="px-3 font-medium text-[#414141] text-opacity-50" for="description">Description</label>
							<textarea name="description" id="description" cols="30" rows="10" placeholder="Type your description here..."
							 class="resize-none p-3 border rounded-md bg-[#e8e8e8] text-[#414141] text-opacity-50 focus:outline-none"></textarea>
							@error('description')
								<div class="text-red-600 text-xs absolute bottom-[-20px]">
									{{ $message }}
								</div>
							@enderror
						</div>

						@if (Str::contains(request()->url(), 'add-assignment'))
							<div class="flex flex-col justify-center gap-3 relative">
								<label class="px-3 font-medium text-[#414141] text-opacity-50" for="deadline">Deadline</label>
								<input id="deadline" name="deadline" type="datetime-local"
									class="w-full py-4 px-3 text-[#414141] text-opacity-50 bg-[#e8e8e8] focus:outline-none rounded-md">
								@error('deadline')
									<div class="text-red-600 text-xs absolute bottom-[-20px]">
										{{ $message }}
									</div>
								@enderror
							</div>
						@endif

						<div class="flex flex-col justify-center gap-3 relative">
							@if (Str::contains(request()->url(), 'add-material-video'))
								<label class="px-3 font-medium text-[#414141] text-opacity-50" for="video_link">Video Link<span
										class="text-red-500">*</span></label>
								<input id="video_link" name="video_link"
									class="w-full py-4 px-3 text-[#414141] text-opacity-50 bg-[#e8e8e8] focus:outline-none rounded-md"
									placeholder="Type video link for material here..." required>
								@error('video_link')
									<div class="text-red-600 text-xs absolute bottom-[-20px]">
										{{ $message }}
									</div>
								@enderror
							@else
								<label class="px-3 font-medium text-[#414141] text-opacity-50" for="file_path">Select File<span
										class="text-red-500">*</span></label>
								<input id="file_path" name="file_path" type="file" accept=".pdf, .ppt, .pptx"
									class="w-full py-4 px-3 text-[#414141] text-opacity-50 bg-[#e8e8e8] focus:outline-none rounded-md" required>
								@error('file_path')
									<div class="text-red-600 text-xs absolute bottom-[-20px]">
										{{ $message }}
									</div>
								@enderror
							@endif
						</div>
					</div>

					<input type="text" class="hidden" name="material_type" value="{{ request()->path() }}">
					<button type="submit"
						class="w-full py-4 bg-[#4A5B92] hover:bg-[#3f4e7c] text-xl font-semibold mt-10 text-white rounded-md">Upload
						Content</button>
				</form>
			</div>
		</div>
	</div>
@endsection
