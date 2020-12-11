<div class="p-2 flex flex-col">
    <div>
        <h1 class="text-xl">{{ $testTitle }}</h1>
    </div>

    <ul class="divide-y divide-gray-200">
        <li class="py-4 flex justify-between flex-row">
            <div class="text-sm font-medium text-gray-500">
                Test Started At
            </div>
            <div class="text-sm font-medium text-gray-500 text-right">
                {{ $test_started_at ?? 'Click Run Test'}}
            </div>
        </li>

        <li class="py-4 flex justify-between flex-row">
            <div class="text-sm font-medium text-gray-500">
                Generate New Random Order Array
            </div>
            <div class="text-sm font-medium text-gray-500 text-right">
                {{ $test_began_updates_at ?? ''}}
            </div>
        </li>
        <li class="py-4 flex justify-between flex-row">
            <div class="text-sm font-medium text-gray-500">
                Update Query/Queries Took
            </div>
            <div class="text-sm font-medium text-gray-500 text-right">
                {{ $test_finished_at ?? ''}}
            </div>
        </li>
    </ul>

    <div wire:loading>
        Loading...
    </div>


    <button wire:loading.remove wire:click="run_test" type="button" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <span class="mx-auto">Run Test</span>
    </button>

</div>