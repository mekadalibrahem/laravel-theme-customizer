<div class="@if(config('theme-customizer.framework') === 'bootstrap') container @else max-w-7xl mx-auto px-4 py-8 @endif">
    <div class="flex flex-col gap-8">
        <!-- Header Section -->
        <div class="flex flex-col gap-4">
            <h1 class="@if(config('theme-customizer.framework') === 'bootstrap') mt-5 mb-4 @else text-3xl font-bold text-gray-800 @endif">Theme Customizer</h1>

            @if (session('success'))
                <div class="@if(config('theme-customizer.framework') === 'bootstrap') alert alert-success mb-4 @else bg-green-100 text-green-800 p-4 rounded-lg @endif">
                    {{ session('success') }}
                </div>
            @endif

            @if(config('theme-customizer.theme_mode') === 'admin')
                <p class="@if(config('theme-customizer.framework') === 'bootstrap') text-muted mb-4 @else text-gray-600 @endif">Changes will apply to all users.</p>
            @endif
        </div>

        <!-- Theme Selection Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex flex-col gap-6">
                <div class="flex items-center gap-4">
                    <select id="theme-selector" name="theme_id" class="@if(config('theme-customizer.framework') === 'bootstrap') form-select @else w-64 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 @endif">
                        <option value="">Select a theme</option>
                        @foreach ($themes as $t)
                            <option value="{{ $t->id }}" {{ $t->id === ($theme['id'] ?? null) ? 'selected' : '' }}>{{ $t->key }}</option>
                        @endforeach
                        <option value="new">Create New Theme</option>
                    </select>
                    <div class="flex gap-2">
                        <button type="button" id="set-active-theme" class="@if(config('theme-customizer.framework') === 'bootstrap') btn btn-primary @else bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition @endif">Set as Active</button>
                        <button type="button" id="delete-theme" class="@if(config('theme-customizer.framework') === 'bootstrap') btn btn-danger @else bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition @endif hidden">Delete Theme</button>
                    </div>
                </div>

                <!-- Theme Editor Form -->
                <form action="{{ route(config('theme-customizer.routes.name_prefix') . 'update') }}" method="POST" id="theme-form" class="space-y-6">
                    @csrf
                    <div id="new-theme-input" class="hidden">
                        <label for="key" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 mb-2 @endif">Theme Key</label>
                        <input type="text" name="key" id="key" value="" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control @else w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 @endif" required>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="space-y-2">
                            <label for="primary_color" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Primary Color</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="primary_color" id="primary_color" value="{{ old('primary_color', $theme['primary_color'] ?? '#3490dc') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded cursor-pointer @endif">
                                <span class="text-sm text-gray-500">{{ old('primary_color', $theme['primary_color'] ?? '#3490dc') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="secondary_color" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Secondary Color</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="secondary_color" id="secondary_color" value="{{ old('secondary_color', $theme['secondary_color'] ?? '#ffed4a') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded cursor-pointer @endif">
                                <span class="text-sm text-gray-500">{{ old('secondary_color', $theme['secondary_color'] ?? '#ffed4a') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="light_primary" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Light Primary</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="light_primary" id="light_primary" value="{{ old('light_primary', $theme['light_primary'] ?? '#6cb2eb') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded cursor-pointer @endif">
                                <span class="text-sm text-gray-500">{{ old('light_primary', $theme['light_primary'] ?? '#6cb2eb') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="light_secondary" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Light Secondary</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="light_secondary" id="light_secondary" value="{{ old('light_secondary', $theme['light_secondary'] ?? '#fff5a1') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded cursor-pointer @endif">
                                <span class="text-sm text-gray-500">{{ old('light_secondary', $theme['light_secondary'] ?? '#fff5a1') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="accent_color" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Accent Color</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="accent_color" id="accent_color" value="{{ old('accent_color', $theme['accent_color'] ?? '#e3342f') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded cursor-pointer @endif">
                                <span class="text-sm text-gray-500">{{ old('accent_color', $theme['accent_color'] ?? '#e3342f') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="text_light" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Text Light</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="text_light" id="text_light" value="{{ old('text_light', $theme['text_light'] ?? '#ffffff') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded cursor-pointer @endif">
                                <span class="text-sm text-gray-500">{{ old('text_light', $theme['text_light'] ?? '#ffffff') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="text_dark" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Text Dark</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="text_dark" id="text_dark" value="{{ old('text_dark', $theme['text_dark'] ?? '#1a202c') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded cursor-pointer @endif">
                                <span class="text-sm text-gray-500">{{ old('text_dark', $theme['text_dark'] ?? '#1a202c') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="dark_background" class="@if(config('theme-customizer.framework') === 'bootstrap') form-label @else block text-sm font-medium text-gray-700 @endif">Dark Background</label>
                            <div class="flex items-center gap-2">
                                <input type="color" name="dark_background" id="dark_background" value="{{ old('dark_background', $theme['dark_background'] ?? '#2d3748') }}" class="@if(config('theme-customizer.framework') === 'bootstrap') form-control p-1 @else w-12 h-8 border border-gray-300 rounded cursor-pointer @endif">
                                <span class="text-sm text-gray-500">{{ old('dark_background', $theme['dark_background'] ?? '#2d3748') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="reset" class="@if(config('theme-customizer.framework') === 'bootstrap') btn btn-secondary @else bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition @endif">Reset</button>
                        <button type="submit" class="@if(config('theme-customizer.framework') === 'bootstrap') btn btn-primary @else bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800 transition @endif">Save Theme</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Preview Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Theme Preview</h2>
            <div class="space-y-6">
                <!-- Navigation Bar Preview -->
                <div class="p-4 rounded-lg" style="background-color: {{ $theme['primary_color'] ?? '#3490dc' }};">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full" style="background-color: {{ $theme['accent_color'] ?? '#e3342f' }};"></div>
                            <span style="color: {{ $theme['text_light'] ?? '#ffffff' }};">Navigation</span>
                        </div>
                        <button class="px-4 py-2 rounded" style="background-color: {{ $theme['secondary_color'] ?? '#ffed4a' }}; color: {{ $theme['text_dark'] ?? '#1a202c' }};">Action</button>
                    </div>
                </div>

                <!-- Card Preview -->
                <div class="p-6 rounded-lg" style="background-color: {{ $theme['light_primary'] ?? '#6cb2eb' }};">
                    <h3 class="text-lg font-semibold mb-2" style="color: {{ $theme['text_dark'] ?? '#1a202c' }};">Card Title</h3>
                    <p class="mb-4" style="color: {{ $theme['text_dark'] ?? '#1a202c' }};">This is a sample card with some content to demonstrate the theme colors.</p>
                    <div class="flex gap-3">
                        <button class="px-4 py-2 rounded" style="background-color: {{ $theme['primary_color'] ?? '#3490dc' }}; color: {{ $theme['text_light'] ?? '#ffffff' }};">Primary Button</button>
                        <button class="px-4 py-2 rounded" style="background-color: {{ $theme['secondary_color'] ?? '#ffed4a' }}; color: {{ $theme['text_dark'] ?? '#1a202c' }};">Secondary Button</button>
                    </div>
                </div>

                <!-- Dark Mode Preview -->
                <div class="p-6 rounded-lg" style="background-color: {{ $theme['dark_background'] ?? '#2d3748' }};">
                    <h3 class="text-lg font-semibold mb-2" style="color: {{ $theme['text_light'] ?? '#ffffff' }};">Dark Mode Preview</h3>
                    <p class="mb-4" style="color: {{ $theme['text_light'] ?? '#ffffff' }};">This section demonstrates how the theme looks in dark mode.</p>
                    <div class="flex gap-3">
                        <button class="px-4 py-2 rounded" style="background-color: {{ $theme['light_primary'] ?? '#6cb2eb' }}; color: {{ $theme['text_dark'] ?? '#1a202c' }};">Light Button</button>
                        <button class="px-4 py-2 rounded" style="background-color: {{ $theme['accent_color'] ?? '#e3342f' }}; color: {{ $theme['text_light'] ?? '#ffffff' }};">Accent Button</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Real-Time Preview and Theme Selection -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeSelector = document.getElementById('theme-selector');
            const newThemeInput = document.getElementById('new-theme-input');
            const keyInput = document.getElementById('key');
            const colorInputs = document.querySelectorAll('input[type="color"]');
            const colorSpans = document.querySelectorAll('input[type="color"] + span');
            const deleteButton = document.getElementById('delete-theme');

            // Update color span text when color input changes
            colorInputs.forEach((input, index) => {
                input.addEventListener('input', () => {
                    colorSpans[index].textContent = input.value;
                    updatePreview();
                });
            });

            // Toggle new theme input visibility and delete button
            themeSelector.addEventListener('change', () => {
                if (themeSelector.value === 'new') {
                    newThemeInput.classList.remove('hidden');
                    deleteButton.classList.add('hidden');
                    keyInput.value = '';
                    resetColors();
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

            // Reset colors to default
            function resetColors() {
                const defaultColors = {
                    primary_color: '#3490dc',
                    secondary_color: '#ffed4a',
                    light_primary: '#6cb2eb',
                    light_secondary: '#fff5a1',
                    accent_color: '#e3342f',
                    text_light: '#ffffff',
                    text_dark: '#1a202c',
                    dark_background: '#2d3748'
                };

                Object.entries(defaultColors).forEach(([key, value]) => {
                    const input = document.getElementById(key);
                    const span = input.nextElementSibling;
                    input.value = value;
                    span.textContent = value;
                });

                updatePreview();
            }

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
                        Object.entries(theme).forEach(([key, value]) => {
                            const input = document.getElementById(key);
                            const span = input?.nextElementSibling;
                            if (input && span) {
                                input.value = value;
                                span.textContent = value;
                            }
                        });
                        updatePreview();
                    });
            }

            // Update preview elements
            function updatePreview() {
                const colors = {
                    primary_color: document.getElementById('primary_color').value,
                    secondary_color: document.getElementById('secondary_color').value,
                    light_primary: document.getElementById('light_primary').value,
                    light_secondary: document.getElementById('light_secondary').value,
                    accent_color: document.getElementById('accent_color').value,
                    text_light: document.getElementById('text_light').value,
                    text_dark: document.getElementById('text_dark').value,
                    dark_background: document.getElementById('dark_background').value
                };

                // Update navigation bar
                const navBar = document.querySelector('.p-4.rounded-lg');
                navBar.style.backgroundColor = colors.primary_color;
                navBar.querySelector('span').style.color = colors.text_light;
                navBar.querySelector('button').style.backgroundColor = colors.secondary_color;
                navBar.querySelector('button').style.color = colors.text_dark;

                // Update card
                const card = document.querySelector('.p-6.rounded-lg');
                card.style.backgroundColor = colors.light_primary;
                card.querySelector('h3').style.color = colors.text_dark;
                card.querySelector('p').style.color = colors.text_dark;
                card.querySelector('button:first-child').style.backgroundColor = colors.primary_color;
                card.querySelector('button:first-child').style.color = colors.text_light;
                card.querySelector('button:last-child').style.backgroundColor = colors.secondary_color;
                card.querySelector('button:last-child').style.color = colors.text_dark;

                // Update dark mode preview
                const darkPreview = document.querySelector('.p-6.rounded-lg:last-child');
                darkPreview.style.backgroundColor = colors.dark_background;
                darkPreview.querySelector('h3').style.color = colors.text_light;
                darkPreview.querySelector('p').style.color = colors.text_light;
                darkPreview.querySelector('button:first-child').style.backgroundColor = colors.light_primary;
                darkPreview.querySelector('button:first-child').style.color = colors.text_dark;
                darkPreview.querySelector('button:last-child').style.backgroundColor = colors.accent_color;
                darkPreview.querySelector('button:last-child').style.color = colors.text_light;
            }

            // Initial setup
            updatePreview();
            deleteButton.classList.toggle('hidden', !themeSelector.value);
        });
    </script>
</div>