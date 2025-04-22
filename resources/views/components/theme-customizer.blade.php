<div class="theme-customizer">
    <form id="themeCustomizerForm" method="POST" action="{{ route('theme-customizer.update') }}">
        @csrf
        <div class="color-picker-group">
            <div class="color-picker">
                <label for="primary">Primary Color</label>
                <input type="color" id="primary" name="colors[primary]" value="{{ $colors['primary'] }}">
            </div>
            <div class="color-picker">
                <label for="secondary">Secondary Color</label>
                <input type="color" id="secondary" name="colors[secondary]" value="{{ $colors['secondary'] }}">
            </div>
            <div class="color-picker">
                <label for="accent">Accent Color</label>
                <input type="color" id="accent" name="colors[accent]" value="{{ $colors['accent'] }}">
            </div>
            <div class="color-picker">
                <label for="warning">Warning Color</label>
                <input type="color" id="warning" name="colors[warning]" value="{{ $colors['warning'] }}">
            </div>
            <div class="color-picker">
                <label for="success">Success Color</label>
                <input type="color" id="success" name="colors[success]" value="{{ $colors['success'] }}">
            </div>
            <div class="color-picker">
                <label for="highlight">Highlight Color</label>
                <input type="color" id="highlight" name="colors[highlight]" value="{{ $colors['highlight'] }}">
            </div>
            <div class="color-picker">
                <label for="dark">Dark Color</label>
                <input type="color" id="dark" name="colors[dark]" value="{{ $colors['dark'] }}">
            </div>
            <div class="color-picker">
                <label for="neutral">Neutral Color</label>
                <input type="color" id="neutral" name="colors[neutral]" value="{{ $colors['neutral'] }}">
            </div>
            <div class="color-picker">
                <label for="light">Light Color</label>
                <input type="color" id="light" name="colors[light]" value="{{ $colors['light'] }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save Colors</button>
    </form>
</div>

<style>
.theme-customizer {
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.color-picker-group {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.color-picker {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.color-picker label {
    font-weight: 500;
    color: #333;
}

.color-picker input[type="color"] {
    width: 100%;
    height: 40px;
    padding: 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
}

.btn-primary {
    background-color: var(--primary-color, #000);
    color: #fff;
}
</style>

<script>
document.getElementById('themeCustomizerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    fetch(this.action, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            colors: Object.fromEntries(new FormData(this).entries())
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update CSS variables
            Object.entries(data.colors).forEach(([key, value]) => {
                document.documentElement.style.setProperty(`--${key}-color`, value);
            });
        }
    })
    .catch(error => console.error('Error:', error));
});
</script> 