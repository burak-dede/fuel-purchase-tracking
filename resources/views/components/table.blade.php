
<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            {{ $header }}
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        {{ $slot }}
        </tbody>
    </table>
</div>
