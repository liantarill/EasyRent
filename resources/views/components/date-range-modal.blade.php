@props(['rentDate' => '', 'returnDate' => ''])

<div id="dateModal"
    class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center backdrop-blur-sm transition-all duration-200">
    <div class="bg-white rounded-lg shadow-2xl max-w-sm w-11/12 overflow-hidden transform transition-all duration-200">
        <!-- Header -->
        <div class="bg-gradient-to-r from-teal-600 to-teal-500 px-6 py-6">
            <h3 class="text-xl font-bold text-white text-center">Pilih Tanggal Sewa</h3>
            <p class="text-teal-100 text-sm text-center mt-1">Tanggal mulai dan kembali</p>
        </div>

        <!-- Content -->
        <div class="p-6">
            <!-- Month Navigation -->
            <div class="flex items-center justify-between mb-6">
                <button type="button" id="prevMonth"
                    class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200 text-gray-700 hover:text-teal-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>
                <div class="font-bold text-lg text-gray-800" id="currentMonth"></div>
                <button type="button" id="nextMonth"
                    class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200 text-gray-700 hover:text-teal-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Day Headers -->
            <div class="grid grid-cols-7 gap-2 mb-4">
                @foreach (['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'] as $day)
                    <div class="text-center text-sm font-semibold text-gray-500 py-2">{{ $day }}</div>
                @endforeach
            </div>

            <!-- Calendar Days -->
            <div id="calendarDays" class="grid grid-cols-7 gap-2 mb-6"></div>

            <!-- Action Buttons -->
            <div class="flex gap-3 justify-end pt-4 border-t border-gray-200">
                <button type="button" id="cancelDateBtn"
                    class="px-4 py-2.5 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors duration-200 text-sm">
                    Batal
                </button>
                <button type="button" id="clearDateBtn"
                    class="px-4 py-2.5 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg font-medium transition-colors duration-200 text-sm">
                    Hapus
                </button>
                <button type="button" id="applyDateBtn"
                    class="px-4 py-2.5 text-white bg-teal-600 hover:bg-teal-700 rounded-lg font-medium transition-colors duration-200 text-sm">
                    Terapkan
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        const modal = document.getElementById('dateModal');
        const dateRangeBtn = document.getElementById('dateRangeBtn');
        const dateRangeDisplay = document.getElementById('dateRangeDisplay');
        const calendarDays = document.getElementById('calendarDays');
        const currentMonthDisplay = document.getElementById('currentMonth');
        const prevMonthBtn = document.getElementById('prevMonth');
        const nextMonthBtn = document.getElementById('nextMonth');
        const cancelBtn = document.getElementById('cancelDateBtn');
        const clearBtn = document.getElementById('clearDateBtn');
        const applyBtn = document.getElementById('applyDateBtn');
        const hiddenRentDate = document.getElementById('rent_date');
        const hiddenReturnDate = document.getElementById('return_date');

        let currentDate = new Date();
        let selectedStartDate = null;
        let selectedEndDate = null;
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        function renderCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            currentMonthDisplay.textContent = `${monthNames[month]} ${year}`;

            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const prevLastDay = new Date(year, month, 0);

            let firstDayOfWeek = firstDay.getDay();
            firstDayOfWeek = firstDayOfWeek === 0 ? 6 : firstDayOfWeek - 1;

            calendarDays.innerHTML = '';

            for (let i = firstDayOfWeek; i > 0; i--) {
                const day = prevLastDay.getDate() - i + 1;
                const dayEl = document.createElement('div');
                dayEl.textContent = day;
                dayEl.className = 'text-center py-2 text-gray-300 text-sm cursor-not-allowed';
                calendarDays.appendChild(dayEl);
            }

            for (let day = 1; day <= lastDay.getDate(); day++) {
                const dayDate = new Date(year, month, day);
                dayDate.setHours(0, 0, 0, 0);

                const dayEl = document.createElement('div');
                dayEl.textContent = day;

                const isPast = dayDate < today;

                if (isPast) {
                    dayEl.className = 'text-center py-2 text-gray-300 text-sm cursor-not-allowed';
                } else {
                    const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    const isStart = selectedStartDate && dateStr === selectedStartDate;
                    const isEnd = selectedEndDate && dateStr === selectedEndDate;

                    let isInRange = false;
                    if (selectedStartDate && selectedEndDate) {
                        const startDate = new Date(selectedStartDate);
                        const endDate = new Date(selectedEndDate);
                        startDate.setHours(0, 0, 0, 0);
                        endDate.setHours(0, 0, 0, 0);
                        isInRange = dayDate > startDate && dayDate < endDate;
                    }

                    if (isStart || isEnd) {
                        dayEl.className =
                            'text-center py-2 bg-teal-600 text-white font-bold rounded-lg cursor-pointer text-sm transition-all duration-200 hover:shadow-lg hover:scale-105';
                    } else if (isInRange) {
                        dayEl.className =
                            'text-center py-2 bg-teal-50 text-teal-700 text-sm cursor-pointer transition-all duration-200';
                    } else {
                        dayEl.className =
                            'text-center py-2 text-gray-700 text-sm cursor-pointer hover:bg-gray-100 rounded-lg transition-all duration-200 hover:scale-105';
                    }

                    dayEl.addEventListener('click', () => selectDate(dateStr));
                }

                calendarDays.appendChild(dayEl);
            }
        }

        function selectDate(dateStr) {
            if (!selectedStartDate || (selectedStartDate && selectedEndDate)) {
                selectedStartDate = dateStr;
                selectedEndDate = null;
            } else {
                if (new Date(dateStr) < new Date(selectedStartDate)) {
                    selectedEndDate = selectedStartDate;
                    selectedStartDate = dateStr;
                } else {
                    selectedEndDate = dateStr;
                }
            }
            renderCalendar();
        }

        prevMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        nextMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        dateRangeBtn.addEventListener('click', () => {
            if (hiddenRentDate.value) selectedStartDate = hiddenRentDate.value;
            if (hiddenReturnDate.value) selectedEndDate = hiddenReturnDate.value;

            if (selectedStartDate) {
                currentDate = new Date(selectedStartDate);
            }

            renderCalendar();
            modal.classList.remove('hidden');
            modal.style.animation = 'fadeIn 0.3s ease-out';
        });

        cancelBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });

        clearBtn.addEventListener('click', () => {
            selectedStartDate = null;
            selectedEndDate = null;
            hiddenRentDate.value = '';
            hiddenReturnDate.value = '';
            dateRangeDisplay.textContent = 'Pilih Tanggal Sewa';
            renderCalendar();
            modal.classList.add('hidden');
        });

        applyBtn.addEventListener('click', () => {
            if (selectedStartDate && selectedEndDate) {
                hiddenRentDate.value = selectedStartDate;
                hiddenReturnDate.value = selectedEndDate;
                const startFormatted = new Date(selectedStartDate).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });

                const endFormatted = new Date(selectedEndDate).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });

                dateRangeDisplay.textContent = `${startFormatted} - ${endFormatted}`;
                modal.classList.add('hidden');
            } else {
                alert('Silakan pilih tanggal mulai dan tanggal selesai');
            }
        });
    </script>
@endpush
