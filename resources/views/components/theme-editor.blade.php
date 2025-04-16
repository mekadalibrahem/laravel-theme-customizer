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
    <form action="{{ route(config('theme-customizer.routes.name_prefix') . 'update') }}" method="POST" class="@if(config('theme-customizer.framework') === 'bootstrap') mt-4 @else space-y-6 bg-white p-6 rounded-lg shadow-md @endif" id="theme-form">
        @csrf
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-3">
                <select id="theme-selector" name="theme_id" class="@if(config('theme-customizer.framework') === 'bootstrap') form-select @else border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 @endif">
                    <option value="">Select a theme</option>
                    @foreach ($themes as $t)
                        <option value="{{ $t->id }}" {{ $t->id === ($theme['id'] ?? null) ? 'selected' : '' }}>{{ $t->key }}</option>
                    @endforeach
                    <option value="new">Create New Theme</option>
                </select>
                <button type="button" id="set-active-theme" class="@if(config('theme-customizer.framework') === 'bootstrap') btn btn-primary @else bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition @endif">Set as Active</button>
                <button type="button" id="delete-theme" class="@if(config('theme-customizer.framework') === 'bootstrap') btn btn-danger @else bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition @endif hidden">Delete Theme</button>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="@if(config('theme-customizer.framework') === 'bootstrap') btn btn-primary @else bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition @endif">Save Theme</button>
                <button type="reset" class="@if(config('theme-customizer.framework') === 'bootstrap') btn btn-secondary @else bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition @endif">Reset</button>
            </div>
        </div>

        <div class="space-y-6">
            <div id="new-theme-input" class="hidden">
                <label for="key" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Theme Key</label>
                <input type="text" name="key" id="key" value="" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control @else w-full h-10 border border-gray-300 rounded-lg px-3 focus:outline-none focus:ring-2 focus:ring-green-500 @endif" required>
             
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

    <!-- JavaScript for Real-Time Preview and Theme Selection -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeSelector = document.getElementById('theme-selector');
            const newThemeInput = document.getElementById('new-theme-input');
            const keyInput = document.getElementById('key');
            const primaryColorInput = document.getElementById('primary_color');
            const secondaryColorInput = document.getElementById('secondary_color');
            const lightPrimaryInput = document.getElementById('light_primary');
            const lightSecondaryInput = document.getElementById('light_secondary');
            const accentColorInput = document.getElementById('accent_color');
            const textLightInput = document.getElementById('text_light');
            const textDarkInput = document.getElementById('text_dark');
            const darkBackgroundInput = document.getElementById('dark_background');
            const setActiveButton = document.getElementById('set-active-theme');
            const deleteButton = document.getElementById('delete-theme');
            const form = document.getElementById('theme-form');
            const colorInputs = document.querySelectorAll('input[type="color"]');
            const previewSection = document.querySelector('.preview-section');
            const previewCard = previewSection.querySelector('div');
            const previewHeading = previewSection.querySelector('h2');
            const previewText = previewSection.querySelector('p');
            const previewCardHeading = previewCard.querySelector('h3');
            const previewCardText = previewCard.querySelector('p');
            const primaryButton = previewCard.querySelector('button:nth-child(3)');
            const secondaryButton = previewCard.querySelector('button:nth-child(4)');

            // Toggle new theme input visibility and delete button
            themeSelector.addEventListener('change', () => {
                if (themeSelector.value === 'new') {
                    newThemeInput.classList.remove('hidden');
                    deleteButton.classList.add('hidden');
                    keyInput.value = '';
                    primaryColorInput.value = '#3490dc';
                    secondaryColorInput.value = '#ffed4a';
                    lightPrimaryInput.value = '#6cb2eb';
                    lightSecondaryInput.value = '#fff5a1';
                    accentColorInput.value = '#e3342f';
                    textLightInput.value = '#ffffff';
                    textDarkInput.value = '#1a202c';
                    darkBackgroundInput.value = '#2d3748';
                    updatePreview();
                } else {
                    newThemeInput.classList.add('hidden');
                    deleteButton.classList.toggle('hidden', !themeSelector.value);
                    if (themeSelector.value) {
                        fetchTheme(themeSelector.value);
                    }
                }
            });

            // Handle delete button click
            deleteButton.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this theme?')) {
                    const themeId = themeSelector.value;
                    const deleteForm = document.createElement('form');
                    deleteForm.method = 'POST';
                    deleteForm.action = '{{ route(config('theme-customizer.routes.name_prefix') . 'delete') }}';
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    
                    const themeIdInput = document.createElement('input');
                    themeIdInput.type = 'hidden';
                    themeIdInput.name = 'theme_id';
                    themeIdInput.value = themeId;
                    
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    
                    deleteForm.appendChild(csrfToken);
                    deleteForm.appendChild(themeIdInput);
                    deleteForm.appendChild(methodInput);
                    document.body.appendChild(deleteForm);
                    deleteForm.submit();
                }
            });

            // Fetch theme data
            function fetchTheme(themeId) {
                fetch('{{ route(config('theme-customizer.routes.name_prefix') . 'get-theme') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ theme_id: themeId }),
                })
                    .then(response => response.json())
                    .then(theme => {
                        keyInput.value = theme.key;
                        primaryColorInput.value = theme.primary_color;
                        secondaryColorInput.value = theme.secondary_color;
                        lightPrimaryInput.value = theme.light_primary;
                        lightSecondaryInput.value = theme.light_secondary;
                        accentColorInput.value = theme.accent_color;
                        textLightInput.value = theme.text_light;
                        textDarkInput.value = theme.text_dark;
                        darkBackgroundInput.value = theme.dark_background;
                        updatePreview();
                    });
            }

            // Set active theme
            setActiveButton.addEventListener('click', () => {
                const themeId = themeSelector.value;
                if (themeId && themeId !== 'new') {
                    fetch('{{ route(config('theme-customizer.routes.name_prefix') . 'set-active') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ theme_id: themeId }),
                    })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message || 'Active theme set successfully!');
                            window.location.reload();
                        });
                }
            });

            // Real-time preview
            function updatePreview() {
                previewSection.style.backgroundColor = document.getElementById('dark_background').value;
                previewHeading.style.color = document.getElementById('text_light').value;
                previewText.style.color = document.getElementById('text_light').value;
                previewCard.style.backgroundColor = document.getElementById('light_primary').value;
                previewCardHeading.style.color = document.getElementById('text_dark').value;
                previewCardText.style.color = document.getElementById('text_dark').value;
                primaryButton.style.backgroundColor = document.getElementById('primary_color').value;
                primaryButton.style.color = document.getElementById('text_light').value;
                primaryButton.style.borderColor = document.getElementById('accent_color').value;
                secondaryButton.style.backgroundColor = document.getElementById('secondary_color').value;
                secondaryButton.style.color = document.getElementById('text_dark').value;
            }

            colorInputs.forEach(input => {
                input.addEventListener('input', updatePreview);
            });

            // Initial preview update and delete button state
            updatePreview();
            deleteButton.classList.toggle('hidden', !themeSelector.value);
        });
    </script>
</div>