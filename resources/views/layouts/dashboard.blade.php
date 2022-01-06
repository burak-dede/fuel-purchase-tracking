<x-app-layout>
    <x-slot name="header">
        <div class="bg-white border-b border-gray-200 text-right">
            {{__("dash.welcome", ['name' => Auth::user()->name])}}
        </div>
    </x-slot>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                {{$slot}}
            </div>
        </div>
    </div>

</x-app-layout>
