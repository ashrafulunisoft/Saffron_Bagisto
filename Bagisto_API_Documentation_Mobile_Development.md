# Bagisto API Documentation for Mobile Development

## Overview
This document provides comprehensive API documentation for your Bagisto Saffron project, specifically tailored for mobile app development.

## Base URL
```
Production: https://yourdomain.com/api/
Development: http://yourdomain.test/api/
```

## Authentication
- Customer authentication uses Laravel session-based auth
- API calls requiring authentication need session cookies
- For mobile apps, consider implementing API token-based auth

## Request Headers
```
Content-Type: application/json
Accept: application/json
```

---

## API Endpoints

### 1. Core APIs

#### Get Countries
```http
GET /api/core/countries
```
**Description:** Retrieve all available countries
**Parameters:** None
**Response:** Array of country objects with id, name, code

#### Get States
```http
GET /api/core/states
```
**Description:** Retrieve states for a specific country
**Parameters:** 
- `country_id` (required): Country ID to get states for
**Response:** Array of state objects

### 2. Category APIs

#### Get Categories
```http
GET /api/categories
```
**Description:** Get all categories with pagination support
**Parameters:**
- `page` (optional): Page number for pagination
- `limit` (optional): Number of items per page
**Response:** Paginated array of category objects

#### Get Category Tree
```http
GET /api/categories/tree
```
**Description:** Get hierarchical category tree structure
**Parameters:** None
**Response:** Tree structure of categories

#### Get Category Attributes
```http
GET /api/categories/attributes
```
**Description:** Get all attributes for categories
**Parameters:** None
**Response:** Array of attribute objects

#### Get Attribute Options
```http
GET /api/categories/attributes/{attribute_id}/options
```
**Description:** Get options for a specific attribute
**Parameters:**
- `attribute_id` (required): ID of the attribute
**Response:** Array of attribute options

#### Get Max Price
```http
GET /api/categories/max-price/{id?}
```
**Description:** Get maximum product price in a category
**Parameters:**
- `id` (optional): Category ID, if not provided returns overall max price
**Response:** Maximum price value

### 3. Product APIs

#### Get Products
```http
GET /api/products
```
**Description:** Get all products with filtering and pagination
**Parameters:**
- `category_id` (optional): Filter by category
- `search` (optional): Search term
- `sort` (optional): Sort field (price, name, created_at)
- `order` (optional): Sort order (asc, desc)
- `page` (optional): Page number
- `limit` (optional): Items per page
**Response:** Paginated array of product objects

#### Get Related Products
```http
GET /api/products/{id}/related
```
**Description:** Get products related to a specific product
**Parameters:**
- `id` (required): Product ID
**Response:** Array of related product objects

#### Get Upsell Products
```http
GET /api/products/{id}/up-sell
```
**Description:** Get upsell products for a specific product
**Parameters:**
- `id` (required): Product ID
**Response:** Array of upsell product objects

### 4. Review APIs

#### Get Product Reviews
```http
GET /api/product/{id}/reviews
```
**Description:** Get reviews for a specific product
**Parameters:**
- `id` (required): Product ID
- `page` (optional): Page number
- `limit` (optional): Reviews per page
**Response:** Paginated array of review objects

#### Create Review
```http
POST /api/product/{id}/review
```
**Description:** Create a new review for a product
**Parameters:**
- `id` (required): Product ID
- `rating` (required): Rating value (1-5)
- `title` (required): Review title
- `comment` (required): Review comment
**Response:** Created review object

#### Translate Review
```http
GET /api/product/{id}/reviews/{review_id}/translate
```
**Description:** Get translated review
**Parameters:**
- `id` (required): Product ID
- `review_id` (required): Review ID
- `locale` (optional): Target language code
**Response:** Translated review object

### 5. Compare APIs

#### Get Compare List
```http
GET /api/compare-items
```
**Description:** Get user's compare list
**Parameters:** None
**Response:** Array of compare items

#### Add to Compare
```http
POST /api/compare-items
```
**Description:** Add product to compare list
**Parameters:**
- `product_id` (required): Product ID to add
**Response:** Success message

#### Remove from Compare
```http
DELETE /api/compare-items
```
**Description:** Remove specific product from compare
**Parameters:**
- `product_id` (required): Product ID to remove
**Response:** Success message

