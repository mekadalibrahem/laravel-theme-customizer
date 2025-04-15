<style>
    @php
        use YourVendor\ThemeCustomizer\Factories\ThemeFrameworkFactory;
        $framework = ThemeFrameworkFactory::create('tailwind');
        echo $framework->getStyles($theme);
    @endphp
</style>