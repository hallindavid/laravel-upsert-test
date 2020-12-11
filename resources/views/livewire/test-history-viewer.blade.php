<div class="p-2 flex flex-col">
    <div>
        <h1 class="text-xl">Test {{ $testNumber }} results</h1>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Start Time
                                </th>
                                <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Generation Time
                                </th>
                                <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Query Time
                                </th>
                                <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Num Records
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="bg-gray-100">
                                <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    Averages (ms)
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ round($avg_array_generation_time,1) }}
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ round($avg_query_time, 1) }}
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500"></td>
                            </tr>

                            @foreach($results as $res)
                            <tr>
                                <td class="px-2 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ date('M j, g:i a', strtotime($res->start_time)) }}
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $res->array_generation_time }}
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $res->query_execution_time }}
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $res->num_records }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>