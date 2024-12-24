@extends('dashboard.user')
{{-- @dd($assignment->count()) --}}
@section('content')
	@if (session()->has('assignment.success'))
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				successAlert("{{ session('assignment.success') }}")
			})
		</script>
	@endif
	<div class="p-6 mb-48">
		<div class="max-w-5xl w-full mx-auto ">
			<div class="pl-16 pt-3 relative">
				<div class="w-[50px] h-[50px] bg-[#4A5B92] flex items-center justify-center rounded-full absolute top-[3px] left-0">
					<i class="fa-solid fa-book-bookmark text-xl text-[#D4DDF9]"></i>
				</div>
				<h2 class="text-2xl font-bold relative">
					{{ $material->title }}
				</h2>

				<div>
					<p>Deadline at {{ Carbon\Carbon::parse($material->deadline)->format('d F Y, H:i') }}</p>
				</div>

				<hr class="h-0.5 w-full bg-black my-5">

				<p>{{ $material->description }}</p>

				<a href="{{ Storage::url($material->file_path) }}" class="block my-5">
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

				<div class="mt-8 flex items-center justify-between ">
					<p class="text-xl font-bold">Your Work</p>
					<p id="isAssigned" class="font-medium text-lg text-red-500">Assigned</p>
				</div>

				<hr class="h-0.5 w-full bg-black my-5">

				<form action="{{ route('submit.assignment', ['classroom' => $classroom, 'material' => $material]) }}" method="POST"
					enctype="multipart/form-data" id="student-assignment-form">
					@csrf
					<div class="flex flex-col items-center gap-4">
						<!-- File Display -->
						<div id="file-display" class="w-full"></div>

						@if ($assignment)
							<a href="{{ Storage::url($assignment->file_path) }}" class="block w-full" id="student-assignment">
								<div class="bg-white border-2 border-[#919191] rounded-md flex items-center gap-4 px-6 py-4">
									<div class="min-w-[40px] min-h-[40px] bg-[#D4DDF9] flex items-center justify-center rounded-full">
										<i class="fa-regular fa-file text-xl text-[#4A5B92]"></i>
									</div>
									<div>
										<p class="font-bold">{{ $assignment->file_name }}</p>
										<p>{{ Str::upper($assignment->file_type) }}</p>
									</div>
								</div>
							</a>
							<div id="unsubmit"
								class="cursor-pointer w-full py-3 text-center rounded-md text-lg font-bold border-2 border-[#919191] text-[#4A5B92] hover:bg-[#4A5B92] hover:text-white">
								Unsubmit
							</div>
							<div id="file-button"
								class="add-assignment cursor-pointer w-full py-3 bg-[#A9BBF4] text-center rounded-md text-lg font-bold hover:bg-[#9eafe5] hidden"
								onclick="document.getElementById('file-input').click();">
								+ Add Assignment
							</div>
						@else
							<!-- Add Assignment Button -->
							<div id="file-button"
								class="cursor-pointer w-full py-3 bg-[#A9BBF4] text-center rounded-md text-lg font-bold hover:bg-[#9eafe5]"
								onclick="document.getElementById('file-input').click();">
								+ Add Assignment
							</div>
						@endif

						<!-- Hidden File Input -->
						<input type="file" id="file-input" name="file_path" class="hidden" onchange="handleFileChange(event)" />
						<input type="text" name="isUpdate" class="hidden" value="">

						<button id="submit-button" type="submit"
							class="cursor-pointer w-full py-3 bg-[#4A5B92] text-white text-center rounded-md text-lg font-bold hover:bg-[#48588d] hidden">
							Submit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		const unsubmit = document.getElementById('unsubmit')
		const addAssignment = document.querySelector('.add-assignment');
		const studentAssignment = document.getElementById('student-assignment');
		const isAssigned = document.getElementById('isAssigned')
		const isUpdate = document.querySelector('[name=isUpdate]')

		if (unsubmit) {
			isAssigned.classList.remove('text-red-500')
			isAssigned.textContent = 'Turned In'
		}

		unsubmit.addEventListener('click', (e) => {
			isAssigned.classList.add('text-red-500');
			isAssigned.textContent = 'Assigned'
			isUpdate.value = 'update'
			studentAssignment.classList.add('hidden');
			addAssignment.classList.remove('hidden');
			unsubmit.classList.add('hidden');
		})

		function handleFileChange(event) {
			const file = event.target.files[0];
			const fileDisplay = document.getElementById('file-display');
			const submitButton = document.getElementById('submit-button');

			if (file) {
				const fileName = file.name;
				const fileType = file.type || "Unknown type";
				const fileUrl = URL.createObjectURL(file); // Buat URL sementara untuk file

				fileDisplay.innerHTML = `
            <a href="${fileUrl}" download="${fileName}" class="block my-5">
                <div class="bg-white border-2 border-[#919191] rounded-md flex items-center gap-4 px-6 py-4">
                    <div class="min-w-[40px] min-h-[40px] bg-[#D4DDF9] flex items-center justify-center rounded-full">
                        <i class="fa-regular fa-file text-xl text-[#4A5B92]"></i>
                    </div>
                    <div>
                        <p class="font-bold">${fileName}</p>
                        <p>${fileType.toUpperCase()}</p>
                    </div>
                </div>
            </a>
        `;
				submitButton.classList.remove('hidden');
			} else {
				fileDisplay.innerHTML = ""; // Kosongkan jika tidak ada file
				submitButton.classList.add('hidden');

			}
		}
	</script>
@endsection
