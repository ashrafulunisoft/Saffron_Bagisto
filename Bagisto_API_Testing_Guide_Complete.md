# Complete Bagisto REST API Guide for Mobile Development

## 🚀 Official Installation Requirements (From Bagisto Documentation)

### Reference: Official Bagisto REST API Documentation
**Source**: https://devdocs.bagisto.com/api/rest-api.html

### Live Demo URLs (for testing)
- **Admin API Demo**: https://demo.bagisto.com/bagisto-api-demo-common/api/admin/documentation#/
- **Shop API Demo**: https://demo.bagisto.com/bagisto-api-demo-common/api/shop/documentation#/

### Step-by-Step Installation Process

#### Step 1: Install the REST API Package
```bash
composer require bagisto/rest-api
```

#### Step 2: Environment Configuration
Add to your `.env` file:
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

#### Step 4: Clear Cache and Restart
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan serve
```

### 📖 Documentation Access URLs

Once properly installed, access the interactive API documentation:

**Admin API Documentation**:
```
http://localhost/public/api/admin/documentation
```

**Shop API Documentation**:
```
http://localhost/public/api/shop/documentation
```

---

## 🔐 Authentication (Laravel Sanctum)

The REST API uses Laravel Sanctum for secure token-based authentication:

### Getting an Access Token
1. **Admin Authentication**: Use admin credentials for admin-level access
2. **Customer Authentication**: Use customer credentials for shop-level access

### Using Tokens in Requests
```bash
curl -H "Authorization: Bearer YOUR_TOKEN_HERE" \
     -H "Accept: application/json" \
     http://localhost/public/api/v1/admin/get
```

---

## 🧪 Complete API Testing Guide

### Prerequisites
- Your Bagisto application should be running
- REST API package properly installed with `php artisan bagisto-rest-api:install`
- Base URL: `http://localhost:8001/api/` (adjust for your setup)

---

## 1. Product APIs Testing

### Get All Products
```bash
curl -X GET "http://localhost:8001/api/products" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get Product by ID
```bash
curl -X GET "http://localhost:8001/api/products/1" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get Related Products
```bash
curl -X GET "http://localhost:8001/api/products/1/related" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get Products with Filters
```bash
curl -X GET "http://localhost:8001/api/products?search=bakery&category_id=1&page=1&limit=10" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

---

## 2. Category APIs Testing

### Get All Categories
```bash
curl -X GET "http://localhost:8001/api/categories" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get Category Tree
```bash
curl -X GET "http://localhost:8001/api/categories/tree" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

---

## 3. Cart APIs Testing

### Get Cart (Requires Authentication)
```bash
curl -X GET "http://localhost:8001/api/checkout/cart" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Add Product to Cart
```bash
curl -X POST "http://localhost:8001/api/checkout/cart" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "product_id": 1,
    "quantity": 2,
    "selected_configurable_option": null,
    "attributes": {}
  }'
```

---

## 4. Checkout APIs Testing

### Store Address (Requires Authentication)
```bash
curl -X POST "http://localhost:8001/api/checkout/onepage/addresses" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "billing": {
      "first_name": "John",
      "last_name": "Doe",
      "address1": "123 Main St",
      "city": "Los Angeles",
      "state": "CA",
      "postcode": "90210",
      "country": "US",
      "phone": "+1234567890"
    },
    "shipping": {
      "first_name": "John",
      "last_name": "Doe",
      "address1": "123 Main St",
      "city": "Los Angeles",
      "state": "CA",
      "postcode": "90210",
      "country": "US",
      "phone": "+1234567890"
    },
    "shipping_as_billing": true
  }'
```

---

## 5. Customer APIs Testing

### Customer Login
```bash
curl -X POST "http://localhost:8001/api/customer/login" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "customer@example.com",
    "password": "password123"
  }'
```

### Get Customer Profile (Requires Authentication)
```bash
curl -X GET "http://localhost:8001/api/customer/profile" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Get Customer Addresses (Requires Authentication)
```bash
curl -X GET "http://localhost:8001/api/customer/addresses" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

---

## 6. Wishlist APIs Testing

### Get Wishlist (Requires Authentication)
```bash
curl -X GET "http://localhost:8001/api/customer/wishlist" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Add to Wishlist (Requires Authentication)
```bash
curl -X POST "http://localhost:8001/api/customer/wishlist" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "product_id": 1
  }'
```

---

## 7. Review APIs Testing

### Get Product Reviews
```bash
curl -X GET "http://localhost:8001/api/product/1/reviews" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Create Product Review (Requires Authentication)
```bash
curl -X POST "http://localhost:8001/api/product/1/review" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "rating": 5,
    "title": "Great product!",
    "comment": "This bakery product exceeded my expectations."
  }'
```

---

## 8. Compare APIs Testing

### Get Compare List
```bash
curl -X GET "http://localhost:8001/api/compare-items" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Add to Compare (Requires Authentication)
```bash
curl -X POST "http://localhost:8001/api/compare-items" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE" \
  -d '{
    "product_id": 1
  }'
```

---

## 9. Core APIs Testing

### Get Countries
```bash
curl -X GET "http://localhost:8001/api/core/countries" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get States
```bash
curl -X GET "http://localhost:8001/api/core/states?country_id=230" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

---

## 🎯 Mobile App Development Examples

### JavaScript Example
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

### React Native Example
```javascript
// Example: React Native mobile app
import axios from 'axios';

const fetchProducts = async () => {
  try {
    const response = await axios.get('http://localhost:8001/api/products', {
      headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
      }
    });
    return response.data;
  } catch (error) {
    console.error('Error fetching products:', error);
  }
};
```

### PHP Example (Third-party Integration)
```php
// Example: Sync product from external system
$response = Http::withToken($token)->post("http://localhost:8001/api/v1/admin/catalog/products/{$productId}", [
    'name'  => 'Product Name',
    'sku'   => 'PROD-001',
    'price' => 99.99
]);
```

---

## 🔧 Testing Tips and Tools

### 1. Use jq for JSON formatting
```bash
curl -X GET "http://localhost:8001/api/products" | jq .
```

### 2. Save responses
```bash
curl -X GET "http://localhost:8001/api/products" \
  -H "Accept: application/json" \
  -o products_response.json
```

### 3. Test with different HTTP methods
- **GET**: Retrieve data
- **POST**: Create new data
- **PUT**: Update existing data
- **DELETE**: Remove data

### 4. Handle Authentication
- For authenticated routes, include Bearer tokens
- Store tokens securely in mobile apps

### 5. Error Handling
Check for error responses:
```bash
curl -i "http://localhost:8001/api/products/999"  # Test 404 error
```

### 6. Mobile Testing
Test from mobile device on same network:
```bash
curl -X GET "http://YOUR_LOCAL_IP:8001/api/products" \
  -H "Accept: application/json"
```

---

## 🚨 Common Issues and Solutions

### 1. 404 Not Found
- **Check if REST API package is properly installed**
- **Run**: `php artisan bagisto-rest-api:install`
- **Verify**: `SANCTUM_STATEFUL_DOMAINS` in `.env` matches your domain
- **Clear cache**: `php artisan route:clear`

### 2. 500 Internal Server Error
- Check Laravel logs: `storage/logs/laravel.log`
- Ensure database is properly seeded
- Run: `php artisan config:clear`

### 3. Authentication Errors
- Ensure you're using proper Laravel Sanctum tokens
- Check token validity and expiration
- Verify user has appropriate permissions

### 4. CORS Issues
- Add CORS headers if testing from different domains
- Configure in `config/cors.php`

### 5. Route Not Found
- **This was our main issue**: The API routes weren't properly loaded
- **Solution**: Follow the official installation steps above
- **Key**: Run `php artisan bagisto-rest-api:install` command

---

## 📱 Mobile Development Checklist

- [ ] Install `bagisto/rest-api` package
- [ ] Configure `SANCTUM_STATEFUL_DOMAINS` in `.env`
- [ ] Run `php artisan bagisto-rest-api:install`
- [ ] Clear all caches
- [ ] Test API documentation URLs
- [ ] Implement token-based authentication
- [ ] Handle API responses and errors
- [ ] Test on actual mobile devices
- [ ] Implement proper error handling
- [ ] Add loading states for better UX

---

## 📚 Additional Resources

- **Official Documentation**: https://devdocs.bagisto.com/api/rest-api.html
- **Live Demo**: Test with the demo URLs provided above
- **Interactive Testing**: Use the Swagger documentation at `/api/admin/documentation`

This complete guide combines the official Bagisto REST API installation requirements with comprehensive testing procedures for mobile development!
