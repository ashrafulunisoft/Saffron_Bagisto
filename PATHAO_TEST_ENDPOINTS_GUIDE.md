# Pathao Test Endpoints Guide

This guide provides curl commands to test the new PathaoService functions that have been exposed via API endpoints.

## Overview

Two new test endpoints have been added to test PathaoService functions:

1. **testExtractLocation** - Tests [`extractLocationFromOrderDetails()`](app/Services/PathaoService.php) function
2. **testGetGeoCoordinates** - Tests [`getGeoCoordinatesByLocation()`](app/Services/PathaoService.php) function

## Prerequisites

- Laravel application must be running on port 8000 (`php artisan serve`)
- These test endpoints are publicly accessible (no authentication required)
- Base URL: `http://127.0.0.1:8000`

## Complete Testing Workflow

Follow this workflow to test the complete process:

### Step 1: Test Extract Location from Order Details

Extract city_id, zone_id, and area_id from order details.

```bash
curl -X POST "http://127.0.0.1:8000/api/pathao/test/extract-location" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "order_details": {
      "recipient_city": 1,
      "recipient_zone": 62,
      "recipient_area": 5085,
      "recipient_address": "House 12, Road 5, Dhanmondi 1, Dhaka",
      "recipient_name": "Test Customer",
      "recipient_phone": "01712345678"
    }
  }'
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Location extracted successfully",
  "data": {
    "success": true,
    "data": {
      "city_id": 1,
      "zone_id": 62,
      "area_id": 5085
    },
    "message": "Location extracted successfully"
  }
}
```

### Step 2: Test Get Geo Coordinates by Location

Use the extracted location IDs (city_id, zone_id, area_id) to get latitude and longitude.

```bash
curl -X POST "http://127.0.0.1:8000/api/pathao/test/get-geo-coordinates" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "city_id": 1,
    "zone_id": 62,
    "area_id": 5085
  }'
```

**Expected Response:**
```json
{
  "success": true,
  "message": "Geo coordinates retrieved successfully",
  "data": {
    "success": true,
    "data": {
      "latitude": null,
      "longitude": null,
      "city_name": null,
      "zone_name": null,
      "area_name": null
    },
    "message": "Geo coordinates not available for this location"
  }
}
```

**Note:** If geo coordinates are not available for the specific location, the service returns null values. This is expected behavior.

## Test Endpoints Details

### 1. Test Extract Location from Order Details

**Endpoint:** `POST /api/pathao/test/extract-location`

**Description:** Extracts city_id, zone_id, and area_id from order details.

**Request Body:**
- `order_details` (required, array) - The order details array containing location information

#### Example 1: With recipient_* structure

```bash
curl -X POST "http://127.0.0.1:8000/api/pathao/test/extract-location" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "order_details": {
      "recipient_city": 1,
      "recipient_zone": 62,
      "recipient_area": 5085,
      "recipient_address": "House 12, Road 5, Dhanmondi 1, Dhaka",
      "recipient_name": "Test Customer",
      "recipient_phone": "01712345678"
    }
  }'
```

#### Example 2: With shipping_address structure

```bash
curl -X POST "http://127.0.0.1:8000/api/pathao/test/extract-location" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "order_details": {
      "shipping_address": {
        "city_id": 1,
        "zone_id": 62,
        "area_id": 5085,
        "address": "123 Main Street",
        "city": "Dhaka",
        "zone": "Dhanmondi",
        "area": "Dhanmondi 1"
      }
    }
  }'
```

#### Example 3: With flat structure

```bash
curl -X POST "http://127.0.0.1:8000/api/pathao/test/extract-location" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "order_details": {
      "city_id": 2,
      "zone_id": 101,
      "area_id": 2001
    }
  }'
```

#### Success Response (200):

```json
{
  "success": true,
  "message": "Location extracted successfully",
  "data": {
    "success": true,
    "data": {
      "city_id": 1,
      "zone_id": 62,
      "area_id": 5085
    },
    "message": "Location extracted successfully"
  }
}
```

#### Validation Error Response (422):

```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "order_details": ["The order_details field is required."]
  }
}
```

---

### 2. Test Get Geo Coordinates by Location

**Endpoint:** `POST /api/pathao/test/get-geo-coordinates`

**Description:** Gets latitude and longitude coordinates for a specific location defined by city_id, zone_id, and area_id.

**Request Body:**
- `city_id` (required, integer) - The city ID
- `zone_id` (required, integer) - The zone ID
- `area_id` (required, integer) - The area ID

#### Example 1: Dhaka Dhanmondi

```bash
curl -X POST "http://127.0.0.1:8000/api/pathao/test/get-geo-coordinates" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "city_id": 1,
    "zone_id": 62,
    "area_id": 5085
  }'
```

#### Example 2: Different location

```bash
curl -X POST "http://127.0.0.1:8000/api/pathao/test/get-geo-coordinates" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "city_id": 2,
    "zone_id": 201,
    "area_id": 2001
  }'
```

#### Success Response with Coordinates (200):

```json
{
  "success": true,
  "message": "Geo coordinates retrieved successfully",
  "data": {
    "success": true,
    "data": {
      "latitude": 23.8103,
      "longitude": 90.4125,
      "city_name": "Dhaka",
      "zone_name": "Dhanmondi",
      "area_name": "Dhanmondi 1"
    },
    "message": "Geo coordinates retrieved successfully"
  }
}
```

#### Success Response without Coordinates (200):

```json
{
  "success": true,
  "message": "Geo coordinates retrieved successfully",
  "data": {
    "success": true,
    "data": {
      "latitude": null,
      "longitude": null,
      "city_name": null,
      "zone_name": null,
      "area_name": null
    },
    "message": "Geo coordinates not available for this location"
  }
}
```

**Note:** This response is expected when geo coordinates are not available for the specific location.

#### Validation Error Response (422):

```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "city_id": ["The city_id field is required."],
    "zone_id": ["The zone_id field is required."],
    "area_id": ["The area_id field is required."]
  }
}
```

---

## Quick Reference

### Extract Location Endpoint

| Attribute | Value |
|-----------|-------|
| **Method** | POST |
| **URL** | `/api/pathao/test/extract-location` |
| **Auth Required** | No (publicly accessible) |
| **Content-Type** | `application/json` |
| **Required Field** | `order_details` (array) |

### Get Geo Coordinates Endpoint

| Attribute | Value |
|-----------|-------|
| **Method** | POST |
| **URL** | `/api/pathao/test/get-geo-coordinates` |
| **Auth Required** | No (publicly accessible) |
| **Content-Type** | `application/json` |
| **Required Fields** | `city_id`, `zone_id`, `area_id` (all integers) |

---

## Testing with Different Data Structures

The `extractLocationFromOrderDetails` function is designed to handle multiple order detail structures. Here are examples of different structures you can test:

### Structure 1: Nested shipping_address

```json
{
  "order_details": {
    "shipping_address": {
      "city_id": 1,
      "zone_id": 62,
      "area_id": 5085
    }
  }
}
```

### Structure 2: Recipient fields

```json
{
  "order_details": {
    "recipient_city": 1,
    "recipient_zone": 62,
    "recipient_area": 5085
  }
}
```

### Structure 3: Flat structure

```json
{
  "order_details": {
    "city_id": 1,
    "zone_id": 62,
    "area_id": 5085
  }
}
```

### Structure 4: Mixed (with additional fields)

```json
{
  "order_details": {
    "shipping_address": {
      "city_id": 1,
      "zone_id": 62,
      "area_id": 5085,
      "address": "123 Main Street"
    },
    "recipient_name": "John Doe",
    "recipient_phone": "01712345678"
  }
}
```

---

## Complete Workflow Example

Here's a complete example showing the workflow from order details to geo coordinates:

### Step 1: Extract location from order

```bash
curl -X POST "http://127.0.0.1:8000/api/pathao/test/extract-location" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "order_details": {
      "recipient_city": 1,
      "recipient_zone": 62,
      "recipient_area": 5085,
      "recipient_address": "House 12, Road 5, Dhanmondi 1, Dhaka"
    }
  }' | python -m json.tool
```

**Output:**
```json
{
  "success": true,
  "message": "Location extracted successfully",
  "data": {
    "success": true,
    "data": {
      "city_id": 1,
      "zone_id": 62,
      "area_id": 5085
    },
    "message": "Location extracted successfully"
  }
}
```

### Step 2: Get geo coordinates using extracted IDs

```bash
curl -X POST "http://127.0.0.1:8000/api/pathao/test/get-geo-coordinates" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "city_id": 1,
    "zone_id": 62,
    "area_id": 5085
  }' | python -m json.tool
```

