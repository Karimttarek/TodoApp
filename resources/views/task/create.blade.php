<x-app-layout>

        <header class="flex-shrink-0 w-full bg-white shadow dark:bg-gray-800 rounded mb-6">
            <div class="flex w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">

                <span></span>

                <div class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                    <nav aria-label="breadcrumb" class="w-max">
                        <ol class="flex flex-wrap items-center w-full px-4 py-2 rounded-md bg-blue-gray-50 bg-opacity-60">
                            <li
                            class="flex items-center font-sans text-sm antialiased font-normal leading-normal transition-colors duration-300 cursor-pointer">
                            <a href="{{route('welcome')}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Home</a><span
                                class="mx-2 font-sans text-sm antialiased font-normal leading-normal pointer-events-none select-none">/</span>
                            </li>
                            <li
                            class="flex items-center font-sans text-sm antialiased font-normal leading-normal transition-colors duration-300 cursor-pointer">
                            <a href="{{route('task.index')}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Task</a><span
                                class="mx-2 font-sans text-sm antialiased font-normal leading-normal pointer-events-none select-none">/</span>
                            </li>
                            <li
                            class="flex items-center font-sans text-sm antialiased font-normal leading-normal transition-colors duration-300">
                            <span  class="">Create a new task</span>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>
        <!-- Form -->
        <form method="POST" action="{{route('task.store')}}" enctype="multipart/form-data">
            @csrf
            <!-- Title & Description -->
            <div class="grid gap-6 md:grid-cols-2">
                <!-- Title -->
                <div class="mb-2">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Title
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}" class="@error('title') border border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required>
                    @error('title')
                    <div>
                        <span class="font-medium text-red-600">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <!-- Description -->
                <div class="mb-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Description
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="description" value="{{ old('description') }}" class="@error('description') border border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required>
                    @error('description')
                    <div>
                        <span class="font-medium text-red-600">{{$message}}</span>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="grid gap-6 md:grid-cols-2">
                <!-- Category -->
                <div class="mb-2">
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Category
                        <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" value="{{ old('category_id') }}" class="@error('category_id') border border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->description}}</option>
                            @endforeach
                    </select>
                    @error('category_id')
                    <div>
                        <span class="font-medium text-red-600">{{$message}}</span>
                    </div>
                    @enderror
                </div>
                <!-- Deadline -->
                <div class="mb-2">
                    <label for="deadline" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Deadline
                    </label>
                    <input type="datetime-local" name="deadline" value="{{ date("Y-m-d\TH:i", strtotime(\Carbon\Carbon::now('Africa/Cairo'))) }}" class="@error('deadline') border border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           >
                    @error('deadline')
                    <div>
                        <span class="font-medium text-red-600">{{$message}}</span>
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Submit
            </button>
        </form>
        <!-- End Of Form -->

</x-app-layout>
