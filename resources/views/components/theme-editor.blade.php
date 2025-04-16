<div class="@if(config('theme-customizer.framework') === 'bootstrap') container @else max-w-7xl mx-auto px-4 py-8 @endif">
    <h1 class="@if(config('theme-customizer.framework') === 'bootstrap') mt-5 mb-4 @else text-3xl font-bold mb-6 text-gray-800 @endif">Customize Theme</h1>

    @if (session('success'))
        <div class="@if(config('theme-customizer.framework') === 'bootstrap') alert alert-success mb-4 @else bg-green-100 text-green-800 p-4 rounded-lg mb-6 @endif">
            {{ session('success') }}
        </div>
    @endif

    @if(config('theme-customizer.theme_mode') === 'admin')
        <p class="@if(config('theme-customizer.framework') === 'bootstrap') text-muted mb-4 @else text-gray-600 mb-6 @endif">Changes will apply to all users.</p>
    @endif

    <!-- Form Section -->
    <form action="{{ route('theme-customizer.update') }}" method="POST" class="@if(config('theme-customizer.framework') === 'bootstrap') mt-4 @else space-y-6 bg-white p-6 rounded-lg shadow-md @endif">
        @csrf
        <div class="flex justify-end gap-3 mb-6">
            <button type="submit" class="@if(config('theme-customizer.framework') === 'bootstrap') btn btn-primary @else bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition @endif">Save Theme</button>
            <button type="reset" class="@if(config('theme-customizer.framework') === 'bootstrap') btn btn-secondary @else bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition @endif">Reset</button>
        </div>

        <div class="space-y-6">
            <div>
                <label for="key" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Theme Name</label>
                <input type="text" name="key" id="key" value="{{ old('key', $theme['key'] ?? 'custom_theme') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control @else w-full h-10 border border-gray-300 rounded-lg px-3 focus:outline-none focus:ring-2 focus:ring-green-500 @endif" required>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label for="primary_color" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Primary Color</label>
                    <input type="color" name="primary_color" id="primary_color" value="{{ old('primary_color', $theme['primary_color'] ?? '#3490dc') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded @endif">
                </div>

                <div>
                    <label for="secondary_color" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Secondary Color</label>
                    <input type="color" name="secondary_color" id="secondary_color" value="{{ old('secondary_color', $theme['secondary_color'] ?? '#ffed4a') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded @endif">
                </div>

                <div>
                    <label for="light_primary" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Light Primary</label>
                    <input type="color" name="light_primary" id="light_primary" value="{{ old('light_primary', $theme['light_primary'] ?? '#6cb2eb') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded @endif">
                </div>

                <div>
                    <label for="light_secondary" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Light Secondary</label>
                    <input type="color" name="light_secondary" id="light_secondary" value="{{ old('light_secondary', $theme['light_secondary'] ?? '#fff5a1') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded @endif">
                </div>

                <div>
                    <label for="accent_color" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Accent Color</label>
                    <input type="color" name="accent_color" id="accent_color" value="{{ old('accent_color', $theme['accent_color'] ?? '#e3342f') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded @endif">
                </div>

                <div>
                    <label for="text_light" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Text Light</label>
                    <input type="color" name="text_light" id="text_light" value="{{ old('text_light', $theme['text_light'] ?? '#ffffff') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded @endif">
                </div>

                <div>
                    <label for="text_dark" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Text Dark</label>
                    <input type="color" name="text_dark" id="text_dark" value="{{ old('text_dark', $theme['text_dark'] ?? '#1a202c') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded @endif">
                </div>

                <div>
                    <label for="dark_background" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Dark Background</label>
                    <input type="color" name="dark_background" id="dark_background" value="{{ old('dark_background', $theme['dark_background'] ?? '#2d3748') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded @endif">
                </div>
            </div>
        </div>
    </form>

    <!-- Preview Section -->
    <div class="preview-section mt-8 p-6 rounded-lg shadow-md" style="background-color: {{ $theme['dark_background'] ?? '#2d3748' }};">
        <h2 class="text-2xl font-bold" style="color: {{ $theme['text_light'] ?? '#ffffff' }};">Theme Preview</h2>
        <p class="mt-2" style="color: {{ $theme['text_light'] ?? '#ffffff' }};">This is how your theme will look.</p>
        <div class="mt-4 p-4 rounded" style="background-color: {{ $theme['light_primary'] ?? '#6cb2eb' }};">
            <h3 class="font-semibold" style="color: {{ $theme['text_dark'] ?? '#1a202c' }};">Sample Card</h3>
            <p style="color: {{ $theme['text_dark'] ?? '#1a202c' }};">This is a sample card with some content.</p>
            <button class="mt-2 px-4 py-2 rounded" style="background-color: {{ $theme['primary_color'] ?? '#3490dc' }}; color: {{ $theme['text_light'] ?? '#ffffff' }}; border: 2px solid {{ $theme['accent_color'] ?? '#e3342f' }};">
                Primary Button
            </button>
            <button class="mt-2 ml-2 px-4 py-2 rounded" style="background-color: {{ $theme['secondary_color'] ?? '#ffed4a' }}; color: {{ $theme['text_dark'] ?? '#1a202c' }};">
                Secondary Button
            </button>
        </div>
    </div>

    <!-- JavaScript for Real-Time Preview -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input[type="color"], input[type="text"]');
            const previewSection = document.querySelector('.preview-section');
            const previewCard = previewSection.querySelector('div');
            const previewHeading = previewSection.querySelector('h2');
            const previewText = previewSection.querySelector('p');
            const previewCardHeading = previewCard.querySelector('h3');
            const previewCardText = previewCard.querySelector('p');
            const primaryButton = previewCard.querySelector('button:nth-child(3)');
            const secondaryButton = previewCard.querySelector('button:nth-child(4)');

            inputs.forEach(input => {
                input.addEventListener('input', () => {
                    switch (input.id) {
                        case 'dark_background':
                            previewSection.style.backgroundColor = input.value;
                            break;
                        case 'text_light':
                            previewHeading.style.color = input.value;
                            previewText.style.color = input.value;
                            primaryButton.style.color = input.value;
                            break;
                        case 'text_dark':
                            previewCardHeading.style.color = input.value;
                            previewCardText.style.color = input.value;
                            secondaryButton.style.color = input.value;
                            break;
                        case 'light_primary':
                            previewCard.style.backgroundColor = input.value;
                            break;
                        case 'primary_color':
                            primaryButton.style.backgroundColor = input.value;
                            break;
                        case 'secondary_color':
                            secondaryButton.style.backgroundColor = input.value;
                            break;
                        case 'accent_color':
                            primaryButton.style.borderColor = input.value;
                            break;
                    }
                });
            });
        });
    </script>
</div>