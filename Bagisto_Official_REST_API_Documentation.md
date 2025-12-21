# Bagisto Official REST API Documentation Guide

## Reference: Official Bagisto Documentation
**Source**: https://devdocs.bagisto.com/api/rest-api.html

## 🚀 Key Findings from Official Documentation

### Live Demo Links (for testing API endpoints)
- **Admin API Demo**: https://demo.bagisto.com/bagisto-api-demo-common/api/admin/documentation#/
- **Shop API Demo**: https://demo.bagisto.com/bagisto-api-demo-common/api/shop/documentation#/

### 📦 Official Installation Process

#### Step 1: Install the Package
```bash
composer require bagisto/rest-api
```

#### Step 2: Environment Configuration
Add to `.env` file:
```properties
# Replace with your actual domain
SANCTUM_STATEFUL_DOMAINS=http://localhost/public
```
**Important**: Replace `http://localhost/public` with your actual domain URL. For production, use your live domain (e.g., `https://yourdomain.com`).

#### Step 3: Run Installation Command
```bash
php artisan bagisto-rest-api:install
```
This command will:
- Publish API configuration files
- Set up Swagger documentation  
- Configure authentication routes

### 📖 Documentation Access URLs

Once installed, access the interactive API documentation:

**Admin API Documentation**:
```
http://localhost/public/api/admin/documentation
```

**Shop API Documentation**:
```
http://localhost/public/api/shop/documentation
```

### 🔐 Authentication (Laravel Sanctum)

The REST API uses Laravel Sanctum for secure token-based authentication:

#### Getting an Access Token
1. **Admin Authentication**: Use admin credentials for admin-level access
2. **Customer Authentication**: Use customer credentials for shop-level access

#### Using Tokens in Requests
```bash
curl -H "Authorization: Bearer YOUR_TOKEN_HERE" \
     -H "Accept: application/json" \
     http://localhost/public/api/v1/admin/get
```

### 🎯 Common Use Cases

#### Mobile App Development
```javascript
// Example: Fetch products for mobile app
fetch('/api/v1/products', {
  headers: {
    'Authorization': 'Bearer ' + token,
    'Accept': 'application/json'
  }
})
.then(response => response.json())
.then(products => {
  // Display products in your mobile app
});
```

#### Third-party Integration
```php
// Example: Sync product from external system
$response = Http::withToken($token)->post("/api/v1/admin/catalog/products/{$productId}", [
    'name'  => 'Product Name',
    'sku'   => 'PROD-001',
    'price' => 99.99
]);
```

### 🔗 API Endpoints Structure

Based on the documentation, the API follows this pattern:
- **Admin API**: `/api/v1/admin/*` (for administrative functions)
- **Shop API**: `/api/v1/shop/*` (for customer-facing functions)

### 🚨 Why Our Local Setup Had Issues

The documentation reveals that proper API access requires:

1. **Correct Domain Configuration**: The `SANCTUM_STATEFUL_DOMAINS` must match your actual domain
2. **Installation Command**: Running `php artisan bagisto-rest-api:install` is essential
3. **Proper Route Loading**: The installation process configures the necessary routes

Our local setup (http://localhost:8001) may need:
- Updated `.env` configuration
- Proper route cache clearing
- Installation of the REST API package with the artisan command

### 📚 Next Steps

1. **Follow Official Installation**: Use the exact steps from the documentation
2. **Check Domain Configuration**: Ensure SANCTUM_STATEFUL_DOMAINS matches your local setup
3. **Run Installation Command**: Execute `php artisan bagisto-rest-api:install`
4. **Clear Route Cache**: Run `php artisan route:clear` and `php artisan config:clear`
5. **Test Documentation Access**: Visit the admin and shop API documentation URLs

This official documentation provides the definitive guide for setting up and using Bagisto's REST API for mobile development and third-party integrations.
