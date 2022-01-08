<!-- This example requires Tailwind CSS v2.0+ -->

<x-dashboard-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-3 mb-3">
        {{__('dash.expenses')}}
    </h2>

    <div class="py-3">
        <x-button onclick="window.location='{{ route('purchase')}}'">
            {{__('dash.add_receipt')}}
        </x-button>
        @if(Auth::check() and (Auth::user()->isAdmin() == true))
            <x-button onclick="window.location='{{ route('dashboard.export')}}'">
                {{__('dash.exel')}}
            </x-button>
        @endif
    </div>
    <x-table>
        <x-slot name="header">
            <tr>
                <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{__('dash.date')}}
                </th>
                <th scope="col"
                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{__('dash.license')}}
                </th>
                <th scope="col"
                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{__('auth.name')}} {{__('auth.lastname')}}
                </th>
                <th scope="col"
                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{__('dash.kilometer')}}
                </th>
                <th scope="col"
                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{__('dash.liter')}}
                </th>
                <th scope="col"
                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{__('dash.amount')}}
                </th>
                <th scope="col"
                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{__('dash.payment')}}
                </th>
                <th scope="col"
                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
        </x-slot>
        @if (count($expenses) === 0)
            <tr>
                <td class="px-2 py-4 whitespace-nowrap">
                    {{__('dash.no_record')}}
                </td>
            </tr>
        @endif
        @foreach ($expenses as $expense)
            <tr>
                <td class="px-2 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{$expense->p_date}}
                    </div>
                </td>
                <td class="px-2 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                        {{$expense->registration_plate}}
                    </div>
                </td>
                <td class="px-2 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{$expense->name}} {{$expense->lastname}}
                    </div>
                </td>
                <td class="px-2 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                        {{$expense->km}}
                    </div>
                </td>
                <td class="px-2 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                        {{$expense->liter}}
                    </div>
                </td>
                <td class="px-2 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                        {{$expense->price}}
                    </div>
                </td>
                <td class="px-2 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                        {{$expense->payment_type}}
                    </div>
                </td>
                @if(Auth::check() and (Auth::user()->isAdmin() == true))
                    <td class="px-2 py-4 whitespace-nowrap">
                        <form method="POST" action="{{ route('purchase.destroy',$expense->id)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600">
                                {{__('dash.delete')}}
                            </button>
                        </form>
                    </td>
                @endif

            </tr>
        @endforeach
    </x-table>

</x-dashboard-layout>
