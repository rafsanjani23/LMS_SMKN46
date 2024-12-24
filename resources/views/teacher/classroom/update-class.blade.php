@extends('dashboard.user')

@section('content')
	<div class="p-6 mb-10">
		<div class="max-w-5xl w-full mx-auto ">
			<div class="">
				<h2 class="text-3xl font-bold mb-4">Update Class</h2>
				<hr class="h-0.5 w-full bg-black mb-10">

				<form action="{{ route('update.class', $classroom->id) }}" method="post" class="p-7 text-xl bg-white rounded-md"
					enctype="multipart/form-data" id="update-class-form">
					@csrf
					@method('put')
					<div class="flex flex-col gap-y-8">
						<div class="flex flex-col justify-center gap-3 relative">
							<label class="px-3 font-medium text-[#414141] text-opacity-50" for="title">Title<span
									class="text-red-500">*</span></label>
							<input id="title" name="title" type="text" placeholder="Type your class title here..."
								value="{{ $classroom->title }}"
								class="w-full py-4 px-3 text-[#414141] text-opacity-50 bg-[#e8e8e8] focus:outline-none rounded-md" required>
							@error('title')
								<div class="text-red-600 text-xs absolute bottom-[-20px]">
									{{ $message }}
								</div>
							@enderror
						</div>

						<div class="flex flex-col justify-center gap-3 relative">
							<label class="px-3 font-medium text-[#414141] text-opacity-50" for="class">Class<span
									class="text-red-500">*</span></label>
							<div class="bg-[#e8e8e8] w-full rounded-md relative overflow-hidden">
								<i
									class="fa-solid fa-sort-down absolute right-[12px] text-[#414141] text-opacity-50 top-1/2 translate-y-[-70%]"></i>
								<select name="class" id="class" required
									class="w-full py-4 px-3 appearance-none bg-transparent outline-none text-[#414141] text-opacity-50">
									<option value="" disabled {{ !$classroom->class ? 'selected' : '' }}>Choose the class level</option>
									<option value="x" {{ $classroom->class == 'x' ? 'selected' : '' }}>X</option>
									<option value="xi" {{ $classroom->class == 'xi' ? 'selected' : '' }}>XI</option>
									<option value="xii" {{ $classroom->class == 'xii' ? 'selected' : '' }}>XII</option>
								</select>
								@error('class')
									<div class="text-red-600 text-xs absolute bottom-[-20px]">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="flex flex-col justify-center gap-3 relative">
							<label class="px-3 font-medium text-[#414141] text-opacity-50" for="major">Major<span
									class="text-red-500">*</span></label>
							<div class="bg-[#e8e8e8] w-full rounded-md relative overflow-hidden">
								<i
									class="fa-solid fa-sort-down absolute right-[12px] text-[#414141] text-opacity-50 top-1/2 translate-y-[-70%]"></i>
								<select name="major" id="major" required
									class="w-full py-4 pl-3 pr-7 appearance-none bg-transparent outline-none text-[#414141] text-opacity-50 overflow-hidden text-ellipsis">
									<option value="" disabled {{ !$classroom->major ? 'selected' : '' }}>Select your major</option>
									<option value="pplg" {{ $classroom->major == 'pplg' ? 'selected' : '' }}>PENGEMBANGAN PERANGKAT LUNAK DAN GIM
									</option>
									<option value="dkv" {{ $classroom->major == 'dkv' ? 'selected' : '' }}>DESAIN KOMUNIKASI VISUAL</option>
									<option value="akl" {{ $classroom->major == 'akl' ? 'selected' : '' }}>AKUNTANSI DAN KEUANGAN LEMBAGA
									</option>
									<option value="bdp" {{ $classroom->major == 'bdp' ? 'selected' : '' }}>BISNIS DARING DAN PEMASARAN</option>
									<option value="otkp" {{ $classroom->major == 'otkp' ? 'selected' : '' }}>OTOMATISASI DAN TATA KELOLA
										PERKANTORAN</option>
								</select>
								@error('major')
									<div class="text-red-600 text-xs absolute bottom-[-20px]">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="flex flex-col justify-center gap-3 relative">
							<label class="px-3 font-medium text-[#414141] text-opacity-50" for="thumbnail_class">Select Thumbnail<span
									class="text-red-500">*</span></label>
							<div
								class="peer flex sm:items-center items-start text-[#414141] text-opacity-50 text-base px-3 gap-x-8 gap-y-2 sm:flex-row flex-col">
								<label class="flex cursor-pointer gap-2 items-center">
									<input type="radio" class="radio" name="upload-thumbnail" checked />
									<span>Keep existing thumbnail</span>
								</label>
								<label class="flex cursor-pointer gap-2 items-center">
									<input id="upload-new-thumbnail" type="radio" class="radio" name="upload-thumbnail" />
									<span>Upload new thumbnail</span>
								</label>
							</div>
							<div class="mt-2 hidden" id="thumbnail-class">
								<input name="thumbnail_class" type="file"
									class="w-full py-4 px-3 text-[#414141] text-opacity-50 bg-[#e8e8e8] focus:outline-none rounded-md">
							</div>
							@error('thumbnail_class')
								<div class="text-red-600 text-xs absolute bottom-[-20px]">
									{{ $message }}
								</div>
							@enderror
						</div>

						<div class="flex flex-col justify-center gap-3 relative">
							<label class="px-3 font-medium text-[#414141] text-opacity-50" for="instructions">Instructions (optional)</label>
							<textarea name="instructions" id="instructions" cols="30" rows="10"
							 placeholder="Type your class instructions here..."
							 class="resize-none p-3 border rounded-md bg-[#e8e8e8] text-[#414141] text-opacity-50 focus:outline-none">{{ $classroom->instructions }}
							</textarea>
							@error('instructions')
								<div class="text-red-600 text-xs absolute bottom-[-20px]">
									{{ $message }}
								</div>
							@enderror
						</div>
					</div>

					<button type="submit"
						class="w-full py-4 bg-[#4A5B92] hover:bg-[#3f4e7c] text-xl font-semibold mt-10 text-white rounded-md">Update
						Class</button>
				</form>
			</div>
		</div>
	</div>
@endsection
