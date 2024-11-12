@if (Session::has('success'))
    <div id="success-message" class="pt-3 flex items-center justify-center">
        <div class="bg-green-200 text-green-800 px-6 py-4 rounded-lg shadow-md flex items-center space-x-2 w-full max-w-md">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>{{ Session::get('success') }}</span>
        </div>
    </div>
@endif

@if (Session::has('error'))
    <div id="error-message" class="pt-3 flex items-center justify-center">
        <div class="bg-red-200 text-red-800 px-6 py-4 rounded-lg shadow-md flex items-center space-x-2 w-full max-w-md">
            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>{{ Session::get('error') }}</span>
        </div>
    </div>
@endif

@if ($errors->any())
    <div id="error-message" class="pt-3 flex items-center justify-center">
        <div class="bg-red-200 text-red-800 px-6 py-4 rounded-lg shadow-md flex items-start space-x-2 w-full max-w-md">
            <svg class="w-5 h-5 text-red-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <ul class="pl-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<script>
    setTimeout(() => {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000); 

    // setTimeout(() => {
    //     const errorMessage = document.getElementById('error-message');
    //     if (errorMessage) {
    //         errorMessage.style.display = 'none';
    //     }
    // }, 3000); 
</script>
