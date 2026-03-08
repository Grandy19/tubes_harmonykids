<?php
/**
 * Clear Laravel Cache Script
 * Upload this file to: /home/harmonykids.free.nets.web.id/public_html/public/
 * Then access: https://harmonykids.free.nets.web.id/clear-cache.php
 */

echo "<h1>Clearing Laravel Cache...</h1>";
echo "<pre>";

try {
    // Load Laravel (go up one level from public to project root)
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    
    $kernel = $app->make('Illuminate\Contracts\Console\Kernel');
    
    // Clear route cache
    echo "Clearing route cache...\n";
    $kernel->call('route:clear');
    echo "✅ Route cache cleared!\n\n";
    
    // Clear config cache
    echo "Clearing config cache...\n";
    $kernel->call('config:clear');
    echo "✅ Config cache cleared!\n\n";
    
    // Clear application cache
    echo "Clearing application cache...\n";
    $kernel->call('cache:clear');
    echo "✅ Application cache cleared!\n\n";
    
    // Clear view cache
    echo "Clearing view cache...\n";
    $kernel->call('view:clear');
    echo "✅ View cache cleared!\n\n";
    
    echo "</pre>";
    echo "<h2 style='color: green;'>✅ All caches cleared successfully!</h2>";
    echo "<p><strong>Next steps:</strong></p>";
    echo "<ol>";
    echo "<li>Hot restart your Flutter app (press 'R' in terminal)</li>";
    echo "<li>Test HarmoTalk feature</li>";
    echo "<li>Delete this file after use for security</li>";
    echo "</ol>";
    
} catch (Exception $e) {
    echo "</pre>";
    echo "<h2 style='color: red;'>❌ Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
