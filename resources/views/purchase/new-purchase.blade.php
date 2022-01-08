<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('dash.new_fuel_receipt')}}
        </h2>
    </x-slot>

    <div class="flex flex-col max-w-xl mx-auto">
        <div class="p-6">
            <form method="POST" action="{{ route('purchase.addPurchase') }}">
                @csrf
                <div>
                    <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                        <div class="container">
                            <div class="mb-5 w-64">
                                <x-label for="datepicker" :value="__('dash.date')"/>
                                <div class="relative">
                                    <input type="hidden" name="date" x-ref="date" :value="datepickerValue"/>
                                    <x-input type="text" id="date" x-on:click="showDatepicker = !showDatepicker"
                                             x-model="datepickerValue" x-on:keydown.escape="showDatepicker = false"
                                             class="block mt-1 w-full font-medium text-sm text-gray-700" placeholder="Tarih seç" readonly/>

                                    <div class="absolute top-0 right-0 px-3 py-2">
                                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>

                                    <div class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0"
                                         style="width: 17rem" x-show.transition="showDatepicker"
                                         @click.away="showDatepicker = false">
                                        <div class="flex justify-between items-center mb-2">
                                            <div>
                                                <span x-text="MONTH_NAMES[month]"
                                                      class="text-lg font-bold text-gray-800"></span>
                                                <span x-text="year"
                                                      class="ml-1 text-lg text-gray-600 font-normal"></span>
                                            </div>
                                            <div>
                                                <button type="button"
                                                        class="focus:outline-none focus:shadow-outline transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 p-1 rounded-full"
                                                        @click="if (month == 0) {
												year--;
												month = 12;
											} month--; getNoOfDays()">
                                                    <svg class="h-6 w-6 text-gray-400 inline-flex" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2" d="M15 19l-7-7 7-7"/>
                                                    </svg>
                                                </button>
                                                <button type="button"
                                                        class="focus:outline-none focus:shadow-outline transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 p-1 rounded-full"
                                                        @click="if (month == 11) {
												month = 0;
												year++;
											} else {
												month++;
											} getNoOfDays()">
                                                    <svg class="h-6 w-6 text-gray-400 inline-flex" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2" d="M9 5l7 7-7 7"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="flex flex-wrap mb-3 -mx-1">
                                            <template x-for="(day, index) in DAYS" :key="index">
                                                <div style="width: 14.26%" class="px-0.5">
                                                    <div x-text="day"
                                                         class="text-gray-800 font-medium text-center text-xs"></div>
                                                </div>
                                            </template>
                                        </div>

                                        <div class="flex flex-wrap -mx-1">
                                            <template x-for="blankday in blankdays">
                                                <div style="width: 14.28%"
                                                     class="text-center border p-1 border-transparent text-sm"></div>
                                            </template>
                                            <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                                <div style="width: 14.28%" class="px-1 mb-1">
                                                    <div @click="getDateValue(date)" x-text="date"
                                                         class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100"
                                                         :class="{
                      'bg-indigo-200': isToday(date) == true,
                      'text-gray-600 hover:bg-indigo-200': isToday(date) == false && isSelectedDate(date) == false,
                      'bg-indigo-500 text-white hover:bg-opacity-75': isSelectedDate(date) == true
                    }"></div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <x-label for="plate" :value="__('dash.license')"/>
                    <x-select-menu id="plate" name="plate" required>
                        <option disabled selected value >--{{__('dash.choose_plate')}}--</option>
                        @foreach($plates as $plate)
                            <option>{{$plate->plate}}</option>
                        @endforeach
                    </x-select-menu>
                </div>
                <div class="mt-4">
                    <x-label for="km" :value="__('dash.kilometer')"/>
                    <x-input id="km" class="block mt-1 w-full" type="number" step=".01" name="km" :value="old('km')" required/>
                </div>
                <div class="mt-4">
                    <x-label for="liter" :value="__('dash.liter')"/>
                    <x-input id="liter" class="block mt-1 w-full" type="number" step=".01" name="liter" :value="old('liter')" required/>
                </div>
                <div class="mt-4">
                    <x-label for="price" :value="__('dash.amount')"/>
                    <x-input id="price" class="block mt-1 w-full" type="number" step=".01" name="price" :value="old('price')"
                             required/>
                </div>
                <div class="mt-4">
                    <x-label for="payment_type" :value="__('dash.payment')"/>
                    <x-select-menu id="payment_type" name="payment_type">
                        <option>TTS</option>
                        <option>{{__('dash.cash_credit')}}</option>
                        <option>{{__('dash.another_vehicle')}}</option>
                    </x-select-menu>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        {{ __('dash.insert') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>

    <script>

        const MONTH_NAMES = [
            "Ocak",
            "Şubat",
            "Mart",
            "Nisan",
            "Mayıs",
            "Haziran",
            "Temmuz",
            "Ağustos",
            "Eylül",
            "Ekim",
            "Kasım",
            "Aralık",
        ];
        const MONTH_SHORT_NAMES = [
            "Oca",
            "Şub",
            "Mar",
            "Nis",
            "May",
            "Haz",
            "Tem",
            "Ağu",
            "Eyl",
            "Eki",
            "Kas",
            "Ara",
        ];
        const DAYS = ["Paz", "Pzt", "Sal", "Çar", "Per", "Cum", "Cmt"];

        function app() {
            return {
                showDatepicker: false,
                datepickerValue: "",
                selectedDate: "",
                dateFormat: "DD-MM-YYYY",
                month: "",
                year: "",
                no_of_days: [],
                blankdays: [],
                initDate() {
                    let today;
                    if (this.selectedDate) {
                        today = new Date(Date.parse(this.selectedDate));
                    } else {
                        today = new Date();
                    }
                    this.month = today.getMonth();
                    this.year = today.getFullYear();
                    this.datepickerValue = this.formatDateForDisplay(
                        today
                    );
                },
                formatDateForDisplay(date) {
                    let formattedDay = DAYS[date.getDay()];
                    let formattedDate = ("0" + date.getDate()).slice(
                        -2
                    ); // appends 0 (zero) in single digit date
                    let formattedMonth = MONTH_NAMES[date.getMonth()];
                    let formattedMonthShortName =
                        MONTH_SHORT_NAMES[date.getMonth()];
                    let formattedMonthInNumber = (
                        "0" +
                        (parseInt(date.getMonth()) + 1)
                    ).slice(-2);
                    let formattedYear = date.getFullYear();
                    if (this.dateFormat === "DD-MM-YYYY") {
                        return `${formattedDate}-${formattedMonthInNumber}-${formattedYear}`; // 02-04-2021
                    }
                    if (this.dateFormat === "YYYY-MM-DD") {
                        return `${formattedYear}-${formattedMonthInNumber}-${formattedDate}`; // 2021-04-02
                    }
                    if (this.dateFormat === "D d M, Y") {
                        return `${formattedDay} ${formattedDate} ${formattedMonthShortName} ${formattedYear}`; // Tue 02 Mar 2021
                    }
                    return `${formattedDay} ${formattedDate} ${formattedMonth} ${formattedYear}`;
                },
                isSelectedDate(date) {
                    const d = new Date(this.year, this.month, date);
                    return this.datepickerValue ===
                    this.formatDateForDisplay(d) ?
                        true :
                        false;
                },
                isToday(date) {
                    const today = new Date();
                    const d = new Date(this.year, this.month, date);
                    return today.toDateString() === d.toDateString() ?
                        true :
                        false;
                },
                getDateValue(date) {
                    let selectedDate = new Date(
                        this.year,
                        this.month,
                        date
                    );
                    this.datepickerValue = this.formatDateForDisplay(
                        selectedDate
                    );
                    // this.$refs.date.value = selectedDate.getFullYear() + "-" + ('0' + formattedMonthInNumber).slice(-2) + "-" + ('0' + selectedDate.getDate()).slice(-2);
                    this.isSelectedDate(date);
                    this.showDatepicker = false;
                },
                getNoOfDays() {
                    let daysInMonth = new Date(
                        this.year,
                        this.month + 1,
                        0
                    ).getDate();
                    // find where to start calendar day of week
                    let dayOfWeek = new Date(
                        this.year,
                        this.month
                    ).getDay();
                    let blankdaysArray = [];
                    for (var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }
                    let daysArray = [];
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }
                    this.blankdays = blankdaysArray;
                    this.no_of_days = daysArray;
                },
            };
        }
    </script>
</x-app-layout>

