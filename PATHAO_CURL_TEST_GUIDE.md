# Pathao API Curl Test Guide

This guide provides comprehensive curl commands for testing all PathaoService.php API endpoints.

## Table of Contents
1. [Prerequisites](#prerequisites)
2. [Authentication Test](#authentication-test)
3. [Get Location Data](#get-location-data)
4. [Create Order Test](#create-order-test)
5. [Get Order Details](#get-order-details)
6. [Track Order](#track-order)
7. [Complete Test Workflow](#complete-test-workflow)
8. [Expected Responses](#expected-responses)
9. [Troubleshooting](#troubleshooting)

---

## 1. Prerequisites

Before testing the Pathao API, ensure you have the following credentials and information:

### Required Credentials
- **Client ID**: Your Pathao merchant client ID
- **Client Secret**: Your Pathao merchant client secret
- **Username**: Your Pathao merchant account username
- **Password**: Your Pathao merchant account password

### Base URL
```
https://merchant-api.pathao.com
```

### Store Information
- **Store ID**: Your Pathao store ID (e.g., 149442)
- **Delivery Type ID**: The delivery type for your orders (e.g., 48)

### Location IDs Required
- **City ID**: The ID of the recipient's city (e.g., 1 for Dhaka)
- **Zone ID**: The ID of the recipient's zone within the city (e.g., 62)
- **Area ID**: The ID of the recipient's area within the zone (e.g., 5085)

**Note**: You can obtain these location IDs by using the location data endpoints described in section 3.

---

## 2. Authentication Test

### Get Access Token

Obtain an access token by authenticating with your Pathao merchant credentials.

```bash
curl -X POST "https://merchant-api.pathao.com/aladdin/api/v1/issue-token" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "client_id": "YOUR_CLIENT_ID",
    "client_secret": "YOUR_CLIENT_SECRET",
    "username": "YOUR_USERNAME",
    "password": "YOUR_PASSWORD",
    "grant_type": "password"
  }'
```

**Replace the placeholders:**
- `YOUR_CLIENT_ID`: Your actual client ID
- `YOUR_CLIENT_SECRET`: Your actual client secret
- `YOUR_USERNAME`: Your Pathao username
- `YOUR_PASSWORD`: Your Pathao password

**Expected Response:**
The response will contain an `access_token` and `expires_in` value. Save the `access_token` for subsequent API calls.

---

## 3. Get Location Data

### Get Cities List

Retrieve the list of available cities to find the city ID for your delivery location.

```bash
curl -X GET "https://merchant-api.pathao.com/aladdin/api/v1/countries/1/cities" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

**Parameters:**
- `1`: Country ID (1 = Bangladesh)

### Get Zones for a Specific City

Retrieve the zones available within a specific city.

```bash
curl -X GET "https://merchant-api.pathao.com/aladdin/api/v1/cities/CITY_ID/zones" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

**Replace:**
- `CITY_ID`: The ID of the city (e.g., 1 for Dhaka)

### Get Areas for a Specific Zone

Retrieve the areas available within a specific zone.

```bash
curl -X GET "https://merchant-api.pathao.com/aladdin/api/v1/zones/ZONE_ID/areas" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

**Replace:**
- `ZONE_ID`: The ID of the zone (e.g., 62)

---

## 4. Create Order Test

### Create a New Order

Create a new delivery order with all required fields.

```bash
curl -X POST "https://merchant-api.pathao.com/aladdin/api/v1/orders" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -d '{
    "store_id": 149442,
    "recipient_name": "Test Customer",
    "recipient_phone": "01712345678",
    "recipient_address": "House 12, Road 5, Dhanmondi 1, Dhaka",
    "recipient_city": 1,
    "recipient_zone": 62,
    "recipient_area": 5085,
    "delivery_type": 48,
    "item_type": "parcel",
    "item_weight": 0.5,
    "item_quantity": 1,
    "item_description": "Test package",
    "amount_to_collect": 1500
  }'
```

**Request Parameters:**

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `store_id` | integer | Yes | Your Pathao store ID |
| `recipient_name` | string | Yes | Name of the recipient |
| `recipient_phone` | string | Yes | Phone number of the recipient |
| `recipient_address` | string | Yes | Full delivery address |
| `recipient_city` | integer | Yes | City ID (from cities endpoint) |
| `recipient_zone` | integer | Yes | Zone ID (from zones endpoint) |
| `recipient_area` | integer | Yes | Area ID (from areas endpoint) |
| `delivery_type` | integer | Yes | Delivery type ID |
| `item_type` | string | Yes | Type of item (e.g., "parcel") |
| `item_weight` | decimal | Yes | Weight in kg |
| `item_quantity` | integer | Yes | Number of items |
| `item_description` | string | Yes | Description of items |
| `amount_to_collect` | decimal | Yes | COD amount to collect |

**Replace the placeholders:**
- `YOUR_ACCESS_TOKEN`: Your valid access token from authentication
- Update all other values with your actual order details

**Important:** Save the `consignment_id` from the response for tracking and retrieving order details.

---

## 5. Get Order Details

### Retrieve Order Information

Get detailed information about a specific order using its consignment ID.

```bash
curl -X GET "https://merchant-api.pathao.com/aladdin/api/v1/orders/DT311225D2DW5U/info" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

**Replace:**
- `DT311225D2DW5U`: The actual consignment ID from your order
- `YOUR_ACCESS_TOKEN`: Your valid access token

---

## 6. Track Order

### Track Order Status

Track the current status and location of an order.

```bash
curl -X GET "https://merchant-api.pathao.com/aladdin/api/v1/orders/DT311225D2DW5U/track" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

**Replace:**
- `DT311225D2DW5U`: The actual consignment ID from your order
- `YOUR_ACCESS_TOKEN`: Your valid access token

---

## 7. Complete Test Workflow

Follow this complete sequence of commands to test the entire Pathao API workflow:

### Step 1: Get Access Token
```bash
curl -X POST "https://merchant-api.pathao.com/aladdin/api/v1/issue-token" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "client_id": "YOUR_CLIENT_ID",
    "client_secret": "YOUR_CLIENT_SECRET",
    "username": "YOUR_USERNAME",
    "password": "YOUR_PASSWORD",
    "grant_type": "password"
  }'
```

**Extract the `access_token` from the response.**

### Step 2: Get Cities (to find city ID)
```bash
curl -X GET "https://merchant-api.pathao.com/aladdin/api/v1/countries/1/cities" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

**Extract the desired city ID from the response.**

### Step 3: Get Zones (to find zone ID)
```bash
curl -X GET "https://merchant-api.pathao.com/aladdin/api/v1/cities/CITY_ID/zones" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

**Replace `CITY_ID` with the ID from Step 2. Extract the desired zone ID.**

### Step 4: Get Areas (to find area ID)
```bash
curl -X GET "https://merchant-api.pathao.com/aladdin/api/v1/zones/ZONE_ID/areas" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

**Replace `ZONE_ID` with the ID from Step 3. Extract the desired area ID.**

### Step 5: Create Order
```bash
curl -X POST "https://merchant-api.pathao.com/aladdin/api/v1/orders" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" \
  -d '{
    "store_id": 149442,
    "recipient_name": "Test Customer",
    "recipient_phone": "01712345678",
    "recipient_address": "House 12, Road 5, Dhanmondi 1, Dhaka",
    "recipient_city": CITY_ID,
    "recipient_zone": ZONE_ID,
    "recipient_area": AREA_ID,
    "delivery_type": 48,
    "item_type": "parcel",
    "item_weight": 0.5,
    "item_quantity": 1,
    "item_description": "Test package",
    "amount_to_collect": 1500
  }'
```

**Replace `CITY_ID`, `ZONE_ID`, and `AREA_ID` with the IDs from Steps 2-4. Extract the `consignment_id` from the response.**

### Step 6: Get Order Details
```bash
curl -X GET "https://merchant-api.pathao.com/aladdin/api/v1/orders/CONSIGNMENT_ID/info" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

**Replace `CONSIGNMENT_ID` with the ID from Step 5.**

### Step 7: Track Order
```bash
curl -X GET "https://merchant-api.pathao.com/aladdin/api/v1/orders/CONSIGNMENT_ID/track" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN"
```

**Replace `CONSIGNMENT_ID` with the ID from Step 5.**

---

## 8. Expected Responses

### Authentication Response (Success)
```json
{
  "success": true,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "token_type": "Bearer",
  "expires_in": 3600
}
```

### Cities List Response
```json
{
  "success": true,
  "data": [
    {
      "city_id": 1,
      "city_name": "Dhaka"
    },
    {
      "city_id": 2,
      "city_name": "Chittagong"
    }
  ]
}
```

### Zones List Response
```json
{
  "success": true,
  "data": [
    {
      "zone_id": 62,
      "zone_name": "Dhanmondi"
    },
    {
      "zone_id": 63,
      "zone_name": "Gulshan"
    }
  ]
}
```

### Areas List Response
```json
{
  "success": true,
  "data": [
    {
      "area_id": 5085,
      "area_name": "Dhanmondi 1"
    },
    {
      "area_id": 5086,
      "area_name": "Dhanmondi 2"
    }
  ]
}
```

### Create Order Response (Success)
```json
{
  "success": true,
  "data": {
    "consignment_id": "DT311225D2DW5U",
    "order_id": 123456,
    "status": "pending",
    "created_at": "2024-12-31T04:28:21Z"
  }
}
```

### Order Details Response
```json
{
  "success": true,
  "data": {
    "consignment_id": "DT311225D2DW5U",
    "recipient_name": "Test Customer",
    "recipient_phone": "01712345678",
    "recipient_address": "House 12, Road 5, Dhanmondi 1, Dhaka",
    "status": "pending",
    "delivery_type": "48",
    "amount_to_collect": 1500,
    "created_at": "2024-12-31T04:28:21Z"
  }
}
```

### Track Order Response
```json
{
  "success": true,
  "data": {
    "consignment_id": "DT311225D2DW5U",
    "current_status": "in_transit",
    "tracking_history": [
      {
        "status": "pending",
        "timestamp": "2024-12-31T04:28:21Z",
        "location": "Dhaka"
      },
      {
        "status": "picked_up",
        "timestamp": "2024-12-31T05:00:00Z",
        "location": "Dhanmondi"
      }
    ]
  }
}
```

---

## 9. Troubleshooting

### Common Errors and Solutions

#### 1. Authentication Errors

**Error:**
```json
{
  "success": false,
  "message": "Invalid credentials"
}
```

**Solutions:**
- Verify your `client_id` and `client_secret` are correct
- Check that `username` and `password` are accurate
- Ensure your merchant account is active
- Confirm you're using the correct environment (sandbox vs production)

#### 2. Token Expired

**Error:**
```json
{
  "success": false,
  "message": "Token expired or invalid"
}
```

**Solutions:**
- Re-authenticate to get a new access token
- Check the `expires_in` value from the authentication response
- Store the token and refresh it before expiration
- Default token expiration is typically 3600 seconds (1 hour)

#### 3. Invalid Location IDs

**Error:**
```json
{
  "success": false,
  "message": "Invalid city ID"
}
```

**Solutions:**
- Use the location data endpoints to get valid IDs
- Verify the city, zone, and area IDs are from the same geographic region
- Ensure the zone belongs to the specified city
- Ensure the area belongs to the specified zone

#### 4. Missing Required Fields

**Error:**
```json
{
  "success": false,
  "message": "Required field missing: recipient_name"
}
```

**Solutions:**
- Review the required fields in the create order endpoint
- Ensure all required parameters are included in the request body
- Check for typos in field names
- Verify data types match the expected format

#### 5. Invalid Phone Number

**Error:**
```json
{
  "success": false,
  "message": "Invalid phone number format"
}
```

**Solutions:**
- Use the correct format for Bangladesh phone numbers (e.g., 01712345678)
- Ensure the phone number starts with 01
- Remove any spaces or special characters
- Verify the number is 11 digits long

#### 6. Store ID Not Found

**Error:**
```json
{
  "success": false,
  "message": "Store not found"
}
```

**Solutions:**
- Verify your store ID is correct
- Ensure your store is active in the Pathao system
- Contact Pathao support if your store is not accessible

#### 7. Delivery Type Invalid

**Error:**
```json
{
  "success": false,
  "message": "Invalid delivery type"
}
```

**Solutions:**
- Verify the delivery type ID is valid for your store
- Check if the delivery type is available for the selected location
- Contact Pathao support to get the correct delivery type IDs

#### 8. Network/Connection Issues

**Error:**
```bash
curl: (6) Could not resolve host: merchant-api.pathao.com
```

**Solutions:**
- Check your internet connection
- Verify the base URL is correct
- Try using a different network
- Check if there are any firewall restrictions

#### 9. Rate Limiting

**Error:**
```json
{
  "success": false,
  "message": "Rate limit exceeded"
}
```

**Solutions:**
- Wait before making additional requests
- Implement request throttling in your application
- Contact Pathao support to increase your rate limit

#### 10. CORS Errors (Browser-based requests)

**Error:**
```
Access to XMLHttpRequest at 'https://merchant-api.pathao.com/...' from origin '...' has been blocked by CORS policy
```

**Solutions:**
- Pathao API may not support direct browser requests
- Use a backend proxy to make API calls
- Use curl or a server-side solution instead

### Best Practices

1. **Always validate responses**: Check the `success` field in all responses
2. **Handle errors gracefully**: Implement proper error handling in your application
3. **Store tokens securely**: Never hardcode credentials in your code
4. **Refresh tokens proactively**: Get new tokens before they expire
5. **Log API calls**: Keep track of API requests for debugging
6. **Use environment variables**: Store credentials in environment variables
7. **Test in sandbox first**: Use the sandbox environment for testing
8. **Monitor rate limits**: Track your API usage to avoid hitting limits
9. **Validate input data**: Ensure all data is properly formatted before sending
10. **Keep documentation updated**: Refer to the latest Pathao API documentation

### Testing Tips

1. **Use a test store**: Create a separate test store for development
2. **Start with small orders**: Test with low-value orders first
3. **Verify each step**: Confirm each step works before proceeding
4. **Save successful responses**: Keep examples of successful API calls
5. **Use verbose mode**: Add `-v` flag to curl for detailed output
6. **Format JSON responses**: Use `| jq` to format JSON output (if jq is installed)

Example with formatting:
```bash
curl -X GET "https://merchant-api.pathao.com/aladdin/api/v1/countries/1/cities" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_ACCESS_TOKEN" | jq
```

---

## Additional Resources

- [Pathao Official Documentation](https://merchant.pathao.com/)
- [PathaoService.php](app/Services/PathaoService.php) - Laravel service implementation
- [PATHAO_API_DOCUMENTATION.md](PATHAO_API_DOCUMENTATION.md) - Additional API documentation
- [PATHAO_INTEGRATION_TEST_REPORT.md](PATHAO_INTEGRATION_TEST_REPORT.md) - Integration test results

---

## Support

For issues related to:
- **API functionality**: Contact Pathao merchant support
- **Integration code**: Refer to PathaoService.php implementation
- **Authentication**: Verify your merchant account credentials

---

**Last Updated:** December 31, 2024
**Version:** 1.0