**Output:**
```json
{
  "success": true,
  "message": "Geo coordinates retrieved successfully",
  "data": {
    "success": true,
    "data": {
      "latitude": null,
      "longitude": null,
      "city_name": null,
      "zone_name": null,
      "area_name": null
    },
    "message": "Geo coordinates not available for this location"
  }
}
```

---

## Troubleshooting

### Common Issues

#### 1. Connection Refused

**Error:**
```bash
curl: (7) Failed to connect to 127.0.0.1 port 8000: Connection refused
```

**Solutions:**
- Ensure Laravel server is running: `php artisan serve`
- Check that port is correct (default is 8000)
- Try using `localhost` instead of `127.0.0.1` or vice versa

#### 2. 422 Validation Error

**Error:**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "order_details": ["The order_details field is required."]
  }
}
```

**Solutions:**
- Ensure all required fields are present in request body
- Check that `order_details` is sent as an array/object, not a string
- Verify data types are correct (integers for IDs, array for order_details)
- Check for typos in field names

#### 3. 500 Internal Server Error

**Error:**
```json
{
  "success": false,
  "message": "Failed to extract location from order details",
  "errors": {
    "exception": "Error message here"
  }
}
```

**Solutions:**
- Check the error message in the response for details
- Verify that PathaoService functions are working correctly
- Check Laravel logs for more details: `storage/logs/laravel.log`
- Ensure Pathao API credentials are configured correctly in `.env`

### Debug Mode

For debugging, you can enable verbose output in curl:

```bash
curl -v -X POST "http://127.0.0.1:8000/api/pathao/test/extract-location" \
  -H "Content-Type: application/json" \
  -d '{"order_details": {"city_id": 1, "zone_id": 62, "area_id": 5085}}'
```

### Pretty Print JSON Responses

Use Python to format JSON output:

```bash
curl -X POST "http://127.0.0.1:8000/api/pathao/test/extract-location" \
  -H "Content-Type: application/json" \
  -d '{"order_details": {"city_id": 1, "zone_id": 62, "area_id": 5085}}' | python -m json.tool
```

---

## Quick Test Script

Save this as `test-pathao-endpoints.sh` and make it executable (`chmod +x test-pathao-endpoints.sh`):

```bash
#!/bin/bash

# Configuration
BASE_URL="http://127.0.0.1:8000"

echo "Testing Pathao Test Endpoints..."
echo ""

# Test 1: Extract Location
echo "Test 1: Extract Location from Order Details"
echo "=========================================="
curl -X POST "${BASE_URL}/api/pathao/test/extract-location" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "order_details": {
      "recipient_city": 1,
      "recipient_zone": 62,
      "recipient_area": 5085,
      "recipient_address": "House 12, Road 5, Dhanmondi 1, Dhaka"
    }
  }' | python -m json.tool

echo ""
echo ""

# Test 2: Get Geo Coordinates
echo "Test 2: Get Geo Coordinates by Location"
echo "========================================"
curl -X POST "${BASE_URL}/api/pathao/test/get-geo-coordinates" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "city_id": 1,
    "zone_id": 62,
    "area_id": 5085
  }' | python -m json.tool

echo ""
echo "Tests completed!"
```

Run the script:
```bash
chmod +x test-pathao-endpoints.sh
./test-pathao-endpoints.sh
```

---

## Additional Resources

- [`PathaoService.php`](app/Services/PathaoService.php) - Service implementation
- [`PathaoController.php`](app/Http/Controllers/PathaoController.php) - Controller methods
- [`routes/api.php`](routes/api.php) - Route definitions
- [`PATHAO_API_DOCUMENTATION.md`](PATHAO_API_DOCUMENTATION.md) - Full Pathao API documentation
- [`PATHAO_CURL_TEST_GUIDE.md`](PATHAO_CURL_TEST_GUIDE.md) - General curl testing guide

---

## Notes

- These test endpoints are publicly accessible (no authentication required)
- The endpoints follow the same error handling patterns as other Pathao endpoints
- Error logging is enabled for debugging purposes
- The `extractLocationFromOrderDetails` function is flexible and handles multiple order detail structures
- The `getGeoCoordinatesByLocation` function requires valid city_id, zone_id, and area_id
- Geo coordinates may return null if not available for the specific location
- All responses include a `success` boolean field indicating operation status

---

**Last Updated:** December 31, 2024
**Version:** 1.0