#### Clear Compare List
```http
DELETE /api/compare-items/all
```
**Description:** Clear all items from compare list
**Parameters:** None
**Response:** Success message

### 6. Cart APIs

#### Get Cart
```http
GET /api/checkout/cart
```
**Description:** Get user's shopping cart
**Parameters:** None
**Response:** Cart object with items, totals, and shipping info

#### Add to Cart
```http
POST /api/checkout/cart
```
**Description:** Add product to shopping cart
**Parameters:**
- `product_id` (required): Product ID
- `quantity` (required): Quantity to add
- `selected_configurable_option` (optional): For configurable products
- `attributes` (optional): Product attributes
**Response:** Updated cart object

#### Update Cart Item
```http
PUT /api/checkout/cart
```
**Description:** Update quantity of cart item
**Parameters:**
- `cart_item_id` (required): Cart item ID
- `quantity` (required): New quantity
**Response:** Updated cart object

#### Remove from Cart
```http
DELETE /api/checkout/cart
```
**Description:** Remove specific item from cart
**Parameters:**
- `cart_item_id` (required): Cart item ID to remove
**Response:** Updated cart object

#### Remove Selected Items
```http
DELETE /api/checkout/cart/selected
```
**Description:** Remove multiple selected items from cart
**Parameters:**
- `cart_items` (required): Array of cart item IDs
**Response:** Updated cart object

#### Move to Wishlist
```http
POST /api/checkout/cart/move-to-wishlist
```
**Description:** Move cart item to wishlist
**Parameters:**
- `cart_item_id` (required): Cart item ID
**Response:** Success message

#### Apply Coupon
```http
POST /api/checkout/cart/coupon
```
**Description:** Apply coupon code to cart
**Parameters:**
- `code` (required): Coupon code
**Response:** Updated cart with discount applied

#### Estimate Shipping
```http
POST /api/checkout/cart/estimate-shipping-methods
```
**Description:** Get available shipping methods
**Parameters:**
- `country` (required): Country code
- `state` (optional): State/province
- `postcode` (optional): Postal code
**Response:** Array of available shipping methods

#### Remove Coupon
```http
DELETE /api/checkout/cart/coupon
```
**Description:** Remove applied coupon
**Parameters:** None
**Response:** Updated cart without discount

#### Get Cross-sell Products
```http
GET /api/checkout/cart/cross-sell
```
**Description:** Get cross-sell products for cart
**Parameters:** None
**Response:** Array of cross-sell product objects

### 7. Checkout APIs

#### Get Checkout Summary
```http
GET /api/checkout/onepage/summary
```
**Description:** Get current checkout summary
**Parameters:** None
**Response:** Checkout summary object

#### Store Address
```http
POST /api/checkout/onepage/addresses
```
**Description:** Store billing and shipping addresses
**Parameters:**
- `billing` (required): Billing address object
- `shipping` (required): Shipping address object
- `shipping_as_billing` (optional): Boolean
**Response:** Success message

#### Store Shipping Method
```http
POST /api/checkout/onepage/shipping-methods
```
**Description:** Store selected shipping method
**Parameters:**
- `shipping_method` (required): Selected shipping method code
**Response:** Success message

#### Store Payment Method
```http
POST /api/checkout/onepage/payment-methods
```
**Description:** Store selected payment method
**Parameters:**
- `payment_method` (required): Selected payment method code
**Response:** Success message

#### Create Order
```http
POST /api/checkout/onepage/orders
```
**Description:** Create new order
**Parameters:**
- `payment` (required): Payment details object
**Response:** Order object with order ID and payment details

### 8. Customer APIs

#### Customer Login
```http
POST /api/customer/login
```
**Description:** Authenticate customer
**Parameters:**
- `email` (required): Customer email
- `password` (required): Customer password
**Response:** Authentication token/session data

### 9. Customer Account APIs (Authentication Required)

#### Get Addresses
```http
GET /api/customer/addresses
```
**Description:** Get customer's saved addresses
**Parameters:** None
**Response:** Array of address objects

#### Create Address
```http
POST /api/customer/addresses
```
**Description:** Create new customer address
**Parameters:**
- `first_name` (required): First name
- `last_name` (required): Last name
- `address1` (required): Address line 1
- `address2` (optional): Address line 2
- `city` (required): City
- `state` (required): State
- `postcode` (required): Postal code
- `country` (required): Country code
- `phone` (optional): Phone number
**Response:** Created address object

#### Update Address
```http
PUT /api/customer/addresses/edit/{id}
```
**Description:** Update existing customer address
**Parameters:**
- `id` (required): Address ID
- All address fields (same as create)
**Response:** Updated address object

#### Get Wishlist
```http
GET /api/customer/wishlist
```
**Description:** Get customer's wishlist
**Parameters:** None
**Response:** Array of wishlist items

#### Add to Wishlist
```http
POST /api/customer/wishlist
```
**Description:** Add product to wishlist
**Parameters:**
- `product_id` (required): Product ID
**Response:** Success message

#### Move to Cart
```http
POST /api/customer/wishlist/{id}/move-to-cart
```
**Description:** Move wishlist item to cart
**Parameters:**
- `id` (required): Wishlist item ID
**Response:** Success message

#### Clear Wishlist
```http
DELETE /api/customer/wishlist/all
```
**Description:** Clear all wishlist items
**Parameters:** None
**Response:** Success message

#### Remove from Wishlist
```http
DELETE /api/customer/wishlist/{id}
```
**Description:** Remove specific item from wishlist
**Parameters:**
- `id` (required): Wishlist item ID
**Response:** Success message

---

## Mobile Development Guidelines

### Authentication for Mobile Apps
1. **Session-based Authentication:** Current implementation uses Laravel sessions
2. **API Token Authentication:** Consider implementing Laravel Sanctum for mobile apps
3. **Token Storage:** Store tokens securely on mobile device (Keychain/Keystore)

### Performance Optimization
1. **Caching:** Implement Redis/Memcached for frequently accessed data
2. **Image Optimization:** Compress and optimize product images
3. **Pagination:** Always use pagination for list endpoints
4. **Lazy Loading:** Implement infinite scroll for product lists

### Error Handling
```json
{
  "error": true,
  "message": "Error description",
  "errors": {
    "field_name": ["Validation error message"]
  }
}
```

### Rate Limiting
- Implement client-side rate limiting
- Handle 429 (Too Many Requests) responses
- Add retry logic with exponential backoff

### Recommended Mobile Tech Stack
- **Frontend:** React Native or Flutter
- **Authentication:** Laravel Sanctum
- **State Management:** Redux (React Native) or Bloc (Flutter)
- **Networking:** Axios (React Native) or Dio (Flutter)
- **Push Notifications:** Firebase Cloud Messaging

### Security Considerations
1. **HTTPS Only:** Always use HTTPS in production
2. **Input Validation:** Validate all inputs on both client and server
3. **API Keys:** Securely store any API keys
4. **Data Encryption:** Encrypt sensitive data in transit and at rest

---

## Admin Panel Customization Locations

### Main Admin Layout
```
packages/Webkul/Admin/src/Resources/views/components/layouts/index.blade.php
```

### Header Component (Logo & Branding)
```
packages/Webkul/Admin/src/Resources/views/components/layouts/header/index.blade.php
```
**Key Sections:**
- Lines 16-30: Main header logo
- Lines 151-165: Sidebar drawer logo
- Current size: `h-12 w-auto sm:h-14`

### Sidebar Component
```
packages/Webkul/Admin/src/Resources/views/components/layouts/sidebar/index.blade.php
```

### Footer Component
```
packages/Webkul/Admin/src/Resources/views/components/layouts/footer/index.blade.php
```

### Anonymous Layout (Login Page)
```
packages/Webkul/Admin/src/Resources/views/components/layouts/anonymous.blade.php
```

### CSS Assets
```
public/themes/admin/default/build/assets/
```

### Translation Files
```
packages/Webkul/Admin/src/Resources/lang/{locale}/app.php
```

---

## Support and Resources

### Documentation Links
- [Bagisto Official Documentation](https://docs.bagisto.com/)
- [Laravel API Resources](https://laravel.com/docs/master/routing#api-resource-routes)
- [Mobile Development Best Practices](https://developer.android.com/guide/topics/connectivity)

### Testing APIs
- Use tools like Postman or Insomnia for API testing
- Test all endpoints with different scenarios
- Validate error handling and edge cases

This documentation should serve as a comprehensive guide for developing your mobile application with the Bagisto Saffron backend.
