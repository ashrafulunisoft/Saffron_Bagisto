# PHASE 3 COMPREHENSIVE IMPLEMENTATION GUIDE
## Database Design and Implementation (January 2-15, 2026)

---

### 1. INTRODUCTION TO PHASE 3

Phase 3 of the Saffron Sweets and Bakeries E-Commerce Platform implementation focuses on establishing a robust, scalable, and efficient database foundation. This critical phase forms the backbone of all subsequent development, ensuring data integrity, performance, and support for Bangladesh-specific requirements including multilingual content and local payment methods.

The database design will accommodate the full spectrum of e-commerce operations while maintaining flexibility for future growth and feature enhancements. Particular attention is given to optimizing for mobile network conditions common in Bangladesh and ensuring efficient data retrieval for high-traffic scenarios.

**Timeline:** January 2-15, 2026 (2 Weeks)  
**Primary Focus:** Database schema design, implementation, and optimization  
**Developer Workload:** Full-time solo development (40 hours/week)  

---

### 2. OVERVIEW OF PHASE 3 OBJECTIVES AND SCOPE

#### Primary Objectives
- Design and implement a comprehensive database schema supporting all e-commerce operations
- Establish data relationships ensuring referential integrity and optimal query performance
- Create multilingual content support for Bengali and English languages
- Implement efficient indexing strategies for mobile network optimization
- Design scalable architecture supporting business growth and increased transaction volumes

#### Scope of Implementation
- User management and authentication data structures
- Product catalog with multilingual support and variant management
- Order processing and transaction tracking systems
- Payment integration schema supporting multiple Bangladeshi payment methods
- Review and rating systems with moderation capabilities
- Content management system for multilingual content
- Notification system with queue management
- Analytics and reporting data structures
- Performance optimization and query tuning
- Comprehensive testing and validation procedures

#### Exclusions
- Implementation of business logic (handled in Phase 4+)
- Frontend data access layers (handled in Phase 7)
- API endpoint implementations (handled in Phase 4)
- Database administration interfaces (handled in Phase 8)

---

### 3. DEPENDENCIES ON PREVIOUS PHASES AND IMPACT ON SUBSEQUENT PHASES

#### Dependencies on Previous Phases
- **Phase 1 Completion:** Development environment with PostgreSQL 15+ and Redis 7+ must be fully configured
- **Phase 2 Completion:** TypeORM configuration and database connection infrastructure must be established
- **Technology Stack:** NestJS framework with TypeScript support must be initialized
- **Development Tools:** Database management tools (pgAdmin, Redis Desktop Manager) must be operational

#### Impact on Subsequent Phases
- **Phase 4 (Authentication):** Database schema directly enables user authentication and authorization systems
- **Phase 5 (E-Commerce):** Product and order schemas provide foundation for business logic implementation
- **Phase 6 (Payments):** Payment transaction schema enables integration with Bangladeshi payment gateways
- **Phase 7 (Frontend):** Database structure determines API design and data access patterns
- **Phase 9 (Testing):** Database schema validation becomes critical component of testing strategy
- **Phase 10 (Optimization):** Indexing and optimization strategies built upon Phase 3 foundation

---

### 4. TECHNOLOGY STACK REQUIREMENTS

#### Database Management System
- **PostgreSQL 15+**: Primary database with advanced features including:
  - JSONB support for flexible schema evolution
  - Full-text search capabilities for Bengali content
  - Partitioning support for large table management
  - Advanced indexing options including partial and expression indexes
  - Transaction isolation levels for concurrent access control

#### Object-Relational Mapping
- **TypeORM 0.3+**: Database abstraction layer providing:
  - Entity relationship mapping with TypeScript decorators
  - Database migration management
  - Query builder with type safety
  - Connection pooling configuration
  - Lazy loading and relationship management

#### Caching Layer
- **Redis 7+**: In-memory data store for:
  - Session management and user authentication tokens
  - Query result caching for frequently accessed data
  - Rate limiting and API throttling
  - Temporary data storage for multilingual content
  - Real-time notifications and messaging

#### Database Tools
- **pgAdmin 4**: Database administration and management
- **Redis Desktop Manager**: Redis instance monitoring and management
- **Database Migration Tools**: TypeORM migration system
- **Query Analysis Tools**: EXPLAIN ANALYZE and pg_stat_statements
- **Backup Tools**: pg_dump and custom backup procedures

---

### 5. BANGLADESH-SPECIFIC REQUIREMENTS

#### Multilingual Support
- **Bengali Script Support**: Unicode UTF-8 encoding for all text fields
- **Language-Specific Content**: Separate fields for Bengali and English content
- **Collation Configuration**: Proper sorting and searching for Bengali text
- **Date/Time Formatting**: Bangla calendar support and local time zones
- **Number Formatting**: Bengali numeral system and currency formatting

#### Local Payment Methods
- **bKash Integration**: Transaction tracking for mobile wallet payments
- **Nagad Support**: Payment processing schema for Nagad transactions
- **Rocket Integration**: DBBL Rocket payment transaction management
- **SSL Wireless**: Credit/debit card processing and 3D Secure verification
- **Cash on Delivery**: COD order management and payment tracking

#### Regional Considerations
- **Address Formats**: Bangladesh-specific address components and validation
- **Phone Number Formats**: Local mobile number validation and formatting
- **Delivery Zones**: Geographic area mapping for delivery services
- **Tax Configuration**: VAT and local tax calculation support
- **Currency Handling**: Bangladeshi Taka (BDT) with proper decimal handling

---

## MILESTONE 1: USER MANAGEMENT DATABASE DESIGN

### Objectives and Goals
Design a comprehensive user management system that supports customer registration, authentication, profile management, and administrative access control while maintaining data security and privacy compliance.

### Detailed Subtasks with Implementation Steps

#### 1.1 Create Users Table Structure
- Design base user entity with authentication fields
- Implement password hashing storage with bcrypt compatibility
- Create email and phone number verification fields
- Add account status and activity tracking columns
- Implement soft delete mechanism for data retention

```sql
-- Users table structure
CREATE TABLE users (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    email VARCHAR(255) UNIQUE NOT NULL,
    phone_number VARCHAR(20) UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    date_of_birth DATE,
    gender VARCHAR(10),
    email_verified BOOLEAN DEFAULT FALSE,
    phone_verified BOOLEAN DEFAULT FALSE,
    account_status VARCHAR(20) DEFAULT 'active',
    last_login_at TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP
);
```

#### 1.2 Implement User Roles and Permissions
- Create roles table with hierarchical structure
- Design permissions table with resource-based access
- Implement user-role mapping table
- Create role-permission assignment table
- Add permission inheritance for role hierarchy

```sql
-- Roles table
CREATE TABLE roles (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    parent_role_id UUID REFERENCES roles(id),
    level INTEGER NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Permissions table
CREATE TABLE permissions (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(100) UNIQUE NOT NULL,
    resource VARCHAR(50) NOT NULL,
    action VARCHAR(50) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- User roles mapping
CREATE TABLE user_roles (
    user_id UUID REFERENCES users(id) ON DELETE CASCADE,
    role_id UUID REFERENCES roles(id) ON DELETE CASCADE,
    assigned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    assigned_by UUID REFERENCES users(id),
    PRIMARY KEY (user_id, role_id)
);
```

#### 1.3 Design User Profile and Preferences
- Create user profiles table with extended information
- Implement user preferences for language and notifications
- Add social media integration fields
- Create user avatar and media management
- Implement user activity tracking

```sql
-- User profiles table
CREATE TABLE user_profiles (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    user_id UUID REFERENCES users(id) ON DELETE CASCADE,
    bio TEXT,
    avatar_url VARCHAR(500),
    website_url VARCHAR(255),
    company VARCHAR(100),
    job_title VARCHAR(100),
    preferred_language VARCHAR(10) DEFAULT 'en',
    timezone VARCHAR(50) DEFAULT 'Asia/Dhaka',
    currency VARCHAR(10) DEFAULT 'BDT',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 1.4 Create Address Book System
- Design addresses table with Bangladesh-specific fields
- Implement address type classification (home, work, delivery)
- Add geolocation coordinates for delivery optimization
- Create address validation rules
- Implement default address selection

```sql
-- Addresses table
CREATE TABLE addresses (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    user_id UUID REFERENCES users(id) ON DELETE CASCADE,
    address_type VARCHAR(20) NOT NULL,
    address_line_1 VARCHAR(255) NOT NULL,
    address_line_2 VARCHAR(255),
    city VARCHAR(100) NOT NULL,
    district VARCHAR(100) NOT NULL,
    postal_code VARCHAR(10),
    country VARCHAR(50) DEFAULT 'Bangladesh',
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    is_default BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 1.5 Implement User Activity Tracking
- Create user activity log table
- Design session management structure
- Add login attempt tracking
- Implement password change history
- Create user behavior analytics storage

```sql
-- User activity log
CREATE TABLE user_activities (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    user_id UUID REFERENCES users(id) ON DELETE CASCADE,
    activity_type VARCHAR(50) NOT NULL,
    description TEXT,
    ip_address INET,
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Login attempts
CREATE TABLE login_attempts (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    email VARCHAR(255) NOT NULL,
    ip_address INET,
    user_agent TEXT,
    success BOOLEAN NOT NULL,
    failure_reason VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Acceptance Criteria for Validation
- All user entities properly relate with foreign key constraints
- Password fields use appropriate hashing algorithms
- Email and phone number validation implemented
- Soft delete mechanism preserves data integrity
- Role hierarchy properly enforces permission inheritance

### Estimated Completion Time
- **Total Duration:** 1.5 days
- **Database Design:** 4 hours
- **Implementation:** 6 hours
- **Testing and Validation:** 2 hours

### Required Resources
- PostgreSQL 15+ with UUID extension
- TypeORM entity definitions
- Database migration scripts
- Test data generation scripts
- Validation rule implementations

### Validation Checkpoints and Testing Procedures
- Verify all relationships maintain referential integrity
- Test password hashing and verification processes
- Validate email and phone number formats
- Test role-based access control logic
- Verify soft delete functionality

### Technical Specifications
- **Primary Keys:** UUID with gen_random_uuid() function
- **Indexes:** Unique indexes on email, phone_number
- **Constraints:** CHECK constraints for account_status values
- **Triggers:** Automatic updated_at timestamp management
- **Security:** Password fields with bcrypt hashing

---

## MILESTONE 2: PRODUCT CATALOG DATABASE DESIGN

### Objectives and Goals
Create a comprehensive product catalog system that supports multilingual content, product variants, inventory management, and category hierarchies while optimizing for search performance and mobile network conditions.

### Detailed Subtasks with Implementation Steps

#### 2.1 Create Products Table with Multilingual Support
- Design base product entity with multilingual fields
- Implement product status and visibility controls
- Add pricing and currency support for BDT
- Create product metadata for SEO optimization
- Implement product creation and modification tracking

```sql
-- Products table
CREATE TABLE products (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    sku VARCHAR(100) UNIQUE NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    name_en VARCHAR(255) NOT NULL,
    name_bn VARCHAR(255),
    description_en TEXT,
    description_bn TEXT,
    short_description_en TEXT,
    short_description_bn TEXT,
    base_price DECIMAL(10, 2) NOT NULL,
    compare_price DECIMAL(10, 2),
    cost_price DECIMAL(10, 2),
    weight DECIMAL(8, 3),
    dimensions JSONB,
    status VARCHAR(20) DEFAULT 'active',
    visibility VARCHAR(20) DEFAULT 'public',
    featured BOOLEAN DEFAULT FALSE,
    track_inventory BOOLEAN DEFAULT TRUE,
    requires_shipping BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    published_at TIMESTAMP
);
```

#### 2.2 Design Categories with Hierarchical Structure
- Create categories table with parent-child relationships
- Implement multilingual category names and descriptions
- Add category images and icons
- Create category sorting and ordering
- Implement category-level product filtering

```sql
-- Categories table
CREATE TABLE categories (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name_en VARCHAR(255) NOT NULL,
    name_bn VARCHAR(255),
    slug VARCHAR(255) UNIQUE NOT NULL,
    description_en TEXT,
    description_bn TEXT,
    image_url VARCHAR(500),
    icon_url VARCHAR(500),
    parent_category_id UUID REFERENCES categories(id),
    level INTEGER NOT NULL DEFAULT 0,
    sort_order INTEGER DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    meta_title_en VARCHAR(255),
    meta_title_bn VARCHAR(255),
    meta_description_en TEXT,
    meta_description_bn TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Product categories mapping
CREATE TABLE product_categories (
    product_id UUID REFERENCES products(id) ON DELETE CASCADE,
    category_id UUID REFERENCES categories(id) ON DELETE CASCADE,
    is_primary BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (product_id, category_id)
);
```

#### 2.3 Implement Product Variants and Attributes
- Create product variants table for size/color/options
- Design product attributes system
- Implement variant-specific pricing and inventory
- Create variant image management
- Add variant combination rules

```sql
-- Product variants table
CREATE TABLE product_variants (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    product_id UUID REFERENCES products(id) ON DELETE CASCADE,
    sku VARCHAR(100) UNIQUE NOT NULL,
    barcode VARCHAR(100),
    title VARCHAR(255),
    price DECIMAL(10, 2) NOT NULL,
    compare_price DECIMAL(10, 2),
    cost_price DECIMAL(10, 2),
    weight DECIMAL(8, 3),
    inventory_quantity INTEGER DEFAULT 0,
    inventory_policy VARCHAR(20) DEFAULT 'deny',
    requires_shipping BOOLEAN DEFAULT TRUE,
    taxable BOOLEAN DEFAULT TRUE,
    position INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Product attributes
CREATE TABLE product_attributes (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name_en VARCHAR(100) NOT NULL,
    name_bn VARCHAR(100),
    attribute_type VARCHAR(50) NOT NULL,
    is_required BOOLEAN DEFAULT FALSE,
    is_variant BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Product attribute values
CREATE TABLE product_attribute_values (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    attribute_id UUID REFERENCES product_attributes(id) ON DELETE CASCADE,
    value_en VARCHAR(255) NOT NULL,
    value_bn VARCHAR(255),
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Product variant attributes mapping
CREATE TABLE variant_attributes (
    variant_id UUID REFERENCES product_variants(id) ON DELETE CASCADE,
    attribute_id UUID REFERENCES product_attributes(id) ON DELETE CASCADE,
    attribute_value_id UUID REFERENCES product_attribute_values(id) ON DELETE CASCADE,
    PRIMARY KEY (variant_id, attribute_id)
);
```

#### 2.4 Create Product Images and Media Management
- Design product images table with ordering
- Implement image alt text in multiple languages
- Add image optimization metadata
- Create image variant management (thumbnails, etc.)
- Implement CDN integration preparation

```sql
-- Product images table
CREATE TABLE product_images (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    product_id UUID REFERENCES products(id) ON DELETE CASCADE,
    variant_id UUID REFERENCES product_variants(id) ON DELETE CASCADE,
    url VARCHAR(500) NOT NULL,
    alt_text_en VARCHAR(255),
    alt_text_bn VARCHAR(255),
    position INTEGER DEFAULT 0,
    width INTEGER,
    height INTEGER,
    file_size INTEGER,
    mime_type VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 2.5 Set Up Inventory Tracking System
- Create inventory locations table
- Implement inventory transaction tracking
- Add low stock alert configuration
- Create inventory adjustment history
- Implement stock reservation for orders

```sql
-- Inventory locations
CREATE TABLE inventory_locations (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(255) NOT NULL,
    address TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inventory levels
CREATE TABLE inventory_levels (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    variant_id UUID REFERENCES product_variants(id) ON DELETE CASCADE,
    location_id UUID REFERENCES inventory_locations(id) ON DELETE CASCADE,
    available INTEGER NOT NULL DEFAULT 0,
    committed INTEGER NOT NULL DEFAULT 0,
    on_hand INTEGER NOT NULL DEFAULT 0,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(variant_id, location_id)
);

-- Inventory transactions
CREATE TABLE inventory_transactions (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    variant_id UUID REFERENCES product_variants(id) ON DELETE CASCADE,
    location_id UUID REFERENCES inventory_locations(id) ON DELETE CASCADE,
    transaction_type VARCHAR(50) NOT NULL,
    quantity INTEGER NOT NULL,
    reference_id UUID,
    reference_type VARCHAR(50),
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by UUID REFERENCES users(id)
);
```

### Acceptance Criteria for Validation
- All product entities support multilingual content
- Product variants properly relate to base products
- Category hierarchy maintains referential integrity
- Inventory tracking accurately reflects stock levels
- Product images maintain proper ordering and relationships

### Estimated Completion Time
- **Total Duration:** 2 days
- **Database Design:** 6 hours
- **Implementation:** 8 hours
- **Testing and Validation:** 2 hours

### Required Resources
- PostgreSQL with JSONB support for flexible attributes
- TypeORM entity definitions with proper relationships
- Image storage preparation (local or CDN)
- Inventory management business rules
- Multilingual content validation procedures

### Validation Checkpoints and Testing Procedures
- Test multilingual content storage and retrieval
- Verify product variant combinations work correctly
- Test category hierarchy traversal
- Validate inventory transaction accuracy
- Test product image ordering and display

### Technical Specifications
- **Primary Keys:** UUID with gen_random_uuid() function
- **Indexes:** Composite indexes on product searches, category lookups
- **Constraints:** CHECK constraints for price values, inventory quantities
- **Triggers:** Automatic inventory level updates
- **Full-text Search:** PostgreSQL full-text search for Bengali content

---

## MILESTONE 3: ORDERS AND TRANSACTIONS DATABASE DESIGN

### Objectives and Goals
Design a comprehensive order management system that handles the complete order lifecycle, from cart creation through fulfillment, with support for order modifications, cancellations, and detailed tracking.

### Detailed Subtasks with Implementation Steps

#### 3.1 Create Orders Table with Comprehensive Fields
- Design base order entity with customer information
- Implement order status workflow management
- Add pricing and tax calculation fields
- Create shipping and delivery information
- Implement order modification tracking

```sql
-- Orders table
CREATE TABLE orders (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    order_number VARCHAR(50) UNIQUE NOT NULL,
    customer_id UUID REFERENCES users(id),
    customer_email VARCHAR(255),
    customer_phone VARCHAR(20),
    financial_status VARCHAR(20) DEFAULT 'pending',
    fulfillment_status VARCHAR(20) DEFAULT 'unfulfilled',
    status VARCHAR(20) DEFAULT 'open',
    currency VARCHAR(10) DEFAULT 'BDT',
    subtotal_price DECIMAL(10, 2) NOT NULL,
    total_tax DECIMAL(10, 2) DEFAULT 0,
    total_shipping DECIMAL(10, 2) DEFAULT 0,
    total_discount DECIMAL(10, 2) DEFAULT 0,
    total_price DECIMAL(10, 2) NOT NULL,
    notes TEXT,
    internal_notes TEXT,
    tags TEXT[],
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    processed_at TIMESTAMP,
    cancelled_at TIMESTAMP,
    closed_at TIMESTAMP
);
```

#### 3.2 Implement Order Items with Product Relationships
- Create order items table linking to product variants
- Implement pricing snapshot at time of order
- Add quantity and discount tracking
- Create order item customization fields
- Implement order item status tracking

```sql
-- Order items table
CREATE TABLE order_items (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    order_id UUID REFERENCES orders(id) ON DELETE CASCADE,
    variant_id UUID REFERENCES product_variants(id),
    product_id UUID REFERENCES products(id),
    product_title VARCHAR(255) NOT NULL,
    variant_title VARCHAR(255),
    sku VARCHAR(100) NOT NULL,
    quantity INTEGER NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    total_discount DECIMAL(10, 2) DEFAULT 0,
    total_price DECIMAL(10, 2) NOT NULL,
    taxable BOOLEAN DEFAULT TRUE,
    tax_amount DECIMAL(10, 2) DEFAULT 0,
    fulfillment_status VARCHAR(20) DEFAULT 'unfulfilled',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 3.3 Design Order Status Workflow
- Create order status history table
- Implement status transition rules
- Add automated status update triggers
- Create status notification configuration
- Implement order milestone tracking

```sql
-- Order status history
CREATE TABLE order_status_history (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    order_id UUID REFERENCES orders(id) ON DELETE CASCADE,
    from_status VARCHAR(20),
    to_status VARCHAR(20) NOT NULL,
    reason TEXT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by UUID REFERENCES users(id)
);

-- Order milestones
CREATE TABLE order_milestones (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    order_id UUID REFERENCES orders(id) ON DELETE CASCADE,
    milestone_type VARCHAR(50) NOT NULL,
    milestone_date TIMESTAMP NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 3.4 Create Order History and Tracking
- Design order modification tracking
- Implement order cancellation workflow
- Add return and exchange management
- Create order communication log
- Implement customer order history view

```sql
-- Order modifications
CREATE TABLE order_modifications (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    order_id UUID REFERENCES orders(id) ON DELETE CASCADE,
    modification_type VARCHAR(50) NOT NULL,
    original_data JSONB,
    modified_data JSONB,
    reason TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by UUID REFERENCES users(id)
);

-- Returns and exchanges
CREATE TABLE order_returns (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    order_id UUID REFERENCES orders(id) ON DELETE CASCADE,
    return_number VARCHAR(50) UNIQUE NOT NULL,
    return_type VARCHAR(20) NOT NULL,
    status VARCHAR(20) DEFAULT 'requested',
    reason TEXT,
    refund_amount DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Return items
CREATE TABLE return_items (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    return_id UUID REFERENCES order_returns(id) ON DELETE CASCADE,
    order_item_id UUID REFERENCES order_items(id),
    quantity INTEGER NOT NULL,
    reason TEXT,
    condition VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 3.5 Set Up Order Notes and Communication Log
- Create order notes system for internal communication
- Implement customer communication tracking
- Add automated message templates
- Create order notification history
- Implement order activity logging

```sql
-- Order notes
CREATE TABLE order_notes (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    order_id UUID REFERENCES orders(id) ON DELETE CASCADE,
    note_type VARCHAR(20) DEFAULT 'internal',
    content TEXT NOT NULL,
    is_customer_visible BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by UUID REFERENCES users(id)
);

-- Order communications
CREATE TABLE order_communications (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    order_id UUID REFERENCES orders(id) ON DELETE CASCADE,
    communication_type VARCHAR(50) NOT NULL,
    recipient VARCHAR(255) NOT NULL,
    subject VARCHAR(255),
    content TEXT,
    status VARCHAR(20) DEFAULT 'sent',
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by UUID REFERENCES users(id)
);
```

### Acceptance Criteria for Validation
- Order lifecycle properly maintained through status transitions
- Order items correctly reference product variants with pricing snapshots
- Order modifications tracked with full audit trail
- Return and exchange processes properly recorded
- Order communication history maintained for customer service

### Estimated Completion Time
- **Total Duration:** 1.5 days
- **Database Design:** 4 hours
- **Implementation:** 6 hours
- **Testing and Validation:** 2 hours

### Required Resources
- Order status workflow definitions
- Business rules for order modifications
- Return and exchange policies
- Communication template system
- Order numbering system

### Validation Checkpoints and Testing Procedures
- Test complete order lifecycle from creation to fulfillment
- Verify order modification tracking accuracy
- Test return and exchange workflows
- Validate order status transitions
- Test order communication logging

### Technical Specifications
- **Primary Keys:** UUID with gen_random_uuid() function
- **Indexes:** Composite indexes on order lookups, customer history
- **Constraints:** CHECK constraints for order status values
- **Triggers:** Automatic order number generation
- **Security:** Customer data protection with proper access controls

---

## MILESTONE 4: PAYMENT INTEGRATION DATABASE DESIGN

### Objectives and Goals
Create a comprehensive payment system that supports multiple Bangladeshi payment methods, tracks transactions, handles refunds, and maintains compliance with local financial regulations.

### Detailed Subtasks with Implementation Steps

#### 4.1 Create Payment Transactions Table
- Design payment transaction entity with comprehensive fields
- Implement payment method tracking
- Add transaction status management
- Create payment amount and currency handling
- Implement payment gateway integration fields

```sql
-- Payment transactions table
CREATE TABLE payment_transactions (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    transaction_id VARCHAR(100) UNIQUE NOT NULL,
    order_id UUID REFERENCES orders(id),
    customer_id UUID REFERENCES users(id),
    payment_method VARCHAR(50) NOT NULL,
    gateway VARCHAR(50) NOT NULL,
    gateway_transaction_id VARCHAR(100),
    amount DECIMAL(10, 2) NOT NULL,
    currency VARCHAR(10) DEFAULT 'BDT',
    status VARCHAR(20) DEFAULT 'pending',
    failure_reason TEXT,
    gateway_response JSONB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    processed_at TIMESTAMP
);
```

#### 4.2 Design Payment Method Configurations
- Create payment methods table with Bangladesh-specific options
- Implement payment method configuration
- Add payment method availability rules
- Create payment fee structures
- Implement payment method restrictions

```sql
-- Payment methods table
CREATE TABLE payment_methods (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(100) NOT NULL,
    display_name_en VARCHAR(100) NOT NULL,
    display_name_bn VARCHAR(100),
    method_type VARCHAR(50) NOT NULL,
    gateway VARCHAR(50),
    is_active BOOLEAN DEFAULT TRUE,
    min_amount DECIMAL(10, 2),
    max_amount DECIMAL(10, 2),
    fee_type VARCHAR(20),
    fee_amount DECIMAL(10, 2) DEFAULT 0,
    fee_percentage DECIMAL(5, 2) DEFAULT 0,
    supported_currencies TEXT[],
    configuration JSONB,
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 4.3 Implement Refund and Dispute Tracking
- Create refund transactions table
- Implement refund workflow management
- Add partial refund support
- Create dispute tracking system
- Implement refund reason tracking

```sql
-- Refunds table
CREATE TABLE refunds (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    refund_id VARCHAR(100) UNIQUE NOT NULL,
    payment_transaction_id UUID REFERENCES payment_transactions(id),
    order_id UUID REFERENCES orders(id),
    amount DECIMAL(10, 2) NOT NULL,
    reason VARCHAR(255),
    status VARCHAR(20) DEFAULT 'pending',
    gateway_refund_id VARCHAR(100),
    gateway_response JSONB,
    processed_by UUID REFERENCES users(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    processed_at TIMESTAMP
);

-- Disputes table
CREATE TABLE payment_disputes (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    dispute_id VARCHAR(100) UNIQUE NOT NULL,
    payment_transaction_id UUID REFERENCES payment_transactions(id),
    order_id UUID REFERENCES orders(id),
    reason VARCHAR(255) NOT NULL,
    status VARCHAR(20) DEFAULT 'open',
    amount DECIMAL(10, 2) NOT NULL,
    description TEXT,
    evidence JSONB,
    gateway_dispute_id VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    resolved_at TIMESTAMP
);
```

#### 4.4 Create Payment Webhook Logging
- Design webhook event logging system
- Implement webhook event processing
- Add webhook retry mechanism
- Create webhook signature verification
- Implement webhook event tracking

```sql
-- Payment webhooks table
CREATE TABLE payment_webhooks (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    gateway VARCHAR(50) NOT NULL,
    event_type VARCHAR(100) NOT NULL,
    event_id VARCHAR(100) NOT NULL,
    payload JSONB NOT NULL,
    signature VARCHAR(500),
    processed BOOLEAN DEFAULT FALSE,
    processing_attempts INTEGER DEFAULT 0,
    last_error TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    processed_at TIMESTAMP,
    UNIQUE(gateway, event_id)
);
```

#### 4.5 Set Up Payment Reconciliation System
- Create payment reconciliation records
- Implement daily reconciliation process
- Add settlement tracking
- Create payment discrepancy reporting
- Implement payment analytics storage

```sql
-- Payment settlements table
CREATE TABLE payment_settlements (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    settlement_id VARCHAR(100) UNIQUE NOT NULL,
    gateway VARCHAR(50) NOT NULL,
    settlement_date DATE NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    total_fees DECIMAL(10, 2) NOT NULL,
    net_amount DECIMAL(10, 2) NOT NULL,
    transaction_count INTEGER NOT NULL,
    currency VARCHAR(10) DEFAULT 'BDT',
    status VARCHAR(20) DEFAULT 'pending',
    gateway_response JSONB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Settlement transactions mapping
CREATE TABLE settlement_transactions (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    settlement_id UUID REFERENCES payment_settlements(id) ON DELETE CASCADE,
    transaction_id UUID REFERENCES payment_transactions(id) ON DELETE CASCADE,
    amount DECIMAL(10, 2) NOT NULL,
    fee_amount DECIMAL(10, 2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Acceptance Criteria for Validation
- Payment transactions properly tracked with gateway integration
- All Bangladesh payment methods supported with appropriate configurations
- Refund and dispute workflows properly implemented
- Webhook events logged and processed correctly
- Payment reconciliation accurately tracks financial settlements

### Estimated Completion Time
- **Total Duration:** 1.5 days
- **Database Design:** 4 hours
- **Implementation:** 6 hours
- **Testing and Validation:** 2 hours

### Required Resources
- Payment gateway API documentation (bKash, Nagad, Rocket, SSL Wireless)
- Bangladesh payment processing regulations
- Webhook security requirements
- Payment reconciliation procedures
- Financial reporting requirements

### Validation Checkpoints and Testing Procedures
- Test payment transaction creation and status updates
- Verify refund processing workflows
- Test webhook event processing
- Validate payment reconciliation accuracy
- Test payment method configurations

### Technical Specifications
- **Primary Keys:** UUID with gen_random_uuid() function
- **Indexes:** Unique indexes on transaction IDs, composite indexes on order payments
- **Constraints:** CHECK constraints for payment status values, amount validations
- **Triggers:** Automatic transaction ID generation
- **Security:** Payment data encryption and PCI DSS compliance considerations

---

## MILESTONE 5: REVIEWS AND RATINGS DATABASE DESIGN

### Objectives and Goals
Design a comprehensive review and rating system that supports customer feedback, moderation, rating calculations, and helpfulness voting while preventing spam and maintaining content quality.

### Detailed Subtasks with Implementation Steps

#### 5.1 Design Product Reviews with Moderation
- Create product reviews table with multilingual support
- Implement review status workflow
- Add review content validation
- Create review moderation system
- Implement review reporting mechanism

```sql
-- Product reviews table
CREATE TABLE product_reviews (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    product_id UUID REFERENCES products(id) ON DELETE CASCADE,
    variant_id UUID REFERENCES product_variants(id),
    order_id UUID REFERENCES orders(id),
    customer_id UUID REFERENCES users(id),
    customer_name VARCHAR(255),
    customer_email VARCHAR(255),
    rating INTEGER NOT NULL CHECK (rating >= 1 AND rating <= 5),
    title VARCHAR(255),
    content_en TEXT,
    content_bn TEXT,
    status VARCHAR(20) DEFAULT 'pending',
    is_verified_purchase BOOLEAN DEFAULT FALSE,
    is_featured BOOLEAN DEFAULT FALSE,
    helpful_count INTEGER DEFAULT 0,
    total_count INTEGER DEFAULT 0,
    moderated_by UUID REFERENCES users(id),
    moderation_notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    published_at TIMESTAMP
);
```

#### 5.2 Implement Rating Calculation System
- Create rating aggregation tables
- Implement automatic rating calculations
- Add rating distribution tracking
- Create rating history for products
- Implement rating weight calculations

```sql
-- Product ratings summary
CREATE TABLE product_ratings (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    product_id UUID REFERENCES products(id) ON DELETE CASCADE UNIQUE,
    average_rating DECIMAL(3, 2) NOT NULL DEFAULT 0,
    total_reviews INTEGER NOT NULL DEFAULT 0,
    rating_1_count INTEGER DEFAULT 0,
    rating_2_count INTEGER DEFAULT 0,
    rating_3_count INTEGER DEFAULT 0,
    rating_4_count INTEGER DEFAULT 0,
    rating_5_count INTEGER DEFAULT 0,
    last_review_date TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Rating history
CREATE TABLE rating_history (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    product_id UUID REFERENCES products(id) ON DELETE CASCADE,
    previous_rating DECIMAL(3, 2),
    new_rating DECIMAL(3, 2),
    review_count INTEGER,
    change_reason VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 5.3 Create Review Helpfulness Voting
- Design review voting system
- Implement helpful/unhelpful voting
- Add vote tracking to prevent manipulation
- Create voting analytics
- Implement vote weight calculations

```sql
-- Review votes table
CREATE TABLE review_votes (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    review_id UUID REFERENCES product_reviews(id) ON DELETE CASCADE,
    customer_id UUID REFERENCES users(id),
    vote_type VARCHAR(10) NOT NULL CHECK (vote_type IN ('helpful', 'not_helpful')),
    ip_address INET,
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(review_id, customer_id)
);
```

#### 5.4 Set Up Review Reporting System
- Create review reporting mechanism
- Implement report reason categorization
- Add report status tracking
- Create moderation queue
- Implement automated flagging

```sql
-- Review reports table
CREATE TABLE review_reports (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    review_id UUID REFERENCES product_reviews(id) ON DELETE CASCADE,
    reporter_id UUID REFERENCES users(id),
    reporter_email VARCHAR(255),
    reason VARCHAR(100) NOT NULL,
    description TEXT,
    status VARCHAR(20) DEFAULT 'pending',
    reviewed_by UUID REFERENCES users(id),
    review_notes TEXT,
    action_taken VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 5.5 Implement Review Response Management
- Create review response system
- Implement merchant response functionality
- Add response tracking
- Create response templates
- Implement response notification system

```sql
-- Review responses table
CREATE TABLE review_responses (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    review_id UUID REFERENCES product_reviews(id) ON DELETE CASCADE,
    responder_id UUID REFERENCES users(id),
    responder_type VARCHAR(20) NOT NULL,
    response_text TEXT NOT NULL,
    is_public BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Acceptance Criteria for Validation
- Review system properly supports multilingual content
- Rating calculations accurately reflect customer feedback
- Review voting system prevents manipulation
- Review reporting workflow functions correctly
- Review response management enables merchant engagement

### Estimated Completion Time
- **Total Duration:** 1 day
- **Database Design:** 3 hours
- **Implementation:** 4 hours
- **Testing and Validation:** 1 hour

### Required Resources
- Review moderation guidelines
- Rating calculation algorithms
- Content filtering rules
- Review notification templates
- Review analytics requirements

### Validation Checkpoints and Testing Procedures
- Test review creation and moderation workflow
- Verify rating calculation accuracy
- Test review voting system
- Validate review reporting functionality
- Test review response management

### Technical Specifications
- **Primary Keys:** UUID with gen_random_uuid() function
- **Indexes:** Composite indexes on product reviews, customer reviews
- **Constraints:** CHECK constraints for rating values, vote types
- **Triggers:** Automatic rating updates on review changes
- **Security:** Review content validation and spam prevention

---

## MILESTONE 6: CONTENT MANAGEMENT SYSTEM DATABASE DESIGN

### Objectives and Goals
Create a flexible content management system that supports multilingual content, page management, blog functionality, media organization, and SEO optimization for the Saffron website.

### Detailed Subtasks with Implementation Steps

#### 6.1 Create CMS Pages with Multilingual Content
- Design pages table with multilingual support
- Implement page template system
- Add page status and visibility controls
- Create page hierarchy and navigation
- Implement page revision history

```sql
-- CMS pages table
CREATE TABLE cms_pages (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    title_en VARCHAR(255) NOT NULL,
    title_bn VARCHAR(255),
    slug VARCHAR(255) UNIQUE NOT NULL,
    content_en TEXT,
    content_bn TEXT,
    excerpt_en TEXT,
    excerpt_bn TEXT,
    meta_title_en VARCHAR(255),
    meta_title_bn VARCHAR(255),
    meta_description_en TEXT,
    meta_description_bn TEXT,
    meta_keywords TEXT,
    status VARCHAR(20) DEFAULT 'draft',
    visibility VARCHAR(20) DEFAULT 'public',
    template VARCHAR(100),
    featured_image_url VARCHAR(500),
    parent_page_id UUID REFERENCES cms_pages(id),
    sort_order INTEGER DEFAULT 0,
    published_at TIMESTAMP,
    created_by UUID REFERENCES users(id),
    updated_by UUID REFERENCES users(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 6.2 Implement Blog and Article Management
- Create blog posts table with categorization
- Implement blog post tags and metadata
- Add blog post scheduling
- Create blog author management
- Implement blog comment system

```sql
-- Blog posts table
CREATE TABLE blog_posts (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    title_en VARCHAR(255) NOT NULL,
    title_bn VARCHAR(255),
    slug VARCHAR(255) UNIQUE NOT NULL,
    content_en TEXT,
    content_bn TEXT,
    excerpt_en TEXT,
    excerpt_bn TEXT,
    featured_image_url VARCHAR(500),
    status VARCHAR(20) DEFAULT 'draft',
    post_type VARCHAR(20) DEFAULT 'post',
    author_id UUID REFERENCES users(id),
    published_at TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Blog categories
CREATE TABLE blog_categories (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name_en VARCHAR(255) NOT NULL,
    name_bn VARCHAR(255),
    slug VARCHAR(255) UNIQUE NOT NULL,
    description_en TEXT,
    description_bn TEXT,
    parent_category_id UUID REFERENCES blog_categories(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Blog post categories mapping
CREATE TABLE blog_post_categories (
    post_id UUID REFERENCES blog_posts(id) ON DELETE CASCADE,
    category_id UUID REFERENCES blog_categories(id) ON DELETE CASCADE,
    PRIMARY KEY (post_id, category_id)
);

-- Blog tags
CREATE TABLE blog_tags (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name_en VARCHAR(100) NOT NULL,
    name_bn VARCHAR(100),
    slug VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Blog post tags mapping
CREATE TABLE blog_post_tags (
    post_id UUID REFERENCES blog_posts(id) ON DELETE CASCADE,
    tag_id UUID REFERENCES blog_tags(id) ON DELETE CASCADE,
    PRIMARY KEY (post_id, tag_id)
);
```

#### 6.3 Design Media Library with Categorization
- Create media library table
- Implement media categorization and tagging
- Add media metadata storage
- Create media optimization tracking
- Implement media usage tracking

```sql
-- Media library table
CREATE TABLE media_library (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    filename VARCHAR(255) NOT NULL,
    original_filename VARCHAR(255) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    file_url VARCHAR(500) NOT NULL,
    file_size INTEGER NOT NULL,
    mime_type VARCHAR(100) NOT NULL,
    width INTEGER,
    height INTEGER,
    alt_text_en VARCHAR(255),
    alt_text_bn VARCHAR(255),
    caption_en TEXT,
    caption_bn TEXT,
    description_en TEXT,
    description_bn TEXT,
    uploaded_by UUID REFERENCES users(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Media categories
CREATE TABLE media_categories (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name_en VARCHAR(100) NOT NULL,
    name_bn VARCHAR(100),
    slug VARCHAR(100) UNIQUE NOT NULL,
    parent_category_id UUID REFERENCES media_categories(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Media category mapping
CREATE TABLE media_categories_mapping (
    media_id UUID REFERENCES media_library(id) ON DELETE CASCADE,
    category_id UUID REFERENCES media_categories(id) ON DELETE CASCADE,
    PRIMARY KEY (media_id, category_id)
);
```

#### 6.4 Create Menu and Navigation Structure
- Design navigation menus table
- Implement menu item hierarchy
- Add menu visibility and targeting
- Create menu customization options
- Implement menu caching preparation

```sql
-- Navigation menus table
CREATE TABLE navigation_menus (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) UNIQUE NOT NULL,
    description TEXT,
    location VARCHAR(100),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Menu items table
CREATE TABLE menu_items (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    menu_id UUID REFERENCES navigation_menus(id) ON DELETE CASCADE,
    parent_item_id UUID REFERENCES menu_items(id),
    title_en VARCHAR(255) NOT NULL,
    title_bn VARCHAR(255),
    url VARCHAR(500),
    target VARCHAR(20) DEFAULT '_self',
    css_class VARCHAR(100),
    sort_order INTEGER DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 6.5 Set Up SEO Metadata Management
- Create SEO metadata table
- Implement structured data support
- Add sitemap management
- Create SEO optimization tracking
- Implement meta tag management

```sql
-- SEO metadata table
CREATE TABLE seo_metadata (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    entity_type VARCHAR(50) NOT NULL,
    entity_id UUID NOT NULL,
    meta_title_en VARCHAR(255),
    meta_title_bn VARCHAR(255),
    meta_description_en TEXT,
    meta_description_bn TEXT,
    meta_keywords TEXT,
    og_title VARCHAR(255),
    og_description TEXT,
    og_image VARCHAR(500),
    canonical_url VARCHAR(500),
    robots VARCHAR(100),
    structured_data JSONB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(entity_type, entity_id)
);

-- Sitemap entries
CREATE TABLE sitemap_entries (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    url VARCHAR(500) NOT NULL,
    last_modified TIMESTAMP NOT NULL,
    change_frequency VARCHAR(20) DEFAULT 'weekly',
    priority DECIMAL(2, 1) DEFAULT 0.5,
    entity_type VARCHAR(50),
    entity_id UUID,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Acceptance Criteria for Validation
- CMS system properly supports multilingual content
- Blog functionality includes categorization and tagging
- Media library supports categorization and metadata
- Navigation system supports hierarchical menus
- SEO metadata management enables search optimization

### Estimated Completion Time
- **Total Duration:** 1.5 days
- **Database Design:** 4 hours
- **Implementation:** 6 hours
- **Testing and Validation:** 2 hours

### Required Resources
- Content management requirements
- Multilingual content guidelines
- Media optimization specifications
- SEO best practices
- Navigation structure requirements

### Validation Checkpoints and Testing Procedures
- Test multilingual content creation and management
- Verify blog categorization and tagging functionality
- Test media library organization and metadata
- Validate navigation menu hierarchy
- Test SEO metadata management

### Technical Specifications
- **Primary Keys:** UUID with gen_random_uuid() function
- **Indexes:** Unique indexes on slugs, composite indexes on content searches
- **Constraints:** CHECK constraints for status values, URL validations
- **Triggers:** Automatic slug generation, timestamp updates
- **Security:** Content validation and sanitization

---

## MILESTONE 7: NOTIFICATIONS DATABASE DESIGN

### Objectives and Goals
Design a comprehensive notification system that supports multiple notification channels, user preferences, template management, and delivery tracking while respecting user privacy and communication preferences.

### Detailed Subtasks with Implementation Steps

#### 7.1 Create Notification Templates
- Design notification templates table with multilingual support
- Implement template variable substitution
- Add template versioning
- Create template preview functionality
- Implement template approval workflow

```sql
-- Notification templates table
CREATE TABLE notification_templates (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    channel VARCHAR(20) NOT NULL,
    subject_en VARCHAR(255),
    subject_bn VARCHAR(255),
    content_en TEXT NOT NULL,
    content_bn TEXT,
    variables JSONB,
    is_active BOOLEAN DEFAULT TRUE,
    version INTEGER DEFAULT 1,
    created_by UUID REFERENCES users(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 7.2 Design User Notification Preferences
- Create user notification preferences table
- Implement channel-specific preferences
- Add notification frequency controls
- Create preference categories
- Implement quiet hours configuration

```sql
-- User notification preferences table
CREATE TABLE user_notification_preferences (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    user_id UUID REFERENCES users(id) ON DELETE CASCADE,
    notification_type VARCHAR(50) NOT NULL,
    email_enabled BOOLEAN DEFAULT TRUE,
    sms_enabled BOOLEAN DEFAULT FALSE,
    push_enabled BOOLEAN DEFAULT TRUE,
    in_app_enabled BOOLEAN DEFAULT TRUE,
    frequency VARCHAR(20) DEFAULT 'immediate',
    quiet_hours_start TIME,
    quiet_hours_end TIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(user_id, notification_type)
);
```

#### 7.3 Implement Notification Queue System
- Design notification queue table
- Implement priority-based processing
- Add retry mechanism for failed notifications
- Create batch processing support
- Implement notification deduplication

```sql
-- Notification queue table
CREATE TABLE notification_queue (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    template_id UUID REFERENCES notification_templates(id),
    recipient_id UUID REFERENCES users(id),
    recipient_email VARCHAR(255),
    recipient_phone VARCHAR(20),
    channel VARCHAR(20) NOT NULL,
    priority INTEGER DEFAULT 5,
    status VARCHAR(20) DEFAULT 'pending',
    variables JSONB,
    content JSONB,
    scheduled_at TIMESTAMP,
    attempts INTEGER DEFAULT 0,
    max_attempts INTEGER DEFAULT 3,
    last_error TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    sent_at TIMESTAMP
);
```

#### 7.4 Create Notification History
- Design notification history table
- Implement delivery tracking
- Add user interaction tracking
- Create notification analytics
- Implement retention policies

```sql
-- Notification history table
CREATE TABLE notification_history (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    queue_id UUID REFERENCES notification_queue(id),
    template_id UUID REFERENCES notification_templates(id),
    recipient_id UUID REFERENCES users(id),
    channel VARCHAR(20) NOT NULL,
    status VARCHAR(20) NOT NULL,
    sent_at TIMESTAMP,
    delivered_at TIMESTAMP,
    read_at TIMESTAMP,
    clicked_at TIMESTAMP,
    error_message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 7.5 Set Up Email/SMS Logging
- Create email delivery log table
- Implement SMS delivery tracking
- Add delivery provider information
- Create delivery analytics
- Implement bounce handling

```sql
-- Email delivery log table
CREATE TABLE email_delivery_log (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    notification_id UUID REFERENCES notification_history(id),
    to_email VARCHAR(255) NOT NULL,
    from_email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    provider VARCHAR(50) NOT NULL,
    provider_message_id VARCHAR(255),
    status VARCHAR(20) NOT NULL,
    bounce_type VARCHAR(50),
    bounce_reason TEXT,
    opened_at TIMESTAMP,
    clicked_at TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- SMS delivery log table
CREATE TABLE sms_delivery_log (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    notification_id UUID REFERENCES notification_history(id),
    to_phone VARCHAR(20) NOT NULL,
    from_phone VARCHAR(20),
    message TEXT NOT NULL,
    provider VARCHAR(50) NOT NULL,
    provider_message_id VARCHAR(255),
    status VARCHAR(20) NOT NULL,
    delivery_status VARCHAR(50),
    error_code VARCHAR(50),
    error_message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Acceptance Criteria for Validation
- Notification system supports multiple channels (email, SMS, push, in-app)
- User preferences properly control notification delivery
- Template system supports variable substitution and multilingual content
- Queue system handles priority and retry logic
- Delivery tracking provides comprehensive analytics

### Estimated Completion Time
- **Total Duration:** 1 day
- **Database Design:** 3 hours
- **Implementation:** 4 hours
- **Testing and Validation:** 1 hour

### Required Resources
- Notification channel providers (email, SMS, push)
- Template management requirements
- User privacy regulations
- Notification frequency policies
- Delivery analytics requirements

### Validation Checkpoints and Testing Procedures
- Test template creation and variable substitution
- Verify user preference enforcement
- Test notification queue processing
- Validate delivery tracking accuracy
- Test multilingual notification content

### Technical Specifications
- **Primary Keys:** UUID with gen_random_uuid() function
- **Indexes:** Composite indexes on recipient notifications, status tracking
- **Constraints:** CHECK constraints for notification types, status values
- **Triggers:** Automatic status updates, timestamp management
- **Security:** User consent tracking and privacy compliance

---

## MILESTONE 8: ANALYTICS DATABASE DESIGN

### Objectives and Goals
Design a comprehensive analytics system that tracks visitor behavior, sales performance, user engagement, and business metrics while providing actionable insights for the Saffron platform.

### Detailed Subtasks with Implementation Steps

#### 8.1 Design Visitor Tracking System
- Create visitor sessions table
- Implement page view tracking
- Add user journey mapping
- Create visitor identification system
- Implement session reconstruction

```sql
-- Visitor sessions table
CREATE TABLE visitor_sessions (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    session_id VARCHAR(100) UNIQUE NOT NULL,
    visitor_id VARCHAR(100),
    user_id UUID REFERENCES users(id),
    ip_address INET,
    user_agent TEXT,
    referrer_url VARCHAR(500),
    landing_page VARCHAR(500),
    exit_page VARCHAR(500),
    device_type VARCHAR(50),
    browser VARCHAR(100),
    operating_system VARCHAR(100),
    location_country VARCHAR(100),
    location_city VARCHAR(100),
    started_at TIMESTAMP NOT NULL,
    ended_at TIMESTAMP,
    duration_seconds INTEGER,
    page_views INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Page views table
CREATE TABLE page_views (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    session_id UUID REFERENCES visitor_sessions(id) ON DELETE CASCADE,
    user_id UUID REFERENCES users(id),
    url VARCHAR(500) NOT NULL,
    title VARCHAR(255),
    referrer VARCHAR(500),
    time_on_page_seconds INTEGER,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 8.2 Implement Sales Analytics Tables
- Create sales analytics summary table
- Implement product performance tracking
- Add customer segmentation analytics
- Create conversion funnel tracking
- Implement sales trend analysis

```sql
-- Sales analytics summary table
CREATE TABLE sales_analytics (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    date DATE NOT NULL,
    total_orders INTEGER NOT NULL DEFAULT 0,
    total_revenue DECIMAL(12, 2) NOT NULL DEFAULT 0,
    average_order_value DECIMAL(10, 2),
    conversion_rate DECIMAL(5, 2),
    new_customers INTEGER DEFAULT 0,
    returning_customers INTEGER DEFAULT 0,
    top_selling_product_id UUID REFERENCES products(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(date)
);

-- Product performance analytics
CREATE TABLE product_performance (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    product_id UUID REFERENCES products(id) ON DELETE CASCADE,
    date DATE NOT NULL,
    views INTEGER DEFAULT 0,
    unique_views INTEGER DEFAULT 0,
    add_to_carts INTEGER DEFAULT 0,
    purchases INTEGER DEFAULT 0,
    revenue DECIMAL(10, 2) DEFAULT 0,
    conversion_rate DECIMAL(5, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(product_id, date)
);
```

#### 8.3 Create User Behavior Tracking
- Design user activity events table
- Implement feature usage tracking
- Add user engagement metrics
- Create user journey analysis
- Implement retention tracking

```sql
-- User activity events table
CREATE TABLE user_activity_events (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    user_id UUID REFERENCES users(id),
    session_id VARCHAR(100),
    event_type VARCHAR(100) NOT NULL,
    event_category VARCHAR(50),
    event_action VARCHAR(100),
    event_label VARCHAR(255),
    event_value INTEGER,
    page_url VARCHAR(500),
    additional_data JSONB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- User engagement metrics
CREATE TABLE user_engagement_metrics (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    user_id UUID REFERENCES users(id) ON DELETE CASCADE,
    date DATE NOT NULL,
    sessions_count INTEGER DEFAULT 0,
    total_time_seconds INTEGER DEFAULT 0,
    pages_viewed INTEGER DEFAULT 0,
    actions_performed INTEGER DEFAULT 0,
    last_activity TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(user_id, date)
);
```

#### 8.4 Set Up Performance Metrics Storage
- Create application performance metrics table
- Implement API response time tracking
- Add database query performance
- Create error rate monitoring
- Implement system health tracking

```sql
-- Application performance metrics
CREATE TABLE application_performance (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    timestamp TIMESTAMP NOT NULL,
    metric_type VARCHAR(50) NOT NULL,
    metric_name VARCHAR(100) NOT NULL,
    value DECIMAL(10, 2) NOT NULL,
    unit VARCHAR(20),
    tags JSONB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- API performance tracking
CREATE TABLE api_performance (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    endpoint VARCHAR(255) NOT NULL,
    method VARCHAR(10) NOT NULL,
    response_time_ms INTEGER NOT NULL,
    status_code INTEGER NOT NULL,
    user_id UUID REFERENCES users(id),
    ip_address INET,
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### 8.5 Design Reporting Aggregation Tables
- Create daily/weekly/monthly aggregation tables
- Implement custom report definitions
- Add report scheduling system
- Create report cache management
- Implement export functionality

```sql
-- Report definitions table
CREATE TABLE report_definitions (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    name VARCHAR(255) NOT NULL,
    description TEXT,
    report_type VARCHAR(50) NOT NULL,
    query_sql TEXT NOT NULL,
    parameters JSONB,
    schedule_type VARCHAR(20),
    schedule_config JSONB,
    is_active BOOLEAN DEFAULT TRUE,
    created_by UUID REFERENCES users(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Generated reports table
CREATE TABLE generated_reports (
    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
    report_definition_id UUID REFERENCES report_definitions(id) ON DELETE CASCADE,
    report_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(500),
    file_size INTEGER,
    format VARCHAR(20) NOT NULL,
    status VARCHAR(20) DEFAULT 'generating',
    generated_by UUID REFERENCES users(id),
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expires_at TIMESTAMP
);
```

### Acceptance Criteria for Validation
- Analytics system accurately tracks visitor behavior and sessions
- Sales analytics provide meaningful business insights
- User behavior tracking enables engagement analysis
- Performance metrics identify system bottlenecks
- Reporting system supports custom queries and scheduling

### Estimated Completion Time
- **Total Duration:** 1.5 days
- **Database Design:** 4 hours
- **Implementation:** 6 hours
- **Testing and Validation:** 2 hours

### Required Resources
- Analytics tracking requirements
- Business intelligence needs
- Performance monitoring tools
- Data privacy regulations
- Report generation specifications

### Validation Checkpoints and Testing Procedures
- Test visitor session tracking accuracy
- Verify sales analytics calculations
- Test user behavior event capture
- Validate performance metric collection
- Test report generation and scheduling

### Technical Specifications
- **Primary Keys:** UUID with gen_random_uuid() function
- **Indexes:** Time-based indexes for analytics queries, composite indexes for filtering
- **Partitions:** Table partitioning for large analytics tables by date
- **Constraints:** CHECK constraints for metric values, status validations
- **Security:** User privacy compliance and data anonymization

---

## MILESTONE 9: DATABASE OPTIMIZATION AND PERFORMANCE TUNING

### Objectives and Goals
Optimize database performance through strategic indexing, query optimization, connection management, and performance monitoring to ensure efficient operation under load and optimal response times for Bangladesh network conditions.

### Detailed Subtasks with Implementation Steps

#### 9.1 Create Strategic Indexes for Performance
- Analyze query patterns and create optimal indexes
- Implement composite indexes for common query combinations
- Add partial indexes for filtered queries
- Create expression indexes for computed values
- Implement full-text search indexes for Bengali content

```sql
-- Product search indexes
CREATE INDEX idx_products_name_en ON products USING gin(to_tsvector('english', name_en));
CREATE INDEX idx_products_name_bn ON products USING gin(to_tsvector('bengali', name_bn));
CREATE INDEX idx_products_status_visibility ON products(status, visibility) WHERE status = 'active';
CREATE INDEX idx_products_category ON products(id) WHERE status = 'active';

-- Order performance indexes
CREATE INDEX idx_orders_customer_date ON orders(customer_id, created_at DESC);
CREATE INDEX idx_orders_status_date ON orders(status, created_at DESC);
CREATE INDEX idx_orders_number ON orders(order_number);

-- User activity indexes
CREATE INDEX idx_user_activities_user_date ON user_activities(user_id, created_at DESC);
CREATE INDEX idx_user_activities_type_date ON user_activities(activity_type, created_at DESC);

-- Analytics performance indexes
CREATE INDEX idx_visitor_sessions_date ON visitor_sessions(started_at DESC);
CREATE INDEX idx_page_views_session_date ON page_views(session_id, created_at DESC);
CREATE INDEX idx_api_performance_endpoint_date ON api_performance(endpoint, created_at DESC);
```

#### 9.2 Implement Database Partitioning Strategy
- Design table partitioning for large datasets
- Implement range partitioning for time-based data
- Add list partitioning for categorical data
- Create partition maintenance procedures
- Implement partition pruning optimization

```sql
-- Partition visitor_sessions by month
CREATE TABLE visitor_sessions (
    id UUID,
    session_id VARCHAR(100),
    visitor_id VARCHAR(100),
    user_id UUID,
    ip_address INET,
    user_agent TEXT,
    referrer_url VARCHAR(500),
    landing_page VARCHAR(500),
    exit_page VARCHAR(500),
    device_type VARCHAR(50),
    browser VARCHAR(100),
    operating_system VARCHAR(100),
    location_country VARCHAR(100),
    location_city VARCHAR(100),
    started_at TIMESTAMP NOT NULL,
    ended_at TIMESTAMP,
    duration_seconds INTEGER,
    page_views INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) PARTITION BY RANGE (started_at);

-- Create monthly partitions
CREATE TABLE visitor_sessions_2026_01 PARTITION OF visitor_sessions
    FOR VALUES FROM ('2026-01-01') TO ('2026-02-01');

CREATE TABLE visitor_sessions_2026_02 PARTITION OF visitor_sessions
    FOR VALUES FROM ('2026-02-01') TO ('2026-03-01');

-- Similar partitioning for other large tables
CREATE TABLE page_views (
    id UUID,
    session_id UUID,
    user_id UUID,
    url VARCHAR(500) NOT NULL,
    title VARCHAR(255),
    referrer VARCHAR(500),
    time_on_page_seconds INTEGER,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) PARTITION BY RANGE (created_at);
```

#### 9.3 Set Up Query Optimization
- Analyze slow query logs and optimize problematic queries
- Implement query execution plan analysis
- Add query caching strategies
- Create materialized views for complex aggregations
- Implement query timeout management

```sql
-- Materialized views for analytics
CREATE MATERIALIZED VIEW daily_sales_summary AS
SELECT 
    DATE(created_at) as date,
    COUNT(*) as total_orders,
    SUM(total_price) as total_revenue,
    AVG(total_price) as average_order_value,
    COUNT(DISTINCT customer_id) as unique_customers
FROM orders 
WHERE status NOT IN ('cancelled', 'refunded')
GROUP BY DATE(created_at);

-- Create unique index for refresh
CREATE UNIQUE INDEX idx_daily_sales_summary_date ON daily_sales_summary(date);

-- Refresh procedure
CREATE OR REPLACE FUNCTION refresh_daily_sales_summary()
RETURNS void AS $$
BEGIN
    REFRESH MATERIALIZED VIEW CONCURRENTLY daily_sales_summary;
END;
$$ LANGUAGE plpgsql;

-- Schedule refresh (would be handled by external job scheduler)
```

#### 9.4 Configure Connection Pooling
- Set up optimal connection pool parameters
- Implement connection timeout management
- Add connection health monitoring
- Create connection usage analytics
- Implement connection failover mechanisms

```sql
-- Connection pool configuration (TypeORM)
-- These would be configured in the application, not SQL
-- Example configuration values:
{
  "type": "postgres",
  "host": "localhost",
  "port": 5432,
  "username": "saffron_user",
  "password": "secure_password",
  "database": "saffron_db",
  "extra": {
    "max": 20,
    "min": 5,
    "idleTimeoutMillis": 30000,
    "connectionTimeoutMillis": 2000
  }
}
```

#### 9.5 Create Database Maintenance Procedures
- Implement automated vacuum and analyze procedures
- Create index maintenance routines
- Add statistics collection and analysis
- Create backup verification procedures
- Implement database health monitoring

```sql
-- Maintenance procedures
CREATE OR REPLACE FUNCTION perform_maintenance()
RETURNS void AS $$
BEGIN
    -- Update table statistics
    ANALYZE;
    
    -- Vacuum tables with high update/delete activity
    VACUUM (ANALYZE, VERBOSE) user_activities;
    VACUUM (ANALYZE, VERBOSE) visitor_sessions;
    VACUUM (ANALYZE, VERBOSE) page_views;
    
    -- Reindex fragmented indexes
    REINDEX INDEX CONCURRENTLY idx_products_name_en;
    REINDEX INDEX CONCURRENTLY idx_orders_customer_date;
    
    -- Refresh materialized views
    REFRESH MATERIALIZED VIEW CONCURRENTLY daily_sales_summary;
END;
$$ LANGUAGE plpgsql;

-- Database health monitoring
CREATE OR REPLACE FUNCTION check_database_health()
RETURNS TABLE(
    metric_name text,
    metric_value numeric,
    status text
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        'active_connections'::text,
        COUNT(*)::numeric,
        CASE WHEN COUNT(*) < 50 THEN 'OK' ELSE 'WARNING' END::text
    FROM pg_stat_activity 
    WHERE state = 'active';
    
    RETURN QUERY
    SELECT 
        'database_size_gb'::text,
        ROUND(pg_database_size(current_database()) / 1024.0 / 1024.0 / 1024.0, 2),
        CASE WHEN pg_database_size(current_database()) < 100 * 1024 * 1024 * 1024 THEN 'OK' ELSE 'WARNING' END::text;
    
    RETURN QUERY
    SELECT 
        'slow_queries_count'::text,
        COUNT(*)::numeric,
        CASE WHEN COUNT(*) = 0 THEN 'OK' ELSE 'CRITICAL' END::text
    FROM pg_stat_statements 
    WHERE mean_exec_time > 1000;
END;
$$ LANGUAGE plpgsql;
```

### Acceptance Criteria for Validation
- Database queries execute within acceptable time limits (<100ms for critical queries)
- Indexes effectively improve query performance
- Partitioning reduces query times for large tables
- Connection pooling handles concurrent users efficiently
- Maintenance procedures keep database optimized

### Estimated Completion Time
- **Total Duration:** 1.5 days
- **Database Design:** 4 hours
- **Implementation:** 6 hours
- **Testing and Validation:** 2 hours

### Required Resources
- Database performance monitoring tools
- Query analysis utilities
- Load testing framework
- Database administration tools
- Performance benchmarking data

### Validation Checkpoints and Testing Procedures
- Test query performance before and after optimization
- Verify index effectiveness with EXPLAIN ANALYZE
- Test connection pooling under load
- Validate partition maintenance procedures
- Test materialized view refresh performance

### Technical Specifications
- **Index Types:** B-tree, GIN, GiST, partial, and expression indexes
- **Partitioning:** Range partitioning by date for time-series data
- **Materialized Views:** For complex aggregations and reporting
- **Connection Pooling:** PgBouncer or application-level pooling
- **Monitoring:** pg_stat_statements, pg_stat_activity, custom health checks

---

## MILESTONE 10: DATABASE VERIFICATION AND TESTING

### Objectives and Goals
Comprehensively test the database implementation to ensure data integrity, performance under load, security compliance, and readiness for production deployment while validating all relationships and constraints.

### Detailed Subtasks with Implementation Steps

#### 10.1 Test All Relationships and Constraints
- Create comprehensive test suite for foreign key relationships
- Validate referential integrity across all tables
- Test cascade delete and update operations
- Verify constraint enforcement
- Create relationship integrity reports

```sql
-- Foreign key relationship tests
CREATE OR REPLACE FUNCTION test_foreign_key_relationships()
RETURNS TABLE(
    table_name text,
    relationship_type text,
    test_result text,
    details text
) AS $$
DECLARE
    test_record RECORD;
    test_count INTEGER;
BEGIN
    -- Test user relationships
    SELECT COUNT(*) INTO test_count FROM user_profiles WHERE user_id NOT IN (SELECT id FROM users WHERE deleted_at IS NULL);
    RETURN QUERY SELECT 'user_profiles'::text, 'user_id foreign key'::text, 
        CASE WHEN test_count = 0 THEN 'PASS' ELSE 'FAIL' END::text,
        'Orphaned user profiles: ' || test_count::text;
    
    -- Test order relationships
    SELECT COUNT(*) INTO test_count FROM order_items WHERE order_id NOT IN (SELECT id FROM orders);
    RETURN QUERY SELECT 'order_items'::text, 'order_id foreign key'::text,
        CASE WHEN test_count = 0 THEN 'PASS' ELSE 'FAIL' END::text,
        'Orphaned order items: ' || test_count::text;
    
    -- Test product relationships
    SELECT COUNT(*) INTO test_count FROM product_variants WHERE product_id NOT IN (SELECT id FROM products);
    RETURN QUERY SELECT 'product_variants'::text, 'product_id foreign key'::text,
        CASE WHEN test_count = 0 THEN 'PASS' ELSE 'FAIL' END::text,
        'Orphaned product variants: ' || test_count::text;
    
    -- Test address relationships
    SELECT COUNT(*) INTO test_count FROM addresses WHERE user_id NOT IN (SELECT id FROM users WHERE deleted_at IS NULL);
    RETURN QUERY SELECT 'addresses'::text, 'user_id foreign key'::text,
        CASE WHEN test_count = 0 THEN 'PASS' ELSE 'FAIL' END::text,
        'Orphaned addresses: ' || test_count::text;
END;
$$ LANGUAGE plpgsql;
```

#### 10.2 Verify Data Integrity
- Create data validation procedures
- Test data type constraints
- Validate business rule enforcement
- Check for data anomalies
- Create data quality reports

```sql
-- Data integrity validation
CREATE OR REPLACE FUNCTION validate_data_integrity()
RETURNS TABLE(
    validation_type text,
    table_name text,
    issue_count integer,
    status text
) AS $$
DECLARE
    issue_count INTEGER;
BEGIN
    -- Check for negative prices
    SELECT COUNT(*) INTO issue_count FROM products WHERE base_price < 0;
    RETURN QUERY SELECT 'price_validation'::text, 'products'::text, issue_count,
        CASE WHEN issue_count = 0 THEN 'PASS' ELSE 'FAIL' END::text;
    
    -- Check for invalid email formats
    SELECT COUNT(*) INTO issue_count FROM users WHERE email !~ '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$';
    RETURN QUERY SELECT 'email_format'::text, 'users'::text, issue_count,
        CASE WHEN issue_count = 0 THEN 'PASS' ELSE 'FAIL' END::text;
    
    -- Check for invalid phone numbers (Bangladesh format)
    SELECT COUNT(*) INTO issue_count FROM users WHERE phone_number IS NOT NULL AND phone_number !~ '^(\+880|01)[0-9]{9}$';
    RETURN QUERY SELECT 'phone_format'::text, 'users'::text, issue_count,
        CASE WHEN issue_count = 0 THEN 'PASS' ELSE 'FAIL' END::text;
    
    -- Check for order total calculations
    SELECT COUNT(*) INTO issue_count FROM orders o 
    WHERE o.total_price != (SELECT COALESCE(SUM(oi.total_price), 0) FROM order_items oi WHERE oi.order_id = o.id);
    RETURN QUERY SELECT 'order_calculation'::text, 'orders'::text, issue_count,
        CASE WHEN issue_count = 0 THEN 'PASS' ELSE 'FAIL' END::text;
END;
$$ LANGUAGE plpgsql;
```

#### 10.3 Test Migration Scripts
- Create migration testing procedures
- Test forward and rollback migrations
- Validate migration data transformations
- Test migration performance
- Create migration verification reports

```sql
-- Migration testing framework
CREATE OR REPLACE FUNCTION test_migration_integrity()
RETURNS TABLE(
    migration_name text,
    test_type text,
    result text,
    details text
) AS $$
BEGIN
    -- Test user table migration
    BEGIN
        -- Test that all required columns exist
        PERFORM 1 FROM information_schema.columns 
        WHERE table_name = 'users' AND column_name = 'email_verified';
        
        IF NOT FOUND THEN
            RETURN QUERY SELECT 'users_migration'::text, 'column_check'::text, 'FAIL'::text, 'Missing email_verified column';
        ELSE
            RETURN QUERY SELECT 'users_migration'::text, 'column_check'::text, 'PASS'::text, 'All required columns present';
        END IF;
        
        -- Test data integrity after migration
        PERFORM 1 FROM users WHERE email IS NULL OR email = '';
        
        IF FOUND THEN
            RETURN QUERY SELECT 'users_migration'::text, 'data_integrity'::text, 'FAIL'::text, 'Users with invalid email found';
        ELSE
            RETURN QUERY SELECT 'users_migration'::text, 'data_integrity'::text, 'PASS'::text, 'All user data valid';
        END IF;
    EXCEPTION WHEN OTHERS THEN
        RETURN QUERY SELECT 'users_migration'::text, 'exception'::text, 'ERROR'::text, SQLERRM;
    END;
    
    -- Similar tests for other migrated tables
END;
$$ LANGUAGE plpgsql;
```

#### 10.4 Validate Performance Benchmarks
- Create performance testing procedures
- Test query response times under load
- Validate indexing effectiveness
- Test concurrent user handling
- Create performance benchmark reports

```sql
-- Performance benchmark testing
CREATE OR REPLACE FUNCTION benchmark_performance()
RETURNS TABLE(
    test_name text,
    execution_time_ms numeric,
    benchmark_ms numeric,
    status text
) AS $$
DECLARE
    start_time TIMESTAMP;
    end_time TIMESTAMP;
    execution_time INTERVAL;
BEGIN
    -- Benchmark product search
    start_time := clock_timestamp();
    PERFORM COUNT(*) FROM products WHERE status = 'active' AND (to_tsvector('english', name_en) @@ to_tsquery('english', 'sweet'));
    end_time := clock_timestamp();
    execution_time := end_time - start_time;
    
    RETURN QUERY SELECT 'product_search'::text, 
        EXTRACT(MILLISECONDS FROM execution_time)::numeric,
        500::numeric, -- 500ms benchmark
        CASE WHEN EXTRACT(MILLISECONDS FROM execution_time) <= 500 THEN 'PASS' ELSE 'FAIL' END::text;
    
    -- Benchmark order lookup
    start_time := clock_timestamp();
    PERFORM * FROM orders WHERE customer_id = (SELECT id FROM users LIMIT 1) ORDER BY created_at DESC LIMIT 10;
    end_time := clock_timestamp();
    execution_time := end_time - start_time;
    
    RETURN QUERY SELECT 'order_lookup'::text,
        EXTRACT(MILLISECONDS FROM execution_time)::numeric,
        200::numeric, -- 200ms benchmark
        CASE WHEN EXTRACT(MILLISECONDS FROM execution_time) <= 200 THEN 'PASS' ELSE 'FAIL' END::text;
    
    -- Benchmark user activity query
    start_time := clock_timestamp();
    PERFORM COUNT(*) FROM user_activities WHERE user_id = (SELECT id FROM users LIMIT 1) AND created_at > NOW() - INTERVAL '30 days';
    end_time := clock_timestamp();
    execution_time := end_time - start_time;
    
    RETURN QUERY SELECT 'user_activity_query'::text,
        EXTRACT(MILLISECONDS FROM execution_time)::numeric,
        100::numeric, -- 100ms benchmark
        CASE WHEN EXTRACT(MILLISECONDS FROM execution_time) <= 100 THEN 'PASS' ELSE 'FAIL' END::text;
END;
$$ LANGUAGE plpgsql;
```

#### 10.5 Create Database Documentation
- Generate comprehensive database schema documentation
- Create entity relationship diagrams
- Document all indexes and constraints
- Create data dictionary
- Generate performance tuning guidelines

```sql
-- Database documentation generation
CREATE OR REPLACE FUNCTION generate_database_documentation()
RETURNS TABLE(
    documentation_type text,
    table_name text,
    documentation_content text
) AS $$
DECLARE
    table_record RECORD;
    column_record RECORD;
    index_record RECORD;
    constraint_record RECORD;
BEGIN
    -- Generate table documentation
    FOR table_record IN 
        SELECT table_name, table_type 
        FROM information_schema.tables 
        WHERE table_schema = 'public' AND table_type = 'BASE TABLE'
        ORDER BY table_name
    LOOP
        -- Table structure
        RETURN QUERY SELECT 'table_structure'::text, table_record.table_name::text,
            'Table: ' || table_record.table_name || ' (' || table_record.table_type || ')'::text;
        
        -- Column documentation
        FOR column_record IN 
            SELECT column_name, data_type, is_nullable, column_default
            FROM information_schema.columns
            WHERE table_name = table_record.table_name AND table_schema = 'public'
            ORDER BY ordinal_position
        LOOP
            RETURN QUERY SELECT 'column_definition'::text, table_record.table_name::text,
                column_record.column_name || ' ' || column_record.data_type || 
                CASE WHEN column_record.is_nullable = 'NO' THEN ' NOT NULL' ELSE ' NULLABLE' END ||
                CASE WHEN column_record.column_default IS NOT NULL THEN ' DEFAULT ' || column_record.column_default ELSE '' END::text;
        END LOOP;
        
        -- Index documentation
        FOR index_record IN 
            SELECT indexname, indexdef
            FROM pg_indexes
            WHERE tablename = table_record.table_name AND schemaname = 'public'
            ORDER BY indexname
        LOOP
            RETURN QUERY SELECT 'index_definition'::text, table_record.table_name::text,
                index_record.indexname || ': ' || index_record.indexdef::text;
        END LOOP;
    END LOOP;
END;
$$ LANGUAGE plpgsql;
```

### Acceptance Criteria for Validation
- All database relationships maintain referential integrity
- Data integrity constraints properly enforced
- Migration scripts execute without errors
- Performance benchmarks meet or exceed targets
- Comprehensive documentation generated

### Estimated Completion Time
- **Total Duration:** 1 day
- **Test Design:** 2 hours
- **Test Implementation:** 4 hours
- **Validation and Documentation:** 2 hours

### Required Resources
- Database testing framework
- Performance monitoring tools
- Load testing environment
- Documentation generation tools
- Test data generation scripts

### Validation Checkpoints and Testing Procedures
- Execute all relationship integrity tests
- Run data validation procedures
- Test migration scripts in development environment
- Conduct performance benchmarking
- Generate and review database documentation

### Technical Specifications
- **Testing Framework:** Custom PostgreSQL functions for validation
- **Performance Benchmarks:** Query response times under 100ms for critical operations
- **Documentation:** Auto-generated schema documentation
- **Validation Reports:** Comprehensive test result reports
- **Compliance:** Data integrity and security compliance verification

---

## CONCLUSION

This comprehensive Phase 3 implementation guide provides a structured approach to database design and implementation for the Saffron Sweets and Bakeries E-Commerce Platform. The ten sequential milestones cover all aspects of database development from initial schema design through performance optimization and testing.

Each milestone includes detailed implementation steps, acceptance criteria, and validation procedures to ensure high-quality database development. The design specifically addresses Bangladesh-specific requirements including multilingual support, local payment methods, and mobile network optimization.

Upon completion of Phase 3, the database foundation will be ready to support subsequent phases of development, providing a robust, scalable, and performant data layer for the entire e-commerce platform.

---

**Document Prepared By:** Database Architecture Team  
**Document Date:** January 2, 2026  
**Version:** 1.0  
**Status:** Ready for Implementation  
**Next Steps:** Begin Milestone 1 implementation