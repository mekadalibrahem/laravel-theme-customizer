<style>
    @php
        use YourVendor\ThemeCustomizer\Factories\ThemeFrameworkFactory;
        $framework = ThemeFrameworkFactory::create('bootstrap');
        echo $framework->getStyles($theme);
    @endphp
</style>