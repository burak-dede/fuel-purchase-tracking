<!-- This example requires Tailwind CSS v2.0+ -->

<x-dashboard-layout>

    <div>

        <h2 class="font-semibold text-xl text-gray-800 leading-tight ml-3 mb-3">
            {{__('dash.vehicles')}}
        </h2>

        <div class="grid grid-cols-4 ">
            <div class="col-span-3">
                <x-table>
                    <x-slot name="header">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('dash.license')}}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{__('dash.created_at')}}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        <tr>
                    </x-slot>

                    @if (count($vehicles) === 0)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{__('dash.no_record')}}
                            </td>
                        </tr>
                    @endif
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{$vehicle->registration_plate}}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{$vehicle->created_at}}
                                </div>
                            </td>
                            @if(Auth::check() and (Auth::user()->isAdmin() == true))
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form method="POST" action="{{ route('deleteVehicle',$vehicle->registration_plate)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-600">
                                            {{__("dash.delete")}}
                                        </button>
                                    </form>
                                </td>
                            @endif

                        </tr>
                    @endforeach

                </x-table>
            </div>

            <div class="ml-3 ">
                <form method="POST" action="{{ route('createVehicle') }}">
                    @csrf
                    <x-label for="plate" :value="__('dash.license')"/>

                    <x-input id="plate" class="block mt-1 w-full" type="text" name="plate" :value="old('plate')"
                             required autofocus/>
                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('dash.add_vehicle') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="grid grid-cols-4 ml-3 mb-3">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight col-span-3 self-end">
            {{__('dash.personels')}}
        </h2>
        <div class="text-right py-3">
            <x-button onclick="window.location='{{ route('createPersonel')}}'">
                {{__('dash.add_personel')}}
            </x-button>
        </div>
    </div>
    <x-table>
        <x-slot name="header">
            <tr>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{__('auth.name')}}
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{__('auth.lastname')}}
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{__('auth.username')}}
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{__('dash.admin')}}
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{__('dash.created_date')}}
                </th>
                <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
        </x-slot>

        @if (count($users) === 0)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{__('dash.no_record')}}
                </td>
            </tr>
        @endif
        @foreach ($users as $user)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{$user->name}}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">
                        {{$user->lastname}}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                        {{$user->username}}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
            @if ($user->is_admin === 0)
                {{__('dash.no')}}
                @elseif($user->is_admin === 1)
                {{__('dash.yes')}}
                @endif
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                        {{$user->created_at}}
                    </div>
                </td>
                @if(Auth::check() and (Auth::user()->isAdmin() == true))
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form method="POST" action="{{ route('deletePersonel',$user->id)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600">
                                {{__("dash.delete")}}
                            </button>
                        </form>
                    </td>
                @endif
                @endforeach

                </tr>

    </x-table>
</x-dashboard-layout>
