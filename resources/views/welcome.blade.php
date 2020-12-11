<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">


    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
    @livewireStyles
</head>

<body class="w-full h-screen pb-10 px-2">
    <div>
        <livewire:data-seeder />
    </div>

    <div class="text-center my-2">
        In order to look at the actual code base - take a peek at App\Helpers\TestTaskHelper.php - this is where the logic exists
    </div>
    <div class="grid grid-cols-4 gap-3 px-4">

        <div class="border-gray-200 border w-full">
            <livewire:test-runner testNumber="1" />
        </div>
        <div class="border-gray-200 border w-full">
            <livewire:test-runner testNumber="2" />
        </div>
        <div class="border-gray-200 border w-full">
            <livewire:test-runner testNumber="3" />
        </div>
        <div class="border-gray-200 border w-full">
            <livewire:test-runner testNumber="4" />
        </div>
        <div class="border-gray-200 border w-full">
            <livewire:test-history-viewer testNumber="1" />
        </div>
        <div class="border-gray-200 border w-full">
            <livewire:test-history-viewer testNumber="2" />
        </div>
        <div class="border-gray-200 border w-full">
            <livewire:test-history-viewer testNumber="3" />
        </div>
        <div class="border-gray-200 border w-full">
            <livewire:test-history-viewer testNumber="4" />
        </div>
    </div>

    @livewireScripts
</body>

</html>