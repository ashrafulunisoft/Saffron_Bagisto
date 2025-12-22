# Bagisto Webkul Packages - Seeders and Factories Report

This document provides a comprehensive list of all seeders and factory files found in the Bagisto Webkul packages directory.

## Overview
- **Total Seeder Files**: 26
- **Total Factory Files**: 56
- **Location**: `/home/ashraful/UniSoft Ltd/Backend/saffron-backend-3/packages/Webkul/`

## Seeder Files

### Main Database Seeder
- `packages/Webkul/Installer/src/Database/Seeders/DatabaseSeeder.php`

### Attribute Seeders
- `packages/Webkul/Installer/src/Database/Seeders/Attribute/AttributeFamilyTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Attribute/AttributeGroupTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Attribute/AttributeOptionTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Attribute/AttributeTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Attribute/DatabaseSeeder.php`

### Category Seeders
- `packages/Webkul/Installer/src/Database/Seeders/Category/CategoryTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Category/DatabaseSeeder.php`

### CMS Seeders
- `packages/Webkul/Installer/src/Database/Seeders/CMS/CMSPagesTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/CMS/DatabaseSeeder.php`

### Core Seeders
- `packages/Webkul/Installer/src/Database/Seeders/Core/ChannelTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Core/ConfigTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Core/CountriesTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Core/CurrencyTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Core/DatabaseSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Core/LocalesTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Core/StatesTableSeeder.php`

### Customer Seeders
- `packages/Webkul/Installer/src/Database/Seeders/Customer/CustomerGroupTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Customer/DatabaseSeeder.php`

### Inventory Seeders
- `packages/Webkul/Installer/src/Database/Seeders/Inventory/DatabaseSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Inventory/InventorySourceTableSeeder.php`

### Product Seeders
- `packages/Webkul/Installer/src/Database/Seeders/ProductTableSeeder.php`

### Shop Seeders
- `packages/Webkul/Installer/src/Database/Seeders/Shop/DatabaseSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/Shop/ThemeCustomizationTableSeeder.php`

### SocialLogin Seeders
- `packages/Webkul/Installer/src/Database/Seeders/SocialLogin/CustomerSocialAccountTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/SocialLogin/DatabaseSeeder.php`

### User Seeders
- `packages/Webkul/Installer/src/Database/Seeders/User/AdminsTableSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/User/DatabaseSeeder.php`
- `packages/Webkul/Installer/src/Database/Seeders/User/RolesTableSeeder.php`

## Factory Files (Faker)

### Admin Package Factories
- `packages/Webkul/Admin/src/Database/Factories/CatalogRuleFactory.php`
- `packages/Webkul/Admin/src/Database/Factories/CurrencyExchangeRateFactory.php`
- `packages/Webkul/Admin/src/Database/Factories/ThemeFactory.php`

### Attribute Package Factories
- `packages/Webkul/Attribute/src/Database/Factories/AttributeFactory.php`
- `packages/Webkul/Attribute/src/Database/Factories/AttributeFamilyFactory.php`
- `packages/Webkul/Attribute/src/Database/Factories/AttributeOptionFactory.php`

### Category Package Factories
- `packages/Webkul/Category/src/Database/Factories/CategoryFactory.php`
- `packages/Webkul/Category/src/Database/Factories/CategoryTranslationFactory.php`

### Checkout Package Factories
- `packages/Webkul/Checkout/src/Database/Factories/CartAddressFactory.php`
- `packages/Webkul/Checkout/src/Database/Factories/CartFactory.php`
- `packages/Webkul/Checkout/src/Database/Factories/CartItemFactory.php`
- `packages/Webkul/Checkout/src/Database/Factories/CartPaymentFactory.php`
- `packages/Webkul/Checkout/src/Database/Factories/CartShippingRateFactory.php`

### CMS Package Factories
- `packages/Webkul/CMS/src/Database/Factories/PageFactory.php`
- `packages/Webkul/CMS/src/Database/Factories/PageTranslationFactory.php`

### Core Package Factories
- `packages/Webkul/Core/src/Database/Factories/CartRuleCouponFactory.php`
- `packages/Webkul/Core/src/Database/Factories/CartRuleCustomerGroupFactory.php`
- `packages/Webkul/Core/src/Database/Factories/CartRuleFactory.php`
- `packages/Webkul/Core/src/Database/Factories/ChannelFactory.php`
- `packages/Webkul/Core/src/Database/Factories/ChannelTranslationFactory.php`
- `packages/Webkul/Core/src/Database/Factories/CoreConfigFactory.php`
- `packages/Webkul/Core/src/Database/Factories/CurrencyFactory.php`
- `packages/Webkul/Core/src/Database/Factories/LocaleFactory.php`
- `packages/Webkul/Core/src/Database/Factories/SubscriberListFactory.php`

### Customer Package Factories
- `packages/Webkul/Customer/src/Database/Factories/CompareItemFactory.php`
- `packages/Webkul/Customer/src/Database/Factories/CustomerAddressFactory.php`
- `packages/Webkul/Customer/src/Database/Factories/CustomerFactory.php`
- `packages/Webkul/Customer/src/Database/Factories/CustomerGroupFactory.php`
- `packages/Webkul/Customer/src/Database/Factories/CustomerWishlistFactory.php`

### Inventory Package Factories
- `packages/Webkul/Inventory/src/Database/Factories/InventorySourceFactory.php`

### Marketing Package Factories
- `packages/Webkul/Marketing/src/Database/Factories/CampaignFactory.php`
- `packages/Webkul/Marketing/src/Database/Factories/EventFactory.php`
- `packages/Webkul/Marketing/src/Database/Factories/SearchSynonymFactory.php`
- `packages/Webkul/Marketing/src/Database/Factories/SearchTermsFactory.php`
- `packages/Webkul/Marketing/src/Database/Factories/SitemapFactory.php`
- `packages/Webkul/Marketing/src/Database/Factories/TemplateFactory.php`
- `packages/Webkul/Marketing/src/Database/Factories/UrlRewriteFactory.php`

### Product Package Factories
- `packages/Webkul/Product/src/Database/Factories/ProductAttributeValueFactory.php`
- `packages/Webkul/Product/src/Database/Factories/ProductBundleOptionProductFactory.php`
- `packages/Webkul/Product/src/Database/Factories/ProductBundleOptionsFactory.php`
- `packages/Webkul/Product/src/Database/Factories/ProductBundleOptionTranslationFactory.php`
- `packages/Webkul/Product/src/Database/Factories/ProductCustomerGroupPriceFactory.php`
- `packages/Webkul/Product/src/Database/Factories/ProductDownloadableLinkFactory.php`
- `packages/Webkul/Product/src/Database/Factories/ProductDownloadableLinkTranslationFactory.php`
- `packages/Webkul/Product/src/Database/Factories/ProductFactory.php`
- `packages/Webkul/Product/src/Database/Factories/ProductGroupedProductFactory.php`
- `packages/Webkul/Product/src/Database/Factories/ProductInventoryFactory.php`
- `packages/Webkul/Product/src/Database/Factories/ProductOrderedInventoryFactory.php`
- `packages/Webkul/Product/src/Database/Factories/ProductReviewAttachmentFactory.php`
- `packages/Webkul/Product/src/Database/Factories/ProductReviewFactory.php`

### Sales Package Factories
- `packages/Webkul/Sales/src/Database/Factories/InvoiceFactory.php`
- `packages/Webkul/Sales/src/Database/Factories/InvoiceItemFactory.php`
- `packages/Webkul/Sales/src/Database/Factories/OrderAddressFactory.php`
- `packages/Webkul/Sales/src/Database/Factories/OrderFactory.php`
- `packages/Webkul/Sales/src/Database/Factories/OrderItemFactory.php`
- `packages/Webkul/Sales/src/Database/Factories/OrderPaymentFactory.php`
- `packages/Webkul/Sales/src/Database/Factories/OrderTransactionFactory.php`
- `packages/Webkul/Sales/src/Database/Factories/RefundFactory.php`
- `packages/Webkul/Sales/src/Database/Factories/ShipmentFactory.php`

### Tax Package Factories
- `packages/Webkul/Tax/src/Database/Factories/TaxCategoryFactory.php`
- `packages/Webkul/Tax/src/Database/Factories/TaxMapFactory.php`
- `packages/Webkul/Tax/src/Database/Factories/TaxRateFactory.php`

### User Package Factories
- `packages/Webkul/User/src/Database/Factories/AdminFactory.php`
- `packages/Webkul/User/src/Database/Factories/RoleFactory.php`

## Key Findings

1. **All seeders are located in the Installer package**: All seeder files are concentrated in `packages/Webkul/Installer/src/Database/Seeders/` directory, organized by module.

2. **Factories are distributed across packages**: Each Webkul package has its own `src/Database/Factories/` directory with relevant factory files.

3. **No seeders found in other packages**: The Installer package is the only location for seeder files in the Webkul packages structure.

4. **Comprehensive coverage**: The seeders and factories cover all major Bagisto modules including:
   - Core functionality (channels, currencies, locales)
   - Product management
   - Customer management
   - Sales and orders
   - CMS and content
   - Marketing features
   - Tax and inventory

## Usage

### Running Seeders
Seeders are typically run during installation via the Installer package's web interface or console commands.

### Using Factories
Factories can be used in testing or development to generate sample data using Laravel's Faker library.

---

*Report generated on: 2025-12-22*
*Project: Saffron Backend 3 (Bagisto-based e-commerce platform)*
