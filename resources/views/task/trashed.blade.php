<x-app-layout>
<!-- Header -->
    <header class="flex-shrink-0 w-full bg-white shadow dark:bg-gray-800 rounded mb-6">
        <div class="flex w-full mx-auto p-4 md:flex md:items-center md:justify-between">

            <div>
                <button type="button" onclick="$('form').submit()" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Delete
                </button>
                <a href="{{ route('task.deleteAllTrashed') }}">
                    <button type="button" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Empty Trash
                    </button>
                </a>
            </div>
        </div>
    </header>
    <!-- Table -->
    <form method="GET" action="{{route('task.deleteTrashed')}}" accept-charset="UTF-8">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Time Remaining
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($trashedWithCategories['tasks'] as $trashed)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4"><input type="checkbox" name="tasks[]" value="{{$trashed->id}}"></td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $trashed->title }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $trashed->description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $trashed->category_description }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($trashed->status == 'pending')
                        <span class="flex text-yellow-500">
                            {{ $trashed->status }}
                        </span>
                        @else
                        <span class="flex text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ $trashed->status }}
                        </span>
                        @endif
                    </td>
                    <th scope="col" class="px-6 py-3">
                        @php echo (new \DateTime($trashed->deadline))->diff(now())->format('%y Years, %m month, %d days, %H Hours, %i Minutes, %S Seconds') @endphp
                    </th>
                    <td class="px-6 py-4 flex md:item-center md:justify-between">
                        <a href="{{ route('task.undoTrash' ,[$trashed->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Undo</a>
                    </td>
                </tr>
                @empty
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td colspan="99" class="px-6 py-4">
                        No tasks available.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </form>
<!-- End Of Table -->

<!-- Paginator -->
<div class="p-4">
    {{ $trashedWithCategories['tasks']->links() }}
</div>

@push('script')
<script src="{{ URL::asset('js/app.js') }}"></script>
@endpush
</x-app-layout>
