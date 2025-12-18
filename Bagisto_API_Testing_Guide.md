# Bagisto API Testing with cURL

This guide provides practical cURL commands to test your Bagisto Saffron APIs for order, cart, product, and other functionalities.

## Prerequisites
- Your Bagisto application should be running (php artisan serve)
- Base URL: `http://localhost:8000/api/` (adjust for your setup)

---

## 1. Product APIs Testing

### Get All Products
```bash
curl -X GET "http://localhost:8000/api/products" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get Product by ID
```bash
curl -X GET "http://localhost:8000/api/products/1" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get Related Products
```bash
curl -X GET "http://localhost:8000/api/products/1/related" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get Upsell Products
```bash
curl -X GET "http://localhost:8000/api/products/1/up-sell" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get Products with Filters
```bash
curl -X GET "http://localhost:8000/api/products?search=bakery&category_id=1&page=1&limit=10" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

---

## 2. Category APIs Testing

### Get All Categories
```bash
curl -X GET "http://localhost:8000/api/categories" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get Category Tree
```bash
curl -X GET "http://localhost:8000/api/categories/tree" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get Category Attributes
```bash
curl -X GET "http://localhost:8000/api/categories/attributes" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get Max Price in Category
```bash
curl -X GET "http://localhost:8000/api/categories/max-price/1" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

---

## 3. Cart APIs Testing

### Get Cart (Empty initially)
```bash
curl -X GET "http://localhost:8000/api/checkout/cart" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here"
```

### Add Product to Cart
```bash
curl -X POST "http://localhost:8000/api/checkout/cart" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
  -d '{
    "product_id": 1,
    "quantity": 2,
    "selected_configurable_option": null,
    "attributes": {}
  }'
```

### Update Cart Item
```bash
curl -X PUT "http://localhost:8000/api/checkout/cart" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
  -d '{
    "cart_item_id": 1,
    "quantity": 3
  }'
```

### Remove Item from Cart
```bash
curl -X DELETE "http://localhost:8000/api/checkout/cart" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
  -d '{
    "cart_item_id": 1
  }'
```

### Apply Coupon
```bash
curl -X POST "http://localhost:8000/api/checkout/cart/coupon" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
  -d '{
    "code": "DISCOUNT10"
  }'
```

### Estimate Shipping Methods
```bash
curl -X POST "http://localhost:8000/api/checkout/cart/estimate-shipping-methods" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
  -d '{
    "country": "US",
    "state": "CA",
    "postcode": "90210"
  }'
```

---

## 4. Checkout APIs Testing

### Get Checkout Summary
```bash
curl -X GET "http://localhost:8000/api/checkout/onepage/summary" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here"
```

### Store Address
```bash
curl -X POST "http://localhost:8000/api/checkout/onepage/addresses" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
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

### Store Shipping Method
```bash
curl -X POST "http://localhost:8000/api/checkout/onepage/shipping-methods" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
  -d '{
    "shipping_method": "flatrate"
  }'
```

### Store Payment Method
```bash
curl -X POST "http://localhost:8000/api/checkout/onepage/payment-methods" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
  -d '{
    "payment_method": "cashondelivery"
  }'
```

### Create Order
```bash
curl -X POST "http://localhost:8000/api/checkout/onepage/orders" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
  -d '{
    "payment": {
      "method": "cashondelivery"
    }
  }'
```

---

## 5. Customer APIs Testing

### Customer Login
```bash
curl -X POST "http://localhost:8000/api/customer/login" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "email": "customer@example.com",
    "password": "password123"
  }'
```

### Get Customer Addresses (Requires Authentication)
```bash
curl -X GET "http://localhost:8000/api/customer/addresses" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here"
```

### Create Address (Requires Authentication)
```bash
curl -X POST "http://localhost:8000/api/customer/addresses" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
  -d '{
    "first_name": "John",
    "last_name": "Doe",
    "address1": "456 Oak Street",
    "city": "New York",
    "state": "NY",
    "postcode": "10001",
    "country": "US",
    "phone": "+1987654321"
  }'
```

---

## 6. Wishlist APIs Testing

### Get Wishlist (Requires Authentication)
```bash
curl -X GET "http://localhost:8000/api/customer/wishlist" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here"
```

### Add to Wishlist (Requires Authentication)
```bash
curl -X POST "http://localhost:8000/api/customer/wishlist" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
  -d '{
    "product_id": 1
  }'
```

### Remove from Wishlist (Requires Authentication)
```bash
curl -X DELETE "http://localhost:8000/api/customer/wishlist/1" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here"
```

---

## 7. Review APIs Testing

### Get Product Reviews
```bash
curl -X GET "http://localhost:8000/api/product/1/reviews" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Create Product Review
```bash
curl -X POST "http://localhost:8000/api/product/1/review" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
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
curl -X GET "http://localhost:8000/api/compare-items" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here"
```

### Add to Compare
```bash
curl -X POST "http://localhost:8000/api/compare-items" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
  -d '{
    "product_id": 1
  }'
```

### Remove from Compare
```bash
curl -X DELETE "http://localhost:8000/api/compare-items" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Cookie: your_session_cookie_here" \
  -d '{
    "product_id": 1
  }'
```

---

## 9. Core APIs Testing

### Get Countries
```bash
curl -X GET "http://localhost:8000/api/core/countries" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

### Get States
```bash
curl -X GET "http://localhost:8000/api/core/states?country_id=230" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json"
```

---

## Testing Tips

### 1. Save cURL commands to files
Create a shell script for easy testing:
```bash
#!/bin/bash
# test_apis.sh

echo "Testing Product APIs..."
curl -X GET "http://localhost:8000/api/products" \
  -H "Accept: application/json"

echo -e "\n\nTesting Cart APIs..."
curl -X GET "http://localhost:8000/api/checkout/cart" \
  -H "Accept: application/json"
```

### 2. Use jq for JSON formatting
```bash
curl -X GET "http://localhost:8000/api/products" | jq .
```

### 3. Save responses
```bash
curl -X GET "http://localhost:8000/api/products" \
  -H "Accept: application/json" \
  -o products_response.json
```

### 4. Test with different HTTP methods
- **GET**: Retrieve data
- **POST**: Create new data
- **PUT**: Update existing data
- **DELETE**: Remove data

### 5. Handle Authentication
- For authenticated routes, include session cookies
- Use browser developer tools to get session cookies after login
- Or implement token-based authentication

### 6. Error Handling
Check for error responses:
```bash
curl -i "http://localhost:8000/api/products/999"  # Test 404 error
```

### 7. Mobile Testing
Test from mobile device on same network:
```bash
curl -X GET "http://YOUR_LOCAL_IP:8000/api/products" \
  -H "Accept: application/json"
```

---

## Common Issues and Solutions

### 1. 404 Not Found
- Check if your Laravel server is running
- Verify the API route exists in `packages/Webkul/Shop/src/Routes/api.php`

### 2. 500 Internal Server Error
- Check Laravel logs: `storage/logs/laravel.log`
- Ensure database is properly seeded

### 3. CSRF Token Issues
- For POST/PUT/DELETE requests, you may need CSRF tokens
- Use Laravel's session cookies

### 4. Authentication Errors
- Ensure you're logged in before testing authenticated routes
- Check session cookie validity

### 5. CORS Issues
- Add CORS headers if testing from different domains
- Configure in `config/cors.php`

---

## Testing with Postman Collection

You can also import these endpoints into Postman for easier testing:

1. Create a new Collection called "Bagisto Saffron APIs"
2. Add folders for each API category
3. Import the cURL commands as requests
4. Set up environment variables for base URL and authentication

This comprehensive testing guide should help you verify all your Bagisto APIs are working correctly for mobile development!
