{{-- Calendar --}}
<div class="mt-10">
	<h2 class="text-3xl font-bold mb-4">Calendar</h2>

	<div class="bg-white rounded sm:p-6 p-4 w-full border-stone-300 border-2 shadow">
		<div class="w-full">
			<div class="overflow-hidden">
				<div class="flex items-center justify-between px-6 py-3 bg-[#4A5B92] rounded-md text-white">
					<button id="prevMonth">
						<i class="fa-solid fa-angle-left"></i>
					</button>
					<h2 id="currentMonth"></h2>
					<button id="nextMonth">
						<i class="fa-solid fa-angle-right"></i>
					</button>
				</div>
				<div class="grid grid-cols-7 gap-2 mt-4" id="calendar">
					<!-- Calendar Days Go Here -->
				</div>
			</div>
		</div>
	</div>
</div>
</div>
