<!DOCTYPE html>
<html>
<head>
    <title>Flowbite Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col items-center justify-center space-y-4 pt-8">
    <div class="flex flex-col items-center space-y-4">
        <button data-modal-target="test-modal" data-modal-toggle="test-modal" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <x-svg name="user-circle" class="w-5 h-5 mr-2" />
            Toggle modal
        </button>
    </div>

    <div id="test-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Test Modal
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="test-modal">
                        <x-svg name="close" class="w-3 h-3" />
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500">
                        Flowbite modal with Flowbite Icons is working!
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>