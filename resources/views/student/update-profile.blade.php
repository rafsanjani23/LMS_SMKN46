@extends('dashboard.user')

@section('content')
	<div class="sm:p-6 p-4">
		<div class="max-w-5xl w-full bg-white mx-auto rounded-md">
			<div class="pt-7">
				<h2 class="text-3xl font-bold mb-10 text-center">Update Profile</h2>

				<form action="/update-profile/{{ optional(Auth::user()->student)->nis }}/put" method="post" class="px-7"
					enctype="multipart/form-data" id="update-profile-form">
					@csrf
					@method('put')
					<div class="grid grid-cols-1 sm:grid-cols-2 gap-8 text-xl ">
						<div class="flex flex-col justify-center gap-3 relative">
							<label class="px-3 font-medium text-[#414141] text-opacity-50" for="fullname">Name<span
									class="text-red-500">*</span></label>
							<input id="fullname" name="fullname" type="text" placeholder="Your name" value="{{ $student->fullname }}"
								class="w-full py-4 px-3 text-[#414141] text-opacity-50 bg-[#e8e8e8] focus:outline-none rounded-md" required>
							@error('fullname')
								<div class="text-red-600 text-xs absolute bottom-[-20px]">
									{{ $message }}
								</div>
							@enderror
						</div>

						<div class="flex flex-col justify-center gap-3 relative">
							<label class="px-3 font-medium text-[#414141] text-opacity-50" for="username">Username<span
									class="text-red-500">*</span></label>
							<input id="username" name="username" type="text" placeholder="Your username"
								value="{{ Auth::user()->username }}"
								class="w-full py-4 px-3 text-[#414141] text-opacity-50 bg-[#e8e8e8] focus:outline-none rounded-md" required>
							@error('username')
								<div class="text-red-600 text-xs absolute bottom-[-20px]">
									{{ $message }}
								</div>
							@enderror
						</div>

						<div class="flex flex-col justify-center gap-3 relative">
							<label class="pl-3 font-medium text-[#414141] text-opacity-50" for="nis">NIS<span
									class="text-red-500">*</span></label>
							<input id="nis" name="nis" type="number" placeholder="Your NIS" value="{{ $student->nis }}"
								class="w-full py-4 px-3 text-[#414141] text-opacity-50 bg-[#e8e8e8] focus:outline-none rounded-md" required>
							@error('nis')
								<div class="text-red-600 text-xs absolute bottom-[-20px]">
									{{ $message }}
								</div>
							@enderror
						</div>

						<div class="flex flex-col justify-center gap-3 relative">
							<label class="px-3 font-medium text-[#414141] text-opacity-50" for="grade">Grade<span
									class="text-red-500">*</span></label>
							<div class="bg-[#e8e8e8] w-full rounded-md relative overflow-hidden">
								<i
									class="fa-solid fa-sort-down absolute right-[12px] text-[#414141] text-opacity-50 top-1/2 translate-y-[-70%]"></i>
								<select name="grade" id="grade" required
									class="w-full py-4 px-3 appearance-none bg-transparent outline-none text-[#414141] text-opacity-50 z-0">
									<option value="" disabled {{ !$student->grade ? 'selected' : '' }}>Select your grade</option>
									<option value="10" {{ $student->grade == '10' ? 'selected' : '' }}>10</option>
									<option value="11" {{ $student->grade == '11' ? 'selected' : '' }}>11</option>
									<option value="12" {{ $student->grade == '12' ? 'selected' : '' }}>12</option>
								</select>
								@error('grade')
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
									<option value="" disabled {{ !$student->major ? 'selected' : '' }}>Select your major</option>
									<option value="pplg" {{ $student->major == 'pplg' ? 'selected' : '' }}>PENGEMBANGAN PERANGKAT LUNAK DAN GIM
									</option>
									<option value="dkv" {{ $student->major == 'dkv' ? 'selected' : '' }}>DESAIN KOMUNIKASI VISUAL</option>
									<option value="akl" {{ $student->major == 'akl' ? 'selected' : '' }}>AKUNTANSI DAN KEUANGAN LEMBAGA</option>
									<option value="bdp" {{ $student->major == 'bdp' ? 'selected' : '' }}>BISNIS DARING DAN PEMASARAN</option>
									<option value="otkp" {{ $student->major == 'otkp' ? 'selected' : '' }}>OTOMATISASI DAN TATA KELOLA
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
							<label class="pl-3 font-medium text-[#414141] text-opacity-50" for="date_of_birth">Date of Birth<span
									class="text-red-500">*</span></label>
							<input id="date_of_birth" name="date_of_birth" type="date" value="{{ $student->date_of_birth }}"
								class="w-full py-4 px-3 text-[#414141] text-opacity-50 bg-[#e8e8e8] focus:outline-none rounded-md" required>
							@error('date_of_birth')
								<div class="text-red-600 text-xs absolute bottom-[-20px]">
									{{ $message }}
								</div>
							@enderror
						</div>

						<div class="flex flex-col justify-center gap-3 relative">
							<label class="px-3 font-medium text-[#414141] text-opacity-50" for="gender">Gender<span
									class="text-red-500">*</span></label>
							<div class="bg-[#e8e8e8] w-full rounded-md relative overflow-hidden">
								<i
									class="fa-solid fa-sort-down absolute right-[12px] text-[#414141] text-opacity-50 top-1/2 translate-y-[-70%]"></i>
								<select name="gender" id="gender" required
									class="w-full py-4 px-3 appearance-none bg-transparent outline-none text-[#414141] text-opacity-50">
									<option value="" disabled {{ !$student->gender ? 'selected' : '' }}>Select your gender</option>
									<option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
									<option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
								</select>
								@error('gender')
									<div class="text-red-600 text-xs absolute bottom-[-20px]">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>

						<div class="flex flex-col justify-center gap-3 relative">
							<label class="px-3 font-medium text-[#414141] text-opacity-50" for="profile_picture">Profile Picture<span
									class="text-red-500">*</span></label>
							<input id="profile_picture" name="profile_picture" type="file"
								class="w-full py-4 px-3 text-[#414141] text-opacity-50 bg-[#e8e8e8] focus:outline-none rounded-md">
							@error('profile_picture')
								<div class="text-red-600 text-xs absolute bottom-[-20px]">
									{{ $message }}
								</div>
							@enderror
						</div>
					</div>

					<button type="submit"
						class="w-full py-4 bg-[#4A5B92] hover:bg-[#3f4e7c] text-xl font-semibold my-10 text-white rounded-md">Update
						Profile</button>
				</form>
			</div>
		</div>
	</div>
@endsection
