# Flux UI Setup for PAPIAccount Package

The PAPIAccount package uses Livewire Flux UI components. Follow these steps to properly configure Flux in your Laravel application.

## Error You're Seeing

```
InvalidArgumentException
Unable to locate a class or view for component [flux::option].
```

This occurs when Flux UI isn't properly installed or configured in your Laravel application.

## Solution Steps

### 1. Install Flux UI (if not already installed)

In your main Laravel application (not the package):

```bash
composer require livewire/flux
```

### 2. Install Flux UI Assets

```bash
php artisan flux:install
```

This command will:
- Publish Flux configuration
- Install required NPM packages
- Configure Tailwind CSS
- Set up Flux components

### 3. Build Assets

```bash
npm install
npm run build
# or for development
npm run dev
```

### 4. Verify Installation

Check that these files exist in your Laravel app:

```
config/flux.php
resources/views/components/flux/ (directory with Flux components)
```

### 5. Clear Caches

```bash
php artisan view:clear
php artisan config:clear
php artisan route:clear
```

## Alternative: Use Non-Flux Version

If you don't want to use Flux UI, you can create standard HTML versions of the templates.

### Create Override Templates

Publish the PAPIAccount views:

```bash
php artisan vendor:publish --tag=papiaccount-views
```

Then edit these files to use standard HTML instead of Flux components:

- `resources/views/vendor/papiaccount/livewire/patron/location-test.blade.php`

## Testing the Fix

After completing the setup:

1. Visit your `/location-test` route
2. The Flux components should now load properly
3. You should see the postal code and UDF select dropdowns

## Troubleshooting

### Still Getting Flux Errors?

1. **Check Flux Installation:**
   ```bash
   composer show livewire/flux
   ```

2. **Verify Config:**
   ```bash
   php artisan config:show flux
   ```

3. **Check Component Registration:**
   ```bash
   php artisan about
   ```

### Alternative HTML Template

If Flux continues to cause issues, I can provide a standard HTML version that doesn't require Flux.

## Support

If you continue having issues, check:
- Laravel version compatibility with Flux
- Node.js and NPM versions
- Tailwind CSS configuration
- Browser console for JavaScript errors