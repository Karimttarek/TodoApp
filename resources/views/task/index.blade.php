<x-app-layout>
<!-- Header -->
    <header class="flex-shrink-0 w-full bg-white shadow dark:bg-gray-800 rounded mb-6">
        <div class="flex w-full mx-auto p-4 md:flex md:items-center md:justify-between">

            <div>
                <a href="{{route('task.create')}}">
                    <button type="button" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Create Task
                    </button>
                </a>
                <button type="button" onclick="$('form').submit()" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Trash
                </button>
            </div>
            <!-- Trash -->
            <div class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                <nav aria-label="breadcrumb" class="w-max">
                    <ol class="flex flex-wrap items-center w-full px-4 py-2 rounded-md bg-blue-gray-50 bg-opacity-60">
                        <li
                        class="flex items-center font-sans text-sm antialiased font-normal leading-normal transition-colors duration-300 cursor-pointer">
                        <a href="{{route('task.trashed')}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Trash</a><span
                        </li>
                    </ol>
                </nav>
            </div>
            <!-- Trash -->
        </div>
    </header>
    <div class="content">
        <!-- Table -->
        <form method="GET" action="{{route('task.trash')}}" accept-charset="UTF-8">
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
                    <!-- Filters -->
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3">
                                <input type="text" id="title" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg dark:text-white" placeholder="Title">
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <input type="text" id="description" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg bg-white dark:text-white" placeholder="Description">
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <select id="category" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg bg-white dark:text-white">
                                    @foreach ($tasksWithCategories['categories'] as $category)
                                    <option value="{{ $category->id }}">{{ $category->description }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <select id="status" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg bg-white dark:text-white">
                                    <option value="pending">pending</option>
                                    <option value="completed">completed</option>
                                </select>
                            </th>
                            <th scope="col" class="px-6 py-3"></th>
                            <th scope="col" class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <!-- End Of Filters -->
                    <div class="render">
                        <tbody>
                            @forelse ($tasksWithCategories['tasks'] as $task)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4"><input type="checkbox" name="tasks[]" value="{{$task->id}}"></td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $task->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $task->description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $task->category_description }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($task->status == 'pending')
                                    <span class="flex text-yellow-500">
                                        {{ $task->status }}
                                    </span>
                                    @else
                                    <span class="flex text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        {{ $task->status }}
                                    </span>
                                    @endif
                                </td>
                                <th scope="col" class="px-6 py-3">
                                    @php echo (new \DateTime($task->deadline))->diff(now())->format('%y Years, %m month, %d days, %H Hours, %i Minutes, %S Seconds') @endphp
                                </th>
                                <td class="px-6 py-4 flex md:item-center md:justify-between">
                                    <a href="{{ route('task.edit' ,[$task->id ,Str::slug($task->title)]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                                <td class="px-6 py-4 flex md:item-center md:justify-between">
                                    @if ($task->status == 'pending')
                                    <a href="{{ route('task.markAsCompleted' ,[$task->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Mark as completed</a>
                                    @endif
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
                    </div>
                </table>
            </div>
            </form>
        <!-- End Of Table -->

        <!-- Paginator -->
        <div class="p-4">
            {{ $tasksWithCategories['tasks']->links() }}
        </div>
    </div>

@push('script')
<script src="{{ URL::asset('js/app.js') }}"></script>
@endpush
</x-app-layout>
