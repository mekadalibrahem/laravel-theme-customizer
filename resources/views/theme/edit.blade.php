<!DOCTYPE html>
<html>
<head>
    <title>Customize Theme</title>
    @if (config('theme-customizer.framework') === 'bootstrap')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @elseif (config('theme-customizer.framework') === 'tailwind')
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-background text-color">
    <div class="@if(config('theme-customizer.framework') === 'bootstrap') container @else max-w-7xl mx-auto px-4 @endif">
        <h1 class="@if(config('theme-customizer.framework') === 'bootstrap') mt-5 @else text-3xl font-bold mt-8 @endif">Customize Theme</h1>

        @if (session('success'))
            <div class="@if(config('theme-customizer.framework') === 'bootstrap') alert alert-success @else bg-green-100 text-green-800 p-4 rounded @endif">
                {{ session('success') }}
            </div>
        @endif

        @if(config('theme-customizer.theme_mode') === 'admin')
            <p class="@if(config('theme-customizer.framework') === 'bootstrap') text-muted @else text-gray-600 @endif">Changes will apply to all users.</p>
        @endif

        <form action="{{ route('theme-customizer.update') }}" method="POST" class="@if(config('theme-customizer.framework') === 'bootstrap') mt-4 @else space-y-4 @endif">
            @csrf
            <div class="@if(config('theme-customizer.framework') === 'bootstrap') mb-3 @else @endif">
                <label for="primary_color" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium @endif">Primary Color</label>
                <input type="color" name="primary_color" id="primary_color" value="{{ old('primary_color', $theme['primary_color'] ?? '#3490dc') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control @else w-full h-10 border rounded @endif">
                {{-- @error('primary_color')
                    <span class="@if(config('theme-customizer.framework') === 'bootstrap') text-danger @else text-red-500 text-sm @endif">{{ $message }}</span>
                @enderror --}}
            </div>

            <div class="@if(config('theme-customizer.framework') === 'bootstrap') mb-3 @else @endif">
                <label for="secondary_color" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium @endif">Secondary Color</label>
                <input type="color" name="secondary_color" id="secondary_color" value="{{ old('secondary_color', $theme['secondary_color'] ?? '#ffed4a') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control @else w-full h-10 border rounded @endif">
                {{-- @error('secondary_color')
                    <span class="@if(config('theme-customizer.framework') === 'bootstrap') text-danger @else text-red-500 text-sm @endif">{{ $message }}</span>
                @enderror --}}
            </div>

            <div class="@if(config('theme-customizer.framework') === 'bootstrap') mb-3 @else @endif">
                <label for="background_color" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium @endif">Background Color</label>
                <input type="color" name="background_color" id="background_color" value="{{ old('background_color', $theme['background_color'] ?? '#ffffff') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control @else w-full h-10 border rounded @endif">
                {{-- @error('background_color')
                    <span class="@if(config('theme-customizer.framework') === 'bootstrap') text-danger @else text-red-500 text-sm @endif">{{ $message }}</span>
                @enderror --}}
            </div>

            <div class="@if(config('theme-customizer.framework') === 'bootstrap') mb-3 @else @endif">
                <label for="text_color" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium @endif">Text Color</label>
                <input type="color" name="text_color" id="text_color" value="{{ old('text_color', $theme['text_color'] ?? '#1a202c') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control @else w-full h-10 border rounded @endif">
                {{-- @error('text_color')
                    <span class="@if(config('theme-customizer.framework') === 'bootstrap') text-danger @else text-red-500 text-sm @endif">{{ $message }}</span>
                @enderror --}}
            </div>

            <button type="submit" class="@if(config('theme-customizer.framework') === 'bootstrap') btn btn-primary @else bg-primary text-white px-4 py-2 rounded hover:bg-opacity-90 @endif">Save Theme</button>
        </form>
    </div>
</body>
</html>