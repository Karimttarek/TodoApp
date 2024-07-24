<x-app-layout>


    <a href="{{route('task.index')}}"><h2 class="font-medium text-blue-600 dark:text-blue-500 hover:underline mx-auto items-center gap-x-8 lg:max-w-7xl lg:grid-cols-2 lg:px-8">See Task List</h2></a>
    <div class="bg-white">
        <div class="mx-auto grid max-w-2xl grid-cols-1 items-center gap-x-8 gap-y-16 px-4 py-12 sm:px-6 sm:py-16 lg:max-w-7xl lg:grid-cols-2 lg:px-8">
          <div>
            <h2 class="text-3xl font-bold tracking-tight text-indigo-600 sm:text-4xl">To-Do List Application</h2>
            <h2 class="text-base font-semibold leading-7 text-gray-900">Technical Specifications</h2>
            <p class="mt-4 text-gray-500">Description of  all the technical information about the process of product development.</p>

            <dl class="mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">
              <div class="border-t border-gray-200 pt-4">
                <dt class="font-medium text-gray-900">Authentication</dt>
                <dd class="mt-2 text-sm text-gray-500">Laravel Breeze is a minimal, simple implementation of all of Laravel's authentication features</dd>
              </div>
              <div class="border-t border-gray-200 pt-4">
                <dt class="font-medium text-gray-900">API Endpoints</dt>
                <dd class="mt-2 text-sm text-gray-500">Functionality and logic separated in service container, service container is a powerful tool for managing class dependencies and performing dependency injection</dd>
                <dd class="mt-2 text-sm text-gray-500">It makes it easy to create RESTful API endpoints for tasks while not repeating functionality</dd>
              </div>
              <div class="border-t border-gray-200 pt-4">
                <dt class="font-medium text-gray-900">Back-End</dt>
                <dd class="mt-2 text-sm text-gray-500">Instead of using packages such as (filament, powergrid, yajraBox, etc.)</dd>
                <dd class="mt-2 text-sm text-gray-500">Database functionality implemented with Query Builder, it's much faster than Eloquent.</dd>
              </div>
              <div class="border-t border-gray-200 pt-4">
                <dt class="font-medium text-gray-900">Front-End</dt>
                <dd class="mt-2 text-sm text-gray-500">Using blade template engine to create a simple front-end interface.</dd>
              </div>
              <div class="border-t border-gray-200 pt-4">
                <dt class="font-medium text-gray-900">Task Filtering</dt>
                <dd class="mt-2 text-sm text-gray-500">For filtering i've used a simple ajax request to re render the filtered data, located on (js/app.js).</dd>
              </div>
              <div class="border-t border-gray-200 pt-4">
                <dt class="font-medium text-gray-900">Styling</dt>
                <dd class="mt-2 text-sm text-gray-500">Applied basic styling using Tailwind</dd>
              </div>
            </dl>
          </div>
        </div>
      </div>

</x-app-layout>
