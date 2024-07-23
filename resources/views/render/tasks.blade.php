
@forelse ($tasks as $task)
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
            <a href="{{ route('task.markAsCompleted' ,[$task->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Mark as completed</a>
        </td>
    </tr>
    @empty
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <td colspan="99" class="px-6 py-4">
            No tasks available.
        </td>
    </tr>
@endforelse
