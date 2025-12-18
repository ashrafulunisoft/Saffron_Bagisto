# COMPREHENSIVE TECHNOLOGY STACK RECOMMENDATIONS
## Saffron Bakery & Dairy E-Commerce Platform

**Project:** Saffron Bakery & Dairy Enterprise Website  
**Document Version:** 1.0  
**Date:** December 2, 2025  
**Prepared By:** Technical Architecture Team  
**Document Status:** Final Recommendations

---

## EXECUTIVE SUMMARY

This document provides comprehensive technology stack recommendations for the Saffron Bakery & Dairy e-commerce platform, specifically designed to enable 100% fulfillment of all requirements specified in the User Requirements Document (URD) and Software Requirements Specification (SRS). These recommendations address the unique challenges of the Bangladesh market while optimizing for solo developer workflow efficiency.

### Key Recommendations

- **Frontend Framework:** Next.js 14+ with React 18+ for optimal performance and SEO
- **Backend Framework:** NestJS with Node.js 20 LTS for enterprise-grade architecture
- **Database:** PostgreSQL 15+ with Redis 7+ for data integrity and caching
- **Development Environment:** Linux OS with VS Code, MCP server integration, and advanced HMR
- **Deployment:** Vercel (frontend) + DigitalOcean (backend) with Cloudflare CDN
- **Bangladesh-Specific:** Native integration with bKash, Nagad, Rocket, and SSLCommerz
- **Solo Developer Optimizations:** MCP server for AI assistance, advanced debugging tools, automated workflows

---

## TABLE OF CONTENTS

1. [Complete Technology Stack Specification](#1-complete-technology-stack-specification)
2. [Solo Developer Environment Setup](#2-solo-developer-environment-setup)
3. [Development Workflow Optimization](#3-development-workflow-optimization)
4. [Bangladesh-Specific Implementation](#4-bangladesh-specific-implementation)
5. [Deployment Strategy](#5-deployment-strategy)
6. [Performance and Security Optimization](#6-performance-and-security-optimization)

---

## 1. COMPLETE TECHNOLOGY STACK SPECIFICATION

### 1.1 Frontend Technologies

#### Core Framework
- **Next.js 14+**
  - Server-Side Rendering (SSR) for SEO optimization
  - Static Site Generation (SSG) for static pages
  - Incremental Static Regeneration (ISR) for dynamic content
  - Built-in image optimization and internationalization
  - API routes for backend-for-frontend pattern

#### UI Framework and Styling
- **Tailwind CSS 3.4+**
  - Utility-first CSS framework for rapid development
  - Highly optimized for production (purges unused styles)
  - Excellent responsive design capabilities
  - Easy customization for Saffron brand colors

- **Headless UI Components**
  - Radix UI for complex components (dropdowns, modals, etc.)
  - Custom component library for Saffron-specific elements
  - Consistent design system across all pages

#### State Management
- **Zustand 4.4+**
  - Lightweight state management (1KB vs 15KB for Redux)
  - TypeScript support for type safety
  - Persistent middleware for cart and user preferences
  - Simple API for rapid development

#### Form Handling
- **React Hook Form 7.47+**
  - Performance-optimized form handling
  - Minimal re-renders for better UX
  - Built-in validation integration
  - Perfect for complex checkout and registration forms

- **Zod 3.22+**
  - TypeScript-first schema validation
  - Type-safe form validation
  - Excellent for API request/response validation

#### Animation and Interactions
- **Framer Motion 10.16+**
  - Smooth page transitions
  - Product image animations
  - Cart animations
  - Micro-interactions for enhanced UX

#### Frontend Build Tools
- **Vite 5.0+**
  - Extremely fast development server
  - Hot Module Replacement (HMR) for instant updates
  - Optimized production builds
  - TypeScript and JSX support out of the box

- **SWC Compiler**
  - Rust-based compiler for faster builds
  - Integrated with Next.js for optimal performance
  - Faster than Babel for TypeScript compilation

### 1.2 Backend Technologies

#### Core Framework
- **NestJS 10.2+**
  - Progressive Node.js framework for enterprise applications
  - TypeScript-first architecture
  - Built-in dependency injection
  - Modular structure for maintainability
  - Excellent documentation and community support

#### Runtime Environment
- **Node.js 20 LTS**
  - Long-term support for stability
  - Performance improvements over previous versions
  - Excellent ES module support
  - Compatible with all required packages

#### API Architecture
- **RESTful API with OpenAPI/Swagger Documentation**
  - Standardized API endpoints
  - Auto-generated documentation
  - Request/response validation
  - Easy testing with Swagger UI

- **GraphQL Support (Optional for Phase 2)**
  - Apollo Server integration
  - Type-safe GraphQL queries
  - Efficient data fetching for mobile apps

#### Authentication & Security
- **Passport.js with JWT Strategy**
  - Secure authentication system
  - Multiple authentication providers (local, social)
  - JWT token management
  - Session management with Redis

- **bcrypt for Password Hashing**
  - Industry-standard password hashing
  - Configurable cost factor (recommended: 12)
  - Protection against rainbow table attacks

#### Background Jobs
- **Bull Queue with Redis**
  - Reliable job processing
  - Job retries and error handling
  - Priority queues for different tasks
  - Dashboard for monitoring

#### File Upload & Processing
- **Multer for File Uploads**
  - Multi-part form data handling
  - File type validation
  - Integration with cloud storage

- **Sharp for Image Processing**
  - High-performance image resizing
  - Multiple format generation (WebP, AVIF)
  - Automatic optimization

### 1.3 Database Technologies

#### Primary Database
- **PostgreSQL 15+**
  - ACID compliance for transaction integrity
  - JSONB support for flexible product attributes
  - Full-text search capabilities
  - Excellent performance for complex queries
  - Advanced indexing options

#### Database Configuration
```sql
-- Recommended PostgreSQL configuration for e-commerce
-- postgresql.conf

# Memory Settings
shared_buffers = 256MB
effective_cache_size = 1GB
work_mem = 4MB
maintenance_work_mem = 64MB

# Connection Settings
max_connections = 200
shared_preload_libraries = 'pg_stat_statements'

# WAL Settings
wal_buffers = 16MB
checkpoint_completion_target = 0.9
wal_writer_delay = 200ms

# Query Optimization
random_page_cost = 1.1
effective_io_concurrency = 200
```

#### Database Schema Optimization
- **Partitioning for Large Tables**
  - Orders table partitioned by date
  - Analytics tables partitioned by month
  - Improves query performance for large datasets

- **Indexing Strategy**
  - B-tree indexes for most queries
  - GIN indexes for JSONB and full-text search
  - Partial indexes for common query patterns

#### Caching Layer
- **Redis 7+**
  - In-memory data structure store
  - Session management
  - Query result caching
  - Rate limiting
  - Job queue backend

#### Redis Configuration
```conf
# redis.conf

# Memory Management
maxmemory 512mb
maxmemory-policy allkeys-lru

# Persistence
save 900 1
save 300 10
save 60 10000

# Network
tcp-keepalive 300
timeout 0

# Security
requirepass your_strong_password
```

### 1.4 Development Tools and Extensions

#### Version Control
- **Git with GitHub**
  - Distributed version control
  - Issue tracking and project management
  - Actions for CI/CD
  - Code review with pull requests

#### Code Editor
- **Visual Studio Code**
  - Lightweight but powerful editor
  - Excellent TypeScript support
  - Rich extension ecosystem
  - Integrated terminal and debugger

#### Essential VS Code Extensions
```json
{
  "recommendations": [
    "ms-vscode.vscode-typescript-next",
    "bradlc.vscode-tailwindcss",
    "esbenp.prettier-vscode",
    "dbaeumer.vscode-eslint",
    "ms-vscode.vscode-json",
    "formulahendry.auto-rename-tag",
    "christian-kohler.path-intellisense",
    "ms-vscode.vscode-thunder-client",
    "humao.rest-client",
    "ms-vscode-remote.remote-containers",
    "github.copilot",
    "ms-vscode.vscode-docker",
    "ms-vscode.vscode-eslint"
  ]
}
```

#### Package Management
- **pnpm 8.0+**
  - Fast, disk space efficient package manager
  - Strict dependency management
  - Monorepo support for future scaling
  - Better than npm/yarn for most use cases

#### Code Quality Tools
- **ESLint with TypeScript support**
  - Code quality enforcement
  - Consistent coding style
  - Custom rules for project needs

- **Prettier**
  - Consistent code formatting
  - Automatic formatting on save
  - Integration with ESLint

- **Husky for Git Hooks**
  - Pre-commit hooks for code quality
  - Automated testing before commits
  - Consistent commit messages

### 1.5 Testing and Quality Assurance Tools

#### Frontend Testing
- **Jest 29+**
  - JavaScript testing framework
  - Zero configuration setup
  - Mocking capabilities
  - Snapshot testing for UI components

- **React Testing Library 13+**
  - Component testing utilities
  - Focus on user behavior testing
  - Accessibility testing support

- **Playwright 1.40+**
  - End-to-end testing
  - Cross-browser testing
  - Mobile testing emulation
  - Visual regression testing

#### Backend Testing
- **Jest with Supertest**
  - API endpoint testing
  - Request/response validation
  - Database transaction testing

- **Test Containers**
  - Database testing with real PostgreSQL
  - Consistent test environment
  - Parallel test execution

#### Performance Testing
- **Lighthouse CI**
  - Automated performance testing
  - Performance budgets enforcement
  - Regression detection

- **Artillery**
  - Load testing for API endpoints
  - Concurrent user simulation
  - Performance bottleneck identification

### 1.6 Deployment and Infrastructure Tools

#### Containerization
- **Docker with Multi-stage Builds**
  - Consistent deployment environment
  - Optimized image sizes
  - Easy scaling and orchestration

#### Infrastructure as Code
- **Docker Compose for Local Development**
  - Complete development environment
  - Database and cache services
  - Easy setup for new developers

- **Terraform (Future for Cloud Infrastructure)**
  - Infrastructure automation
  - Version-controlled infrastructure
  - Disaster recovery setup

#### Monitoring and Logging
- **Winston for Structured Logging**
  - Multiple log levels
  - Different output formats
  - Integration with log aggregation services

- **Sentry for Error Tracking**
  - Real-time error monitoring
  - Stack trace collection
  - Performance monitoring
  - Release tracking

---

## 2. SOLO DEVELOPER ENVIRONMENT SETUP

### 2.1 Linux OS Configuration and Optimizations

#### Recommended Distribution
- **Ubuntu 22.04 LTS or 23.04**
  - Long-term support and stability
  - Excellent package management
  - Large community and documentation
  - Compatible with all development tools

#### System Requirements
- **Minimum Specifications:**
  - CPU: 4 cores (8 threads recommended)
  - RAM: 16GB (32GB recommended for large projects)
  - Storage: 512GB SSD (1TB recommended)
  - Network: Stable broadband connection

#### Essential System Packages
```bash
# Update system packages
sudo apt update && sudo apt upgrade -y

# Install development essentials
sudo apt install -y build-essential git curl wget

# Install Node.js via NodeSource (latest LTS)
curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
sudo apt-get install -y nodejs

# Install pnpm
npm install -g pnpm

# Install Docker
sudo apt-get install -y ca-certificates curl gnupg
sudo install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update
sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Add user to docker group
sudo usermod -aG docker $USER

# Install PostgreSQL for local development
sudo apt install -y postgresql postgresql-contrib

# Install Redis for local development
sudo apt install -y redis-server

# Install useful development tools
sudo apt install -y htop tree neofetch
```

#### System Optimization
```bash
# Increase file watcher limits for development
echo fs.inotify.max_user_watches=524288 | sudo tee -a /etc/sysctl.conf
sudo sysctl -p

# Optimize PostgreSQL for development
sudo -u postgres psql -c "ALTER SYSTEM SET shared_buffers = '256MB';"
sudo -u postgres psql -c "ALTER SYSTEM SET effective_cache_size = '1GB';"
sudo -u postgres pg_ctl reload

# Configure Redis for development
sudo sed -i 's/supervised no/supervised systemd/' /etc/redis/redis.conf
sudo systemctl restart redis
```

### 2.2 VS Code Setup with Essential Extensions

#### VS Code Configuration
```json
// .vscode/settings.json
{
  "editor.formatOnSave": true,
  "editor.defaultFormatter": "esbenp.prettier-vscode",
  "editor.codeActionsOnSave": {
    "source.fixAll.eslint": true
  },
  "typescript.preferences.importModuleSpecifier": "relative",
  "emmet.includeLanguages": {
    "typescript": "html",
    "typescriptreact": "html"
  },
  "files.associations": {
    "*.css": "tailwindcss"
  },
  "tailwindCSS.includeLanguages": [
    "html",
    "javascript",
    "typescript",
    "typescriptreact",
    "javascriptreact"
  ],
  "tailwindCSS.experimental.classRegex": [
    ["clsx\\(([^)]*)\\)", "(?:'|\"|`)([^']*)(?:'|\"|`)"]
  ],
  "search.exclude": {
    "**/node_modules": true,
    "**/dist": true,
    "**/build": true,
    "**/.next": true,
    "**/.git": true
  }
}
```

#### Recommended VS Code Extensions
```json
{
  "recommendations": [
    "ms-vscode.vscode-typescript-next",
    "bradlc.vscode-tailwindcss",
    "esbenp.prettier-vscode",
    "dbaeumer.vscode-eslint",
    "ms-vscode.vscode-json",
    "formulahendry.auto-rename-tag",
    "christian-kohler.path-intellisense",
    "humao.rest-client",
    "ms-vscode.vscode-docker",
    "github.copilot",
    "github.vscode-pull-request-github",
    "ms-vscode.vscode-thunder-client",
    "ms-vscode-remote.remote-containers",
    "eamodio.gitlens",
    "streetsidesoftware.code-spell-checker",
    "yzhang.markdown-all-in-one",
    "ms-vscode.test-adapter-converter",
    "hbenl.vscode-test-explorer",
    "ms-vscode.vscode-live-server"
  ]
}
```

#### VS Code Tasks Configuration
```json
// .vscode/tasks.json
{
  "version": "2.0.0",
  "tasks": [
    {
      "label": "Start Frontend Dev",
      "type": "shell",
      "command": "pnpm dev",
      "options": {
        "cwd": "${workspaceFolder}/frontend"
      },
      "group": "build",
      "presentation": {
        "echo": true,
        "reveal": "always",
        "focus": false,
        "panel": "new"
      },
      "problemMatcher": []
    },
    {
      "label": "Start Backend Dev",
      "type": "shell",
      "command": "pnpm start:dev",
      "options": {
        "cwd": "${workspaceFolder}/backend"
      },
      "group": "build",
      "presentation": {
        "echo": true,
        "reveal": "always",
        "focus": false,
        "panel": "new"
      },
      "problemMatcher": []
    },
    {
      "label": "Start All Services",
      "dependsOrder": "parallel",
      "dependsOn": [
        "Start Frontend Dev",
        "Start Backend Dev"
      ],
      "group": "build"
    }
  ]
}
```

### 2.3 MCP Server Configuration for AI-Assisted Development

#### MCP Server Setup
```bash
# Install MCP server
npm install -g @modelcontextprotocol/server

# Initialize MCP configuration
mcp init

# Configure MCP for Saffron project
cat > mcp.config.json << EOF
{
  "name": "saffron-bakery-mcp",
  "version": "1.0.0",
  "description": "MCP server for Saffron Bakery e-commerce development",
  "tools": [
    {
      "name": "database-schema",
      "description": "Get database schema information",
      "parameters": {
        "table": {
          "type": "string",
          "description": "Table name to query"
        }
      }
    },
    {
      "name": "api-endpoints",
      "description": "Get available API endpoints",
      "parameters": {
        "module": {
          "type": "string",
          "description": "API module to query"
        }
      }
    },
    {
      "name": "component-generator",
      "description": "Generate React components based on specifications",
      "parameters": {
        "type": {
          "type": "string",
          "description": "Component type (product-card, button, etc.)"
        },
        "props": {
          "type": "object",
          "description": "Component properties"
        }
      }
    }
  ]
}
EOF
```

#### MCP Integration with VS Code
```json
// .vscode/settings.json MCP integration
{
  "mcp.server.enabled": true,
  "mcp.server.config": "${workspaceFolder}/mcp.config.json",
  "mcp.server.autoStart": true,
  "mcp.ai.assistant": "github-copilot"
}
```

### 2.4 Local Database Server Setup and Configuration

#### PostgreSQL Setup
```bash
# Create development database
sudo -u postgres createdb saffron_dev

# Create development user
sudo -u postgres psql -c "CREATE USER saffron_dev WITH PASSWORD 'dev_password';"
sudo -u postgres psql -c "GRANT ALL PRIVILEGES ON DATABASE saffron_dev TO saffron_dev;"

# Configure PostgreSQL for development
sudo nano /etc/postgresql/15/main/postgresql.conf
```

#### PostgreSQL Development Configuration
```conf
# postgresql.conf (development settings)

# Connection Settings
listen_addresses = 'localhost'
port = 5432
max_connections = 100

# Memory Settings (development)
shared_buffers = 128MB
effective_cache_size = 512MB
work_mem = 4MB
maintenance_work_mem = 64MB

# WAL Settings (development)
wal_buffers = 4MB
checkpoint_completion_target = 0.7
wal_writer_delay = 200ms
max_wal_size = 1GB

# Query Planning
random_page_cost = 1.1
effective_io_concurrency = 100

# Logging (development)
log_statement = 'all'
log_min_duration_statement = 0
log_line_prefix = '%t [%p]: [%l-1] user=%u,db=%d,app=%a,client=%h '

# Autovacuum (development)
autovacuum = on
autovacuum_naptime = 10s
```

#### Database Migration Setup
```typescript
// backend/src/database/migrations/migration.config.ts
import { DataSource } from 'typeorm';
import { config } from 'dotenv';

config({ path: '.env.development' });

export const AppDataSource = new DataSource({
  type: 'postgres',
  host: process.env.DB_HOST || 'localhost',
  port: parseInt(process.env.DB_PORT || '5432'),
  username: process.env.DB_USERNAME || 'saffron_dev',
  password: process.env.DB_PASSWORD || 'dev_password',
  database: process.env.DB_NAME || 'saffron_dev',
  entities: ['src/**/*.entity.ts'],
  migrations: ['src/database/migrations/*.ts'],
  synchronize: false, // Use migrations instead
  logging: true, // Enable SQL logging in development
});
```

#### Redis Setup for Development
```conf
# redis.conf (development settings)

# Network
bind 127.0.0.1
port 6379
timeout 0
tcp-keepalive 300

# Memory (development)
maxmemory 256mb
maxmemory-policy allkeys-lru

# Persistence (development - disabled for speed)
save ""

# Logging (development)
loglevel notice
logfile ""

# Security (development - local only)
# requirepass dev_redis_password
```

### 2.5 Local Development Server with Advanced HMR

#### Next.js Configuration with Advanced HMR
```javascript
// next.config.js
/** @type {import('next').NextConfig} */
const nextConfig = {
  reactStrictMode: true,
  swcMinify: true,
  
  // Advanced HMR Configuration
  webpack: (config, { dev, isServer }) => {
    if (dev && !isServer) {
      // Enable React Fast Refresh
      config.resolve.alias = {
        ...config.resolve.alias,
        'react-dom': '@hot-loader/react-dom',
      };
      
      // Custom webpack plugins for HMR
      config.plugins.push(
        new webpack.HotModuleReplacementPlugin(),
        new webpack.NoEmitOnErrorsPlugin()
      );
    }
    
    return config;
  },
  
  // Experimental features for better HMR
  experimental: {
    optimizeCss: true,
    optimizePackageImports: ['lucide-react', '@headlessui/react'],
    turbo: {
      rules: {
        '*.svg': {
          loaders: ['@svgr/webpack'],
          as: '*.js',
        },
      },
    },
  },
  
  // Image optimization
  images: {
    domains: ['localhost', 'your-cdn-domain.com'],
    formats: ['image/avif', 'image/webp'],
    deviceSizes: [640, 750, 828, 1080, 1200, 1920, 2048],
    imageSizes: [16, 32, 48, 64, 96, 128, 256, 384],
  },
  
  // Internationalization
  i18n: {
    locales: ['bn', 'en'],
    defaultLocale: 'bn',
    localeDetection: true,
  },
  
  // PWA Configuration
  pwa: {
    dest: 'public',
    register: true,
    skipWaiting: true,
  },
};

module.exports = nextConfig;
```

#### NestJS Configuration with HMR
```typescript
// backend/src/main.ts
import { NestFactory } from '@nestjs/core';
import { AppModule } from './app.module';
import { ValidationPipe } from '@nestjs/common';
import { DocumentBuilder, SwaggerModule } from '@nestjs/swagger';

async function bootstrap() {
  const app = await NestFactory.create(AppModule, {
    // Enable hot module replacement
    logger: ['error', 'warn', 'debug', 'log', 'verbose'],
  });

  // Global validation pipe
  app.useGlobalPipes(
    new ValidationPipe({
      whitelist: true,
      forbidNonWhitelisted: true,
      transform: true,
    }),
  );

  // CORS configuration for development
  app.enableCors({
    origin: ['http://localhost:3000', 'http://localhost:3001'],
    credentials: true,
  });

  // API documentation
  const config = new DocumentBuilder()
    .setTitle('Saffron Bakery API')
    .setDescription('API documentation for Saffron Bakery e-commerce platform')
    .setVersion('1.0')
    .build();
  
  const document = SwaggerModule.createDocument(app, config);
  SwaggerModule.setup('api/docs', app, document);

  await app.listen(process.env.PORT || 3001);
}

bootstrap();
```

### 2.6 Browser Preview Capabilities and Debugging Tools

#### Browser Preview Setup
```json
// .vscode/launch.json
{
  "version": "0.2.0",
  "configurations": [
    {
      "name": "Launch Chrome against localhost",
      "type": "chrome",
      "request": "launch",
      "url": "http://localhost:3000",
      "webRoot": "${workspaceFolder}/frontend/src",
      "sourceMaps": true,
      "userDataDir": "${workspaceFolder}/.vscode/chrome-debug",
      "runtimeArgs": [
        "--disable-web-security",
        "--disable-features=TranslateUI",
        "--disable-ipc-flooding-protection",
        "--enable-precise-memory-info",
        "--js-flags=--expose-gc"
      ]
    },
    {
      "name": "Attach to Chrome",
      "type": "chrome",
      "request": "attach",
      "port": 9222,
      "webRoot": "${workspaceFolder}/frontend/src",
      "sourceMaps": true
    }
  ],
  "compounds": [
    {
      "name": "Launch Full Stack",
      "configurations": ["Launch Chrome against localhost"],
      "stopAll": true
    }
  ]
}
```

#### Advanced Debugging Configuration
```typescript
// frontend/next.config.js - Debug configuration
const nextConfig = {
  webpack: (config, { dev }) => {
    if (dev) {
      // Enable source maps for debugging
      config.devtool = 'eval-source-map';
      
      // React Developer Tools
      config.resolve.alias = {
        ...config.resolve.alias,
        'react': 'react/cjs/react.development.js',
        'react-dom': 'react-dom/cjs/react-dom.development.js',
      };
    }
    
    return config;
  },
};
```

#### Browser Extensions for Development
```json
{
  "recommended_extensions": [
    "React Developer Tools",
    "Redux DevTools",
    "Tailwind CSS DevTools",
    "Lighthouse",
    "Wappalyzer",
    "Cookie Editor",
    "JSON Viewer",
    "Postman Interceptor",
    "Network Monitor",
    "Performance Monitor"
  ]
}
```

---

## 3. DEVELOPMENT WORKFLOW OPTIMIZATION

### 3.1 Vite Build Tool Configuration

#### Vite Configuration for Next.js Integration
```typescript
// vite.config.ts
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import { resolve } from 'path';

export default defineConfig({
  plugins: [react()],
  
  // Resolve configuration
  resolve: {
    alias: {
      '@': resolve(__dirname, './src'),
      '@components': resolve(__dirname, './src/components'),
      '@pages': resolve(__dirname, './src/pages'),
      '@styles': resolve(__dirname, './src/styles'),
      '@utils': resolve(__dirname, './src/utils'),
      '@types': resolve(__dirname, './src/types'),
    },
  },
  
  // Development server configuration
  server: {
    port: 3000,
    host: true, // Expose to network for mobile testing
    cors: true,
    hmr: {
      overlay: true, // Show error overlay
    },
  },
  
  // Build configuration
  build: {
    outDir: 'dist',
    sourcemap: true, // Generate source maps
    minify: 'terser',
    terserOptions: {
      compress: {
        drop_console: true, // Remove console.log in production
      },
    },
    rollupOptions: {
      output: {
        manualChunks: {
          vendor: ['react', 'react-dom'],
          router: ['next/router'],
          ui: ['@headlessui/react', 'framer-motion'],
        },
      },
    },
  },
  
  // CSS configuration
  css: {
    postcss: {
      plugins: [
        require('tailwindcss'),
        require('autoprefixer'),
      ],
    },
    modules: {
      localsConvention: 'camelCase',
    },
  },
  
  // Optimization
  optimizeDeps: {
    include: [
      'react',
      'react-dom',
      'next',
      '@headlessui/react',
      'framer-motion',
      'zustand',
    ],
  },
});
```

#### Advanced HMR Configuration
```typescript
// vite.config.ts - Advanced HMR
export default defineConfig({
  server: {
    hmr: {
      overlay: true,
      port: 24678, // Custom HMR port
    },
    watch: {
      usePolling: true, // Required for some file systems
      interval: 100, // Polling interval
    },
  },
  
  plugins: [
    react({
      // Fast Refresh configuration
      fastRefresh: true,
      jsxImportSource: '@emotion/react',
    }),
    
    // Custom HMR plugin for state persistence
    {
      name: 'state-persistence',
      handleHotUpdate({ file, modules }) {
        if (file.includes('store/')) {
          console.log('Store updated, preserving state...');
          // Logic to preserve state during HMR
        }
      },
    },
  ],
});
```

### 3.2 Hot Module Replacement for Frontend and Backend

#### Frontend HMR with State Preservation
```typescript
// frontend/src/utils/hmr.ts
import { useEffect, useRef } from 'react';

export function useHMRStatePersistence<T>(key: string, initialState: T): [T, (state: T) => void] {
  const stateRef = useRef<T>(initialState);
  
  useEffect(() => {
    // Store state before HMR
    if (import.meta.hot) {
      import.meta.hot.on('vite:beforeUpdate', () => {
        localStorage.setItem(`hmr-state-${key}`, JSON.stringify(stateRef.current));
      });
      
      // Restore state after HMR
      import.meta.hot.on('vite:afterUpdate', () => {
        const savedState = localStorage.getItem(`hmr-state-${key}`);
        if (savedState) {
          stateRef.current = JSON.parse(savedState);
          localStorage.removeItem(`hmr-state-${key}`);
        }
      });
    }
  }, [key]);
  
  return [stateRef.current, (newState: T) => {
    stateRef.current = newState;
  }];
}
```

#### Backend HMR Configuration
```typescript
// backend/src/hmr/hmr.config.ts
import { NestFactory } from '@nestjs/core';
import { AppModule } from '../app.module';

let app: any;

async function bootstrap() {
  app = await NestFactory.create(AppModule);
  
  // Enable HMR for development
  if (process.env.NODE_ENV === 'development') {
    const webpack = require('webpack');
    const webpackConfig = require('../../webpack.config.js');
    
    const compiler = webpack(webpackConfig);
    
    compiler.watch({}, (err: any, stats: any) => {
      if (err) {
        console.error(err);
        return;
      }
      
      console.log('Backend recompiled successfully');
      
      // Hot reload logic without server restart
      if (app && app.getHttpServer) {
        // Clear require cache
        Object.keys(require.cache).forEach(key => {
          delete require.cache[key];
        });
        
        // Reinitialize modified modules
        console.log('Backend hot reloaded');
      }
    });
  }
  
  await app.listen(process.env.PORT || 3001);
}

// Handle HMR
if (module.hot) {
  module.hot.accept();
  module.hot.dispose(() => {
    if (app && app.close) {
      app.close();
    }
  });
}

bootstrap();
```

### 3.3 Automated Testing Workflows for Solo Developers

#### GitHub Actions for Automated Testing
```yaml
# .github/workflows/test.yml
name: Automated Testing

on:
  push:
    branches: [main, develop]
  pull_request:
    branches: [main, develop]

jobs:
  frontend-tests:
    runs-on: ubuntu-latest
    
    steps:
      - name: Checkout code
        uses: actions/checkout@v4
      
      - name: Setup Node.js
        uses: actions/setup-node@v4
        with:
          node-version: '20'
          cache: 'pnpm'
      
      - name: Install dependencies
        run: |
          cd frontend
          pnpm install
      
      - name: Run linting
        run: |
          cd frontend
          pnpm lint
      
      - name: Run type checking
        run: |
          cd frontend
          pnpm type-check
      
      - name: Run unit tests
        run: |
          cd frontend
          pnpm test:unit
      
      - name: Run integration tests
        run: |
          cd frontend
          pnpm test:integration
      
      - name: Run E2E tests
        run: |
          cd frontend
          pnpm test:e2e
      
      - name: Upload coverage reports
        uses: codecov/codecov-action@v3
        with:
          file: ./frontend/coverage/lcov.info

  backend-tests:
    runs-on: ubuntu-latest
    
    services:
      postgres:
        image: postgres:15
        env:
          POSTGRES_PASSWORD: test_password
          POSTGRES_USER: test_user
          POSTGRES_DB: test_db
        options: >-
          --health-cmd pg_isready
          --health-interval 10s
          --health-timeout 5s
          --health-retries 5
        ports:
          - 5432:5432
      
      redis:
        image: redis:7
        options: >-
          --health-cmd "redis-cli ping"
          --health-interval 10s
          --health-timeout 5s
          --health-retries 5
        ports:
          - 6379:6379
    
    steps:
      - name: Checkout code
        uses: actions/checkout@v4
      
      - name: Setup Node.js
        uses: actions/setup-node@v4
        with:
          node-version: '20'
          cache: 'pnpm'
      
      - name: Install dependencies
        run: |
          cd backend
          pnpm install
      
      - name: Run database migrations
        run: |
          cd backend
          pnpm migration:run
        env:
          DATABASE_URL: postgresql://test_user:test_password@localhost:5432/test_db
      
      - name: Run linting
        run: |
          cd backend
          pnpm lint
      
      - name: Run unit tests
        run: |
          cd backend
          pnpm test:unit
      
      - name: Run integration tests
        run: |
          cd backend
          pnpm test:integration
      
      - name: Run API tests
        run: |
          cd backend
          pnpm test:api
```

#### Local Testing Scripts
```json
// package.json scripts
{
  "scripts": {
    "test": "jest",
    "test:watch": "jest --watch",
    "test:coverage": "jest --coverage",
    "test:frontend": "cd frontend && pnpm test",
    "test:backend": "cd backend && pnpm test",
    "test:e2e": "playwright test",
    "test:e2e:headed": "playwright test --headed",
    "test:performance": "lighthouse http://localhost:3000 --output=html --output-path=./reports",
    "test:all": "pnpm test:frontend && pnpm test:backend && pnpm test:e2e"
  }
}
```

### 3.4 Code Quality Automation

#### Pre-commit Hooks Configuration
```json
// package.json
{
  "husky": {
    "hooks": {
      "pre-commit": "lint-staged",
      "pre-push": "pnpm test:unit && pnpm type-check"
    }
  },
  "lint-staged": {
    "*.{js,jsx,ts,tsx}": [
      "eslint --fix",
      "prettier --write",
      "git add"
    ],
    "*.{css,scss}": [
      "prettier --write",
      "stylelint --fix",
      "git add"
    ],
    "*.{json,md}": [
      "prettier --write",
      "git add"
    ]
  }
}
```

#### ESLint Configuration
```json
// .eslintrc.json
{
  "extends": [
    "next/core-web-vitals",
    "@typescript-eslint/recommended",
    "prettier"
  ],
  "parser": "@typescript-eslint/parser",
  "plugins": ["@typescript-eslint", "import"],
  "rules": {
    "import/order": "error",
    "import/no-unresolved": "error",
    "@typescript-eslint/no-unused-vars": "error",
    "@typescript-eslint/explicit-function-return-type": "warn",
    "prefer-const": "error",
    "no-var": "error",
    "no-console": "warn",
    "react-hooks/exhaustive-deps": "warn"
  },
  "settings": {
    "import/resolver": {
      "typescript": {
        "alwaysTryTypes": true
      }
    }
  }
}
```

#### Prettier Configuration
```json
// .prettierrc.json
{
  "semi": true,
  "trailingComma": "es5",
  "singleQuote": true,
  "printWidth": 80,
  "tabWidth": 2,
  "useTabs": false,
  "bracketSpacing": true,
  "arrowParens": "avoid",
  "endOfLine": "lf"
}
```

### 3.5 Debugging and Monitoring Tools

#### VS Code Debugging Configuration
```json
// .vscode/launch.json
{
  "version": "0.2.0",
  "configurations": [
    {
      "name": "Debug Frontend",
      "type": "node",
      "request": "launch",
      "program": "${workspaceFolder}/frontend/node_modules/.bin/next",
      "args": ["dev"],
      "cwd": "${workspaceFolder}/frontend",
      "runtimeArgs": ["--inspect"],
      "env": {
        "NODE_OPTIONS": "--inspect"
      },
      "console": "integratedTerminal",
      "internalConsoleOptions": "neverOpen"
    },
    {
      "name": "Debug Backend",
      "type": "node",
      "request": "launch",
      "program": "${workspaceFolder}/backend/src/main.ts",
      "cwd": "${workspaceFolder}/backend",
      "runtimeArgs": ["-r", "ts-node/register"],
      "env": {
        "NODE_ENV": "development"
      },
      "console": "integratedTerminal",
      "internalConsoleOptions": "neverOpen"
    },
    {
      "name": "Debug Tests",
      "type": "node",
      "request": "launch",
      "program": "${workspaceFolder}/node_modules/.bin/jest",
      "args": ["--runInBand"],
      "cwd": "${workspaceFolder}",
      "console": "integratedTerminal",
      "internalConsoleOptions": "neverOpen"
    }
  ]
}
```

#### Performance Monitoring Setup
```typescript
// frontend/src/utils/performance.ts
export class PerformanceMonitor {
  static measurePageLoad(pageName: string) {
    if (typeof window !== 'undefined' && 'performance' in window) {
      const navigation = performance.getEntriesByType('navigation')[0] as PerformanceNavigationTiming;
      const loadTime = navigation.loadEventEnd - navigation.loadEventStart;
      
      console.log(`Page ${pageName} loaded in ${loadTime}ms`);
      
      // Send to analytics
      if (process.env.NODE_ENV === 'production') {
        this.sendToAnalytics('page_load', {
          page: pageName,
          loadTime,
        });
      }
    }
  }
  
  static measureComponentRender(componentName: string) {
    const startTime = performance.now();
    
    return () => {
      const endTime = performance.now();
      const renderTime = endTime - startTime;
      
      console.log(`Component ${componentName} rendered in ${renderTime}ms`);
      
      if (renderTime > 100) {
        console.warn(`Slow render detected: ${componentName} took ${renderTime}ms`);
      }
    };
  }
  
  private static sendToAnalytics(event: string, data: any) {
    // Send to your analytics service
    // gtag('event', event, data);
  }
}
```

---

## 4. BANGLADESH-SPECIFIC IMPLEMENTATION

### 4.1 Payment Gateway Integration Strategies

#### SSLCommerz Integration
```typescript
// backend/src/payment/sslcommerz.service.ts
import { Injectable } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';

@Injectable()
export class SSLCommerzService {
  private readonly storeId: string;
  private readonly storePassword: string;
  private readonly baseUrl: string;

  constructor(private configService: ConfigService) {
    this.storeId = this.configService.get('SSLCOMMERZ_STORE_ID');
    this.storePassword = this.configService.get('SSLCOMMERZ_STORE_PASSWORD');
    this.baseUrl = this.configService.get('NODE_ENV') === 'production' 
      ? 'https://securepay.sslcommerz.com' 
      : 'https://sandbox.sslcommerz.com';
  }

  async createPayment(orderData: any) {
    const paymentData = {
      store_id: this.storeId,
      store_passwd: this.storePassword,
      total_amount: orderData.totalAmount,
      currency: 'BDT',
      tran_id: this.generateTransactionId(),
      success_url: `${this.configService.get('FRONTEND_URL')}/payment/success`,
      fail_url: `${this.configService.get('FRONTEND_URL')}/payment/fail`,
      cancel_url: `${this.configService.get('FRONTEND_URL')}/payment/cancel`,
      ipn_url: `${this.configService.get('BACKEND_URL')}/payment/ipn`,
      multi_card_name: 'bkash,nagad,rocket',
      product_name: 'Saffron Bakery Order',
      product_category: 'Food',
      product_profile: 'physical-goods',
      shipping_method: 'YES',
      num_of_item: orderData.items.length,
      product_name: orderData.items.map(item => item.name).join(','),
      product_category: orderData.items.map(item => item.category).join(','),
      cus_name: orderData.customerName,
      cus_email: orderData.customerEmail,
      cus_phone: orderData.customerPhone,
      cus_add1: orderData.customerAddress,
      cus_city: orderData.customerCity,
      cus_country: 'Bangladesh',
      value_a: orderData.orderId,
    };

    const response = await fetch(`${this.baseUrl}/gwprocess/v4/api.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams(paymentData).toString(),
    });

    return response.json();
  }

  async validatePayment(transactionId: string): Promise<boolean> {
    const validationData = {
      store_id: this.storeId,
      store_passwd: this.storePassword,
      tran_id: transactionId,
      request_key: this.configService.get('SSLCOMMERZ_REQUEST_KEY'),
      format: 'json',
    };

    const response = await fetch(`${this.baseUrl}/validator/api/validationserverAPI.php`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams(validationData).toString(),
    });

    const result = await response.json();
    return result.element[0].status === 'VALID';
  }

  private generateTransactionId(): string {
    return `SAF_${Date.now()}_${Math.random().toString(36).substr(2, 9)}`;
  }
}
```

#### bKash Integration
```typescript
// backend/src/payment/bkash.service.ts
import { Injectable } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';

@Injectable()
export class BkashService {
  private readonly appKey: string;
  private readonly appSecret: string;
  private readonly username: string;
  private readonly password: string;
  private readonly baseUrl: string;

  constructor(private configService: ConfigService) {
    this.appKey = this.configService.get('BKASH_APP_KEY');
    this.appSecret = this.configService.get('BKASH_APP_SECRET');
    this.username = this.configService.get('BKASH_USERNAME');
    this.password = this.configService.get('BKASH_PASSWORD');
    this.baseUrl = this.configService.get('NODE_ENV') === 'production'
      ? 'https://checkout.pay.bka.sh'
      : 'https://checkout.sandbox.bka.sh';
  }

  async createPayment(orderData: any) {
    // Get grant token
    const grantToken = await this.getGrantToken();
    
    const paymentData = {
      mode: '0011',
      payerReference: orderData.orderId,
      callbackURL: `${this.configService.get('BACKEND_URL')}/payment/bkash/callback`,
      amount: orderData.totalAmount,
      currency: 'BDT',
      intent: 'sale',
      merchantInvoiceNumber: orderData.orderId,
    };

    const response = await fetch(`${this.baseUrl}/v1.2.0-beta/checkout/payment/create`, {
      method: 'POST',
      headers: {
        'Authorization': grantToken,
        'Content-Type': 'application/json',
        'X-APP-Key': this.appKey,
      },
      body: JSON.stringify(paymentData),
    });

    return response.json();
  }

  async executePayment(paymentID: string) {
    const grantToken = await this.getGrantToken();
    
    const response = await fetch(`${this.baseUrl}/v1.2.0-beta/checkout/payment/execute`, {
      method: 'POST',
      headers: {
        'Authorization': grantToken,
        'Content-Type': 'application/json',
        'X-APP-Key': this.appKey,
      },
      body: JSON.stringify({ paymentID }),
    });

    return response.json();
  }

  private async getGrantToken(): Promise<string> {
    const authData = {
      app_key: this.appKey,
      app_secret: this.appSecret,
    };

    const authString = Buffer.from(`${this.username}:${this.password}`).toString('base64');
    
    const response = await fetch(`${this.baseUrl}/v1.2.0-beta/checkout/token/grant`, {
      method: 'POST',
      headers: {
        'Authorization': `Basic ${authString}`,
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(authData),
    });

    const result = await response.json();
    return result.id_token;
  }
}
```

#### Nagad Integration
```typescript
// backend/src/payment/nagad.service.ts
import { Injectable } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';

@Injectable()
export class NagadService {
  private readonly merchantId: string;
  private readonly merchantNumber: string;
  private readonly publicKey: string;
  private readonly privateKey: string;
  private readonly baseUrl: string;

  constructor(private configService: ConfigService) {
    this.merchantId = this.configService.get('NAGAD_MERCHANT_ID');
    this.merchantNumber = this.configService.get('NAGAD_MERCHANT_NUMBER');
    this.publicKey = this.configService.get('NAGAD_PUBLIC_KEY');
    this.privateKey = this.configService.get('NAGAD_PRIVATE_KEY');
    this.baseUrl = this.configService.get('NODE_ENV') === 'production'
      ? 'https://api.mynagad.com'
      : 'http://sandbox.mynagad.com';
  }

  async createPayment(orderData: any) {
    // Initialize payment
    const initData = {
      merchantId: this.merchantId,
      merchantNumber: this.merchantNumber,
      amount: orderData.totalAmount,
      orderId: orderData.orderId,
      datetime: new Date().toISOString(),
      challenge: this.generateChallenge(),
    };

    const signature = this.generateSignature(initData);
    
    const response = await fetch(`${this.baseUrl}/check/v1/init`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-KM-IP-V4': this.getClientIP(),
        'X-KM-Auth-Token': signature,
      },
      body: JSON.stringify(initData),
    });

    return response.json();
  }

  async verifyPayment(paymentRefId: string) {
    const verifyData = {
      merchantId: this.merchantId,
      paymentRefId: paymentRefId,
    };

    const signature = this.generateSignature(verifyData);
    
    const response = await fetch(`${this.baseUrl}/verify/v1/payment`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-KM-IP-V4': this.getClientIP(),
        'X-KM-Auth-Token': signature,
      },
      body: JSON.stringify(verifyData),
    });

    return response.json();
  }

  private generateChallenge(): string {
    return Math.random().toString(36).substring(2, 15);
  }

  private generateSignature(data: any): string {
    // Implement Nagad signature generation
    // This typically involves RSA signing with merchant private key
    const crypto = require('crypto');
    const sign = crypto.createSign('RSA-SHA256');
    sign.update(JSON.stringify(data));
    return sign.sign(this.privateKey, 'base64');
  }

  private getClientIP(): string {
    // Get client IP for Nagad requirements
    return '127.0.0.1'; // Replace with actual client IP
  }
}
```

### 4.2 Bilingual Support Implementation

#### Internationalization Setup
```typescript
// frontend/src/i18n/config.ts
import { i18n } from 'next-i18next';

i18n
  .init({
    lng: 'bn', // Default to Bengali
    fallbackLng: 'en',
    debug: process.env.NODE_ENV === 'development',
    
    interpolation: {
      escapeValue: false,
    },
    
    detection: {
      order: ['path', 'cookie', 'localStorage', 'navigator'],
      caches: ['localStorage', 'cookie'],
    },
    
    backend: {
      loadPath: '/locales/{{lng}}/{{ns}}.json',
      addPath: '/locales/{{lng}}/{{ns}}.json',
    },
    
    ns: ['common', 'products', 'checkout', 'account'],
    defaultNS: 'common',
  })
  .catch(console.error);
```

#### Bengali Number Formatting
```typescript
// frontend/src/utils/bengaliNumbers.ts
export class BengaliNumberFormatter {
  private static readonly bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
  
  static toBengali(num: number | string): string {
    const numStr = num.toString();
    return numStr.replace(/\d/g, (digit) => {
      return this.bengaliDigits[parseInt(digit)];
    });
  }
  
  static toEnglish(bengaliNum: string): number {
    const englishStr = bengaliNum.replace(/[০-৯]/g, (digit) => {
      return this.bengaliDigits.indexOf(digit);
    });
    return parseInt(englishStr);
  }
  
  static formatCurrency(amount: number, locale: 'bn' | 'en' = 'bn'): string {
    if (locale === 'bn') {
      return `৳${this.toBengali(amount.toFixed(2))}`;
    }
    return `BDT ${amount.toFixed(2)}`;
  }
  
  static formatDate(date: Date, locale: 'bn' | 'en' = 'bn'): string {
    const options: Intl.DateTimeFormatOptions = {
      day: 'numeric',
      month: 'long',
      year: 'numeric',
    };
    
    if (locale === 'bn') {
      return date.toLocaleDateString('bn-BD', options);
    }
    
    return date.toLocaleDateString('en-US', options);
  }
}
```

#### Language Toggle Component
```typescript
// frontend/src/components/LanguageToggle.tsx
import { useState } from 'react';
import { useRouter } from 'next/router';
import { useTranslation } from 'next-i18next';

export const LanguageToggle: React.FC = () => {
  const { t, i18n } = useTranslation();
  const router = useRouter();
  const [currentLang, setCurrentLang] = useState(i18n.language);
  
  const handleLanguageChange = (lang: string) => {
    i18n.changeLanguage(lang);
    setCurrentLang(lang);
    
    // Store preference
    localStorage.setItem('preferred-language', lang);
    
    // Update URL if needed
    const { pathname, asPath, query } = router;
    if (pathname.startsWith('/[lang]')) {
      router.push({ pathname, query }, asPath, { locale: lang });
    }
  };
  
  return (
    <div className="flex items-center space-x-2">
      <button
        onClick={() => handleLanguageChange('bn')}
        className={`px-3 py-1 rounded ${
          currentLang === 'bn' 
            ? 'bg-orange-500 text-white' 
            : 'bg-gray-200 text-gray-700'
        }`}
      >
        বাংলা
      </button>
      <button
        onClick={() => handleLanguageChange('en')}
        className={`px-3 py-1 rounded ${
          currentLang === 'en' 
            ? 'bg-orange-500 text-white' 
            : 'bg-gray-200 text-gray-700'
        }`}
      >
        English
      </button>
    </div>
  );
};
```

### 4.3 Network Optimization for Local Conditions

#### Progressive Web App Configuration
```typescript
// frontend/public/manifest.json
{
  "name": "Saffron Bakery",
  "short_name": "Saffron",
  "description": "Fresh bakery and dairy products delivered to your doorstep",
  "start_url": "/",
  "display": "standalone",
  "background_color": "#ffffff",
  "theme_color": "#ff6b35",
  "orientation": "portrait",
  "icons": [
    {
      "src": "/icons/icon-72x72.png",
      "sizes": "72x72",
      "type": "image/png"
    },
    {
      "src": "/icons/icon-96x96.png",
      "sizes": "96x96",
      "type": "image/png"
    },
    {
      "src": "/icons/icon-128x128.png",
      "sizes": "128x128",
      "type": "image/png"
    },
    {
      "src": "/icons/icon-144x144.png",
      "sizes": "144x144",
      "type": "image/png"
    },
    {
      "src": "/icons/icon-152x152.png",
      "sizes": "152x152",
      "type": "image/png"
    },
    {
      "src": "/icons/icon-192x192.png",
      "sizes": "192x192",
      "type": "image/png"
    },
    {
      "src": "/icons/icon-384x384.png",
      "sizes": "384x384",
      "type": "image/png"
    },
    {
      "src": "/icons/icon-512x512.png",
      "sizes": "512x512",
      "type": "image/png"
    }
  ],
  "lang": "bn,en",
  "dir": "ltr",
  "scope": "/",
  "categories": ["food", "shopping"],
  "shortcuts": [
    {
      "name": "Order Now",
      "short_name": "Order",
      "description": "Place a new order",
      "url": "/order",
      "icons": [{ "src": "/icons/order.png", "sizes": "96x96" }]
    },
    {
      "name": "View Menu",
      "short_name": "Menu",
      "description": "Browse our menu",
      "url": "/products",
      "icons": [{ "src": "/icons/menu.png", "sizes": "96x96" }]
    }
  ]
}
```

#### Service Worker for Offline Functionality
```typescript
// frontend/public/sw.js
const CACHE_NAME = 'saffron-bakery-v1';
const urlsToCache = [
  '/',
  '/products',
  '/about',
  '/contact',
  '/manifest.json',
  '/icons/icon-192x192.png',
  '/icons/icon-512x512.png',
];

// Install event - cache resources
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => cache.addAll(urlsToCache))
  );
});

// Fetch event - serve from cache when offline
self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request)
      .then((response) => {
        // Return cached version or fetch from network
        return response || fetch(event.request);
      })
      .catch(() => {
        // Offline fallback
        if (event.request.destination === 'document') {
          return caches.match('/offline.html');
        }
      })
  );
});

// Activate event - clean up old caches
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheName !== CACHE_NAME) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});
```

#### Network-Aware Loading Strategy
```typescript
// frontend/src/hooks/useNetworkAwareLoading.ts
import { useState, useEffect } from 'react';

export const useNetworkAwareLoading = () => {
  const [networkSpeed, setNetworkSpeed] = useState<'slow' | 'fast'>('fast');
  const [isOnline, setIsOnline] = useState(true);
  
  useEffect(() => {
    // Check network speed
    const checkNetworkSpeed = async () => {
      if ('connection' in navigator) {
        const connection = (navigator as any).connection;
        if (connection) {
          const effectiveType = connection.effectiveType;
          setNetworkSpeed(effectiveType === 'slow-2g' || effectiveType === '2g' ? 'slow' : 'fast');
        }
      }
      
      // Fallback: measure actual speed
      const startTime = Date.now();
      try {
        await fetch('/api/health', { method: 'HEAD' });
        const endTime = Date.now();
        const duration = endTime - startTime;
        setNetworkSpeed(duration > 1000 ? 'slow' : 'fast');
      } catch (error) {
        setNetworkSpeed('slow');
      }
    };
    
    // Check online status
    const handleOnline = () => setIsOnline(true);
    const handleOffline = () => setIsOnline(false);
    
    window.addEventListener('online', handleOnline);
    window.addEventListener('offline', handleOffline);
    
    checkNetworkSpeed();
    
    // Recheck periodically
    const interval = setInterval(checkNetworkSpeed, 30000);
    
    return () => {
      window.removeEventListener('online', handleOnline);
      window.removeEventListener('offline', handleOffline);
      clearInterval(interval);
    };
  }, []);
  
  return {
    networkSpeed,
    isOnline,
    shouldLoadImages: networkSpeed === 'fast' && isOnline,
    shouldLoadVideos: networkSpeed === 'fast' && isOnline,
    shouldUseReducedMotion: networkSpeed === 'slow',
  };
};
```

### 4.4 Regulatory Compliance Tools and Configurations

#### Bangladesh E-Commerce Act Compliance
```typescript
// backend/src/compliance/ecommerce-act.service.ts
import { Injectable } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';

@Injectable()
export class EcommerceActService {
  constructor(private configService: ConfigService) {}
  
  getBusinessRegistrationInfo() {
    return {
      businessRegistrationNumber: this.configService.get('BUSINESS_REGISTRATION_NUMBER'),
      tradeLicenseNumber: this.configService.get('TRADE_LICENSE_NUMBER'),
      tinNumber: this.configService.get('TIN_NUMBER'),
      vatRegistrationNumber: this.configService.get('VAT_REGISTRATION_NUMBER'),
      businessAddress: this.configService.get('BUSINESS_ADDRESS'),
      contactEmail: this.configService.get('BUSINESS_EMAIL'),
      contactPhone: this.configService.get('BUSINESS_PHONE'),
    };
  }
  
  getCompliancePolicies() {
    return {
      returnPolicy: {
        duration: '7 days',
        conditions: [
          'Product must be unused and in original packaging',
          'Food items must be returned within 24 hours of delivery',
          'Custom cakes cannot be returned unless defective',
        ],
        process: 'Contact customer service or initiate return from order history',
      },
      refundPolicy: {
        duration: '7-14 business days',
        methods: ['Original payment method', 'Bank transfer', 'Store credit'],
        conditions: [
          'Proof of purchase required',
          'Refund only for defective or incorrect items',
        ],
      },
      privacyPolicy: {
        dataCollection: 'Only necessary information for order processing',
        dataUsage: 'Order processing, delivery, and customer service',
        dataRetention: '7 years as per Bangladesh regulations',
        dataRights: ['Access', 'Correction', 'Deletion', 'Portability'],
      },
      termsOfService: {
        jurisdiction: 'Bangladesh',
        language: ['Bengali', 'English'],
        disputeResolution: 'Bangladesh Arbitration Center',
      },
    };
  }
  
  validateCompliance(orderData: any): { compliant: boolean; issues: string[] } {
    const issues: string[] = [];
    
    // Check required fields
    if (!orderData.customerName) {
      issues.push('Customer name is required');
    }
    
    if (!orderData.customerPhone) {
      issues.push('Customer phone number is required');
    }
    
    if (!orderData.customerAddress) {
      issues.push('Delivery address is required');
    }
    
    // Check order limits
    if (orderData.totalAmount > 100000) {
      issues.push('Order amount exceeds daily limit');
    }
    
    // Check prohibited items
    const prohibitedItems = ['alcohol', 'tobacco'];
    if (orderData.items.some(item => prohibitedItems.includes(item.category))) {
      issues.push('Prohibited items in order');
    }
    
    return {
      compliant: issues.length === 0,
      issues,
    };
  }
}
```

#### Data Protection Compliance
```typescript
// backend/src/compliance/data-protection.service.ts
import { Injectable } from '@nestjs/common';

@Injectable()
export class DataProtectionService {
  private readonly sensitiveFields = [
    'password',
    'creditCardNumber',
    'bankAccount',
    'nationalId',
  ];
  
  anonymizePersonalData(data: any): any {
    const anonymized = { ...data };
    
    // Remove sensitive fields
    this.sensitiveFields.forEach(field => {
      if (anonymized[field]) {
        delete anonymized[field];
      }
    });
    
    // Partially anonymize other personal data
    if (anonymized.email) {
      anonymized.email = this.partialAnonymizeEmail(anonymized.email);
    }
    
    if (anonymized.phone) {
      anonymized.phone = this.partialAnonymizePhone(anonymized.phone);
    }
    
    return anonymized;
  }
  
  private partialAnonymizeEmail(email: string): string {
    const [username, domain] = email.split('@');
    const visibleChars = Math.min(2, username.length);
    const maskedUsername = username.substring(0, visibleChars) + '*'.repeat(username.length - visibleChars);
    return `${maskedUsername}@${domain}`;
  }
  
  private partialAnonymizePhone(phone: string): string {
    const visibleDigits = Math.min(3, phone.length - 4);
    const maskedPhone = '*'.repeat(phone.length - visibleDigits - 4) + phone.substring(phone.length - visibleDigits);
    return maskedPhone;
  }
  
  logDataAccess(userId: string, dataType: string, action: string) {
    // Log all personal data access for audit trail
    console.log({
      timestamp: new Date().toISOString(),
      userId,
      dataType,
      action,
      ipAddress: this.getClientIP(),
    });
  }
  
  private getClientIP(): string {
    // Implementation to get client IP
    return '127.0.0.1'; // Replace with actual implementation
  }
}
```

---

## 5. DEPLOYMENT STRATEGY

### 5.1 Local Development Deployment

#### Docker Compose for Local Development
```yaml
# docker-compose.dev.yml
version: '3.8'

services:
  frontend:
    build:
      context: ./frontend
      dockerfile: Dockerfile.dev
    ports:
      - "3000:3000"
    volumes:
      - ./frontend:/app
      - /app/node_modules
    environment:
      - NODE_ENV=development
      - NEXT_PUBLIC_API_URL=http://localhost:3001
      - NEXT_PUBLIC_SITE_URL=http://localhost:3000
    depends_on:
      - backend
      - postgres
      - redis

  backend:
    build:
      context: ./backend
      dockerfile: Dockerfile.dev
    ports:
      - "3001:3001"
    volumes:
      - ./backend:/app
      - /app/node_modules
    environment:
      - NODE_ENV=development
      - DATABASE_URL=postgresql://saffron_dev:dev_password@postgres:5432/saffron_dev
      - REDIS_URL=redis://redis:6379
    depends_on:
      - postgres
      - redis

  postgres:
    image: postgres:15
    environment:
      POSTGRES_DB: saffron_dev
      POSTGRES_USER: saffron_dev
      POSTGRES_PASSWORD: dev_password
    ports:
      - "5432:5432"
    volumes:
      - postgres_data:/var/lib/postgresql/data
      - ./database/init:/docker-entrypoint-initdb.d

  redis:
    image: redis:7
    ports:
      - "6379:6379"
    volumes:
      - redis_data:/data
    command: redis-server --appendonly yes

  nginx:
    image: nginx:alpine
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./nginx/dev.conf:/etc/nginx/nginx.conf
      - ./ssl:/etc/nginx/ssl
    depends_on:
      - frontend
      - backend

volumes:
  postgres_data:
  redis_data:
```

#### Local Development Scripts
```json
// package.json
{
  "scripts": {
    "dev:setup": "docker-compose -f docker-compose.dev.yml up -d",
    "dev:down": "docker-compose -f docker-compose.dev.yml down",
    "dev:logs": "docker-compose -f docker-compose.dev.yml logs -f",
    "dev:clean": "docker-compose -f docker-compose.dev.yml down -v",
    "dev:db:migrate": "cd backend && pnpm migration:run",
    "dev:db:seed": "cd backend && pnpm seed:dev",
    "dev:db:reset": "cd backend && pnpm db:reset && pnpm migration:run && pnpm seed:dev"
  }
}
```

### 5.2 On-Premise Deployment to Organization's Datacenter

#### Production Docker Configuration
```dockerfile
# frontend/Dockerfile.prod
FROM node:20-alpine AS builder

WORKDIR /app

# Copy package files
COPY package*.json ./
COPY pnpm-lock.yaml ./

# Install dependencies
RUN npm install -g pnpm
RUN pnpm install --frozen-lockfile

# Copy source code
COPY . .

# Build application
RUN pnpm build

# Production stage
FROM node:20-alpine AS runner

WORKDIR /app

# Create non-root user
RUN addgroup -g 1001 -S nodejs
RUN adduser -S nextjs -u 1001

# Copy built application
COPY --from=builder --chown=nextjs:nodejs /app/.next ./.next
COPY --from=builder --chown=nextjs:nodejs /app/node_modules ./node_modules
COPY --from=builder --chown=nextjs:nodejs /app/package.json ./package.json
COPY --from=builder --chown=nextjs:nodejs /app/public ./public

USER nextjs

EXPOSE 3000

ENV PORT 3000

CMD ["pnpm", "start"]
```

```dockerfile
# backend/Dockerfile.prod
FROM node:20-alpine AS builder

WORKDIR /app

# Copy package files
COPY package*.json ./
COPY pnpm-lock.yaml ./

# Install dependencies
RUN npm install -g pnpm
RUN pnpm install --frozen-lockfile

# Copy source code
COPY . .

# Build application
RUN pnpm build

# Production stage
FROM node:20-alpine AS runner

WORKDIR /app

# Install production dependencies
COPY package*.json ./
RUN npm install -g pnpm && pnpm install --frozen-lockfile --prod

# Copy built application
COPY --from=builder /app/dist ./dist

# Create non-root user
RUN addgroup -g 1001 -S nodejs
RUN adduser -S nestjs -u 1001

USER nestjs

EXPOSE 3001

CMD ["node", "dist/main.js"]
```

#### Production Docker Compose
```yaml
# docker-compose.prod.yml
version: '3.8'

services:
  frontend:
    build:
      context: ./frontend
      dockerfile: Dockerfile.prod
    restart: unless-stopped
    environment:
      - NODE_ENV=production
      - NEXT_PUBLIC_API_URL=https://api.saffronbakery.com
      - NEXT_PUBLIC_SITE_URL=https://saffronbakery.com
    depends_on:
      - backend

  backend:
    build:
      context: ./backend
      dockerfile: Dockerfile.prod
    restart: unless-stopped
    environment:
      - NODE_ENV=production
      - DATABASE_URL=${DATABASE_URL}
      - REDIS_URL=${REDIS_URL}
      - JWT_SECRET=${JWT_SECRET}
    depends_on:
      - postgres
      - redis

  postgres:
    image: postgres:15
    restart: unless-stopped
    environment:
      POSTGRES_DB: ${POSTGRES_DB}
      POSTGRES_USER: ${POSTGRES_USER}
      POSTGRES_PASSWORD: ${POSTGRES_PASSWORD}
    volumes:
      - postgres_data:/var/lib/postgresql/data
      - ./backups:/backups

  redis:
    image: redis:7
    restart: unless-stopped
    command: redis-server --appendonly yes --requirepass ${REDIS_PASSWORD}
    volumes:
      - redis_data:/data

  nginx:
    image: nginx:alpine
    restart: unless-stopped
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./nginx/prod.conf:/etc/nginx/nginx.conf
      - ./ssl:/etc/nginx/ssl
      - static_files:/var/www/static
    depends_on:
      - frontend
      - backend

volumes:
  postgres_data:
  redis_data:
  static_files:
```

### 5.3 Cloud Deployment Options

#### Vercel Frontend Deployment
```json
// frontend/vercel.json
{
  "version": 2,
  "builds": [
    {
      "src": "package.json",
      "use": "@vercel/next"
    }
  ],
  "routes": [
    {
      "src": "/(.*)",
      "dest": "/$1"
    }
  ],
  "env": {
    "NEXT_PUBLIC_API_URL": "@api-url",
    "NEXT_PUBLIC_SITE_URL": "@site-url"
  },
  "regions": ["sin1"],
  "functions": {
    "pages/api/**/*.js": {
      "maxDuration": 30
    }
  },
  "headers": [
    {
      "source": "/(.*)",
      "headers": [
        {
          "key": "X-Frame-Options",
          "value": "DENY"
        },
        {
          "key": "X-Content-Type-Options",
          "value": "nosniff"
        },
        {
          "key": "X-XSS-Protection",
          "value": "1; mode=block"
        },
        {
          "key": "Strict-Transport-Security",
          "value": "max-age=31536000; includeSubDomains"
        }
      ]
    }
  ]
}
```

#### DigitalOcean Backend Deployment
```yaml
# .do/app.yaml
name: saffron-backend
services:
- name: web
  source_dir: /backend
  github:
    repo: saffron-bakery/backend
    branch: main
  run_command: pnpm start:prod
  environment_slug: node-js
  instance_count: 1
  instance_size_slug: professional-xs
  env:
  - key: NODE_ENV
    value: production
  - key: DATABASE_URL
    value: ${DATABASE_URL}
  - key: REDIS_URL
    value: ${REDIS_URL}
  - key: JWT_SECRET
    value: ${JWT_SECRET}
  http_port: 3001
  routes:
  - path: /
  health_check:
    http_path: /health
    initial_delay_seconds: 30
    interval_seconds: 10
    timeout_seconds: 5
    success_threshold: 3
    failure_threshold: 3
```

### 5.4 Migration Strategies Between Environments

#### Database Migration Strategy
```typescript
// backend/src/database/migrations/migration.service.ts
import { Injectable } from '@nestjs/common';
import { DataSource } from 'typeorm';

@Injectable()
export class MigrationService {
  constructor(private dataSource: DataSource) {}
  
  async migrateFromProductionToStaging() {
    // Export production data
    const productionData = await this.exportProductionData();
    
    // Transform data if needed
    const transformedData = this.transformDataForStaging(productionData);
    
    // Import to staging
    await this.importToStaging(transformedData);
    
    // Verify migration
    await this.verifyMigration();
  }
  
  private async exportProductionData() {
    // Export users, products, orders, etc.
    const users = await this.dataSource.query('SELECT * FROM users');
    const products = await this.dataSource.query('SELECT * FROM products');
    const orders = await this.dataSource.query('SELECT * FROM orders');
    
    return {
      users: users,
      products: products,
      orders: orders,
    };
  }
  
  private transformDataForStaging(data: any) {
    // Anonymize personal data for staging
    return {
      ...data,
      users: data.users.map(user => ({
        ...user,
        email: this.anonymizeEmail(user.email),
        phone: this.anonymizePhone(user.phone),
      })),
    };
  }
  
  private async importToStaging(data: any) {
    // Clear staging database
    await this.dataSource.query('TRUNCATE TABLE orders CASCADE');
    await this.dataSource.query('TRUNCATE TABLE products CASCADE');
    await this.dataSource.query('TRUNCATE TABLE users CASCADE');
    
    // Import transformed data
    await this.dataSource.query('INSERT INTO users SELECT * FROM $1', [data.users]);
    await this.dataSource.query('INSERT INTO products SELECT * FROM $1', [data.products]);
    await this.dataSource.query('INSERT INTO orders SELECT * FROM $1', [data.orders]);
  }
  
  private async verifyMigration() {
    // Verify data integrity
    const userCount = await this.dataSource.query('SELECT COUNT(*) FROM users');
    const productCount = await this.dataSource.query('SELECT COUNT(*) FROM products');
    const orderCount = await this.dataSource.query('SELECT COUNT(*) FROM orders');
    
    console.log(`Migration verification: ${userCount} users, ${productCount} products, ${orderCount} orders`);
  }
  
  private anonymizeEmail(email: string): string {
    const [username, domain] = email.split('@');
    return `staging_${username}@${domain}`;
  }
  
  private anonymizePhone(phone: string): string {
    return `01${phone.substring(2)}`;
  }
}
```

#### Configuration Management
```typescript
// backend/src/config/configuration.service.ts
import { Injectable } from '@nestjs/common';

@Injectable()
export class ConfigurationService {
  private readonly environments = ['development', 'staging', 'production'];
  
  getEnvironmentConfig(env: string) {
    const configs = {
      development: {
        database: {
          host: 'localhost',
          port: 5432,
          username: 'saffron_dev',
          password: 'dev_password',
          database: 'saffron_dev',
        },
        redis: {
          host: 'localhost',
          port: 6379,
          password: '',
        },
        app: {
          port: 3001,
          jwtSecret: 'dev-secret-key',
          jwtExpiration: '7d',
        },
      },
      staging: {
        database: {
          host: 'staging-db.saffronbakery.com',
          port: 5432,
          username: 'saffron_staging',
          password: process.env.STAGING_DB_PASSWORD,
          database: 'saffron_staging',
        },
        redis: {
          host: 'staging-redis.saffronbakery.com',
          port: 6379,
          password: process.env.STAGING_REDIS_PASSWORD,
        },
        app: {
          port: 3001,
          jwtSecret: process.env.STAGING_JWT_SECRET,
          jwtExpiration: '7d',
        },
      },
      production: {
        database: {
          host: 'prod-db.saffronbakery.com',
          port: 5432,
          username: 'saffron_prod',
          password: process.env.PROD_DB_PASSWORD,
          database: 'saffron_prod',
        },
        redis: {
          host: 'prod-redis.saffronbakery.com',
          port: 6379,
          password: process.env.PROD_REDIS_PASSWORD,
        },
        app: {
          port: 3001,
          jwtSecret: process.env.PROD_JWT_SECRET,
          jwtExpiration: '7d',
        },
      },
    };
    
    return configs[env] || configs.development;
  }
  
  migrateConfiguration(fromEnv: string, toEnv: string) {
    const fromConfig = this.getEnvironmentConfig(fromEnv);
    const toConfig = this.getEnvironmentConfig(toEnv);
    
    // Validate migration
    const validationErrors = this.validateConfigurationMigration(fromConfig, toConfig);
    if (validationErrors.length > 0) {
      throw new Error(`Configuration migration validation failed: ${validationErrors.join(', ')}`);
    }
    
    return toConfig;
  }
  
  private validateConfigurationMigration(fromConfig: any, toConfig: any): string[] {
    const errors: string[] = [];
    
    // Check required fields
    if (!toConfig.database.password) {
      errors.push('Database password is required');
    }
    
    if (!toConfig.app.jwtSecret) {
      errors.push('JWT secret is required');
    }
    
    // Check security settings
    if (toConfig.app.jwtSecret === fromConfig.app.jwtSecret) {
      errors.push('JWT secret must be different between environments');
    }
    
    return errors;
  }
}
```

---

## 6. PERFORMANCE AND SECURITY OPTIMIZATION

### 6.1 Caching Strategies

#### Multi-Level Caching Implementation
```typescript
// backend/src/cache/cache.service.ts
import { Injectable, Inject } from '@nestjs/common';
import { Redis } from 'ioredis';

@Injectable()
export class CacheService {
  constructor(@Inject('REDIS_CLIENT') private redis: Redis) {}
  
  async get<T>(key: string): Promise<T | null> {
    try {
      const cached = await this.redis.get(key);
      return cached ? JSON.parse(cached) : null;
    } catch (error) {
      console.error('Cache get error:', error);
      return null;
    }
  }
  
  async set(key: string, value: any, ttl: number = 3600): Promise<void> {
    try {
      await this.redis.setex(key, ttl, JSON.stringify(value));
    } catch (error) {
      console.error('Cache set error:', error);
    }
  }
  
  async del(key: string): Promise<void> {
    try {
      await this.redis.del(key);
    } catch (error) {
      console.error('Cache delete error:', error);
    }
  }
  
  async invalidatePattern(pattern: string): Promise<void> {
    try {
      const keys = await this.redis.keys(pattern);
      if (keys.length > 0) {
        await this.redis.del(...keys);
      }
    } catch (error) {
      console.error('Cache invalidate pattern error:', error);
    }
  }
  
  // Product caching with intelligent invalidation
  async cacheProduct(productId: string, productData: any): Promise<void> {
    const cacheKey = `product:${productId}`;
    const listCacheKey = `products:list`;
    const categoryCacheKey = `products:category:${productData.category}`;
    
    // Cache individual product
    await this.set(cacheKey, productData, 1800); // 30 minutes
    
    // Invalidate related caches
    await this.invalidatePattern(`${listCacheKey}:*`);
    await this.invalidatePattern(`${categoryCacheKey}:*`);
  }
  
  // Session management
  async setSession(sessionId: string, sessionData: any): Promise<void> {
    const cacheKey = `session:${sessionId}`;
    await this.set(cacheKey, sessionData, 604800); // 7 days
  }
  
  async getSession(sessionId: string): Promise<any | null> {
    const cacheKey = `session:${sessionId}`;
    return this.get(cacheKey);
  }
  
  async deleteSession(sessionId: string): Promise<void> {
    const cacheKey = `session:${sessionId}`;
    await this.del(cacheKey);
  }
  
  // Rate limiting
  async checkRateLimit(identifier: string, limit: number, window: number): Promise<boolean> {
    const cacheKey = `rate_limit:${identifier}`;
    const current = await this.get<number>(cacheKey) || 0;
    
    if (current >= limit) {
      return false;
    }
    
    await this.set(cacheKey, current + 1, window);
    return true;
  }
}
```

#### Database Query Optimization
```typescript
// backend/src/database/query-optimizer.service.ts
import { Injectable } from '@nestjs/common';
import { DataSource } from 'typeorm';

@Injectable()
export class QueryOptimizerService {
  constructor(private dataSource: DataSource) {}
  
  // Optimized product query with proper indexing
  async getProducts(filters: any, pagination: any) {
    let query = this.dataSource
      .createQueryBuilder('product')
      .leftJoinAndSelect('product.category', 'category')
      .leftJoinAndSelect('product.images', 'images')
      .where('product.isActive = :isActive', { isActive: true });
    
    // Apply filters efficiently
    if (filters.categoryId) {
      query = query.andWhere('category.id = :categoryId', { categoryId: filters.categoryId });
    }
    
    if (filters.priceRange) {
      query = query.andWhere('product.price BETWEEN :minPrice AND :maxPrice', {
        minPrice: filters.priceRange.min,
        maxPrice: filters.priceRange.max,
      });
    }
    
    if (filters.searchTerm) {
      query = query.andWhere(
        '(product.name ILIKE :searchTerm OR product.description ILIKE :searchTerm)',
        { searchTerm: `%${filters.searchTerm}%` }
      );
    }
    
    // Apply pagination efficiently
    const [products, total] = await query
      .orderBy('product.createdAt', 'DESC')
      .skip(pagination.offset)
      .take(pagination.limit)
      .getManyAndCount();
    
    return {
      products,
      total,
      page: pagination.page,
      totalPages: Math.ceil(total / pagination.limit),
    };
  }
  
  // Batch operations for better performance
  async bulkUpdateStock(updates: Array<{ productId: string; quantity: number }>) {
    await this.dataSource.manager.transaction(async (manager) => {
      for (const update of updates) {
        await manager
          .createQueryBuilder()
          .update('products')
          .set({ stockQuantity: update.quantity })
          .where('id = :productId', { productId: update.productId })
          .execute();
      }
    });
  }
  
  // Efficient order reporting
  async getOrderReports(startDate: Date, endDate: Date) {
    return this.dataSource
      .createQueryBuilder('order')
      .select([
        'DATE(order.createdAt) as date',
        'COUNT(order.id) as orderCount',
        'SUM(order.total) as totalRevenue',
        'AVG(order.total) as averageOrderValue',
      ])
      .where('order.createdAt BETWEEN :startDate AND :endDate', {
        startDate,
        endDate,
      })
      .andWhere('order.status = :status', { status: 'completed' })
      .groupBy('DATE(order.createdAt)')
      .orderBy('DATE(order.createdAt)', 'DESC')
      .getRawMany();
  }
}
```

### 6.2 Security Configurations

#### Security Middleware Configuration
```typescript
// backend/src/security/security.middleware.ts
import { Injectable, NestMiddleware } from '@nestjs/common';
import { Request, Response, NextFunction } from 'express';

@Injectable()
export class SecurityMiddleware implements NestMiddleware {
  use(req: Request, res: Response, next: NextFunction) {
    // Security headers
    res.setHeader('X-Frame-Options', 'DENY');
    res.setHeader('X-Content-Type-Options', 'nosniff');
    res.setHeader('X-XSS-Protection', '1; mode=block');
    res.setHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
    res.setHeader('Content-Security-Policy', this.getCSP());
    
    // Rate limiting
    const clientIP = this.getClientIP(req);
    const userAgent = req.headers['user-agent'];
    
    // Log suspicious requests
    if (this.isSuspiciousRequest(req)) {
      console.warn(`Suspicious request from ${clientIP}:`, {
        method: req.method,
        url: req.url,
        userAgent,
      });
    }
    
    next();
  }
  
  private getCSP(): string {
    return [
      "default-src 'self'",
      "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.google.com https://www.gstatic.com",
      "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
      "font-src 'self' https://fonts.gstatic.com",
      "img-src 'self' data: https:",
      "connect-src 'self' https://api.saffronbakery.com",
      "frame-ancestors 'none'",
      "base-uri 'self'",
      "form-action 'self'",
    ].join('; ');
  }
  
  private getClientIP(req: Request): string {
    return req.headers['x-forwarded-for'] as string || 
           req.headers['x-real-ip'] as string || 
           req.connection.remoteAddress || 
           req.socket.remoteAddress;
  }
  
  private isSuspiciousRequest(req: Request): boolean {
    const suspiciousPatterns = [
      /\.\./,  // Path traversal
      /<script/i,  // XSS attempts
      /union.*select/i,  // SQL injection
      /javascript:/i,  // JavaScript protocol
    ];
    
    const url = req.url || '';
    const userAgent = req.headers['user-agent'] || '';
    
    return suspiciousPatterns.some(pattern => 
      pattern.test(url) || pattern.test(userAgent)
    );
  }
}
```

#### Payment Security Implementation
```typescript
// backend/src/security/payment-security.service.ts
import { Injectable } from '@nestjs/common';
import { ConfigService } from '@nestjs/config';

@Injectable()
export class PaymentSecurityService {
  constructor(private configService: ConfigService) {}
  
  validatePaymentRequest(paymentData: any): { valid: boolean; errors: string[] } {
    const errors: string[] = [];
    
    // Check required fields
    const requiredFields = ['orderId', 'amount', 'currency', 'paymentMethod'];
    for (const field of requiredFields) {
      if (!paymentData[field]) {
        errors.push(`${field} is required`);
      }
    }
    
    // Validate amount
    if (paymentData.amount <= 0) {
      errors.push('Amount must be greater than 0');
    }
    
    if (paymentData.amount > 100000) {
      errors.push('Amount exceeds maximum limit');
    }
    
    // Validate currency
    if (paymentData.currency !== 'BDT') {
      errors.push('Only BDT currency is supported');
    }
    
    // Validate payment method
    const allowedMethods = ['bkash', 'nagad', 'rocket', 'sslcommerz', 'cod'];
    if (!allowedMethods.includes(paymentData.paymentMethod)) {
      errors.push('Invalid payment method');
    }
    
    // Check for duplicate payments
    if (paymentData.orderId) {
      // Implementation to check for existing payments
    }
    
    return {
      valid: errors.length === 0,
      errors,
    };
  }
  
  generatePaymentSignature(paymentData: any): string {
    const crypto = require('crypto');
    const secretKey = this.configService.get('PAYMENT_SECRET_KEY');
    
    // Create signature string
    const signatureString = [
      paymentData.orderId,
      paymentData.amount,
      paymentData.currency,
      paymentData.timestamp,
    ].join('|');
    
    // Generate HMAC signature
    return crypto
      .createHmac('sha256', secretKey)
      .update(signatureString)
      .digest('hex');
  }
  
  verifyPaymentSignature(paymentData: any, signature: string): boolean {
    const expectedSignature = this.generatePaymentSignature(paymentData);
    return crypto.timingSafeEqual(
      Buffer.from(signature),
      Buffer.from(expectedSignature)
    );
  }
  
  encryptSensitiveData(data: string): string {
    const crypto = require('crypto');
    const algorithm = 'aes-256-gcm';
    const secretKey = this.configService.get('ENCRYPTION_KEY');
    
    const iv = crypto.randomBytes(16);
    const cipher = crypto.createCipher(algorithm, secretKey, iv);
    
    let encrypted = cipher.update(data, 'utf8', 'hex');
    encrypted += cipher.final('hex');
    
    const authTag = cipher.getAuthTag();
    
    return iv.toString('hex') + ':' + authTag.toString('hex') + ':' + encrypted;
  }
  
  decryptSensitiveData(encryptedData: string): string {
    const crypto = require('crypto');
    const algorithm = 'aes-256-gcm';
    const secretKey = this.configService.get('ENCRYPTION_KEY');
    
    const parts = encryptedData.split(':');
    const iv = Buffer.from(parts[0], 'hex');
    const authTag = Buffer.from(parts[1], 'hex');
    const encrypted = parts[2];
    
    const decipher = crypto.createDecipher(algorithm, secretKey, iv);
    decipher.setAuthTag(authTag);
    
    let decrypted = decipher.update(encrypted, 'hex', 'utf8');
    decrypted += decipher.final('utf8');
    
    return decrypted;
  }
}
```

### 6.3 Performance Monitoring

#### Application Performance Monitoring
```typescript
// backend/src/monitoring/performance.service.ts
import { Injectable, OnModuleInit } from '@nestjs/common';
import { createPrometheusMetrics } from '@willsoto/nestjs-prometheus';

@Injectable()
export class PerformanceService implements OnModuleInit {
  private metrics: any;
  
  onModuleInit() {
    this.metrics = createPrometheusMetrics({
      path: '/metrics',
      defaultMetrics: {
        enabled: true,
        config: {
          prefix: 'saffron_',
        },
      },
    });
  }
  
  // Custom metrics
  trackHttpRequest(method: string, route: string, statusCode: number, duration: number) {
    this.metrics.httpRequestsTotal.inc({
      method,
      route,
      status_code: statusCode.toString(),
    });
    
    this.metrics.httpRequestDuration.observe(
      {
        method,
        route,
        status_code: statusCode.toString(),
      },
      duration / 1000 // Convert to seconds
    );
  }
  
  trackDatabaseQuery(query: string, duration: number) {
    this.metrics.databaseQueriesTotal.inc({
      query_type: this.getQueryType(query),
    });
    
    this.metrics.databaseQueryDuration.observe(
      {
        query_type: this.getQueryType(query),
      },
      duration / 1000
    );
  }
  
  trackPaymentAttempt(method: string, success: boolean, amount: number) {
    this.metrics.paymentAttemptsTotal.inc({
      method,
      status: success ? 'success' : 'failure',
    });
    
    if (success) {
      this.metrics.paymentRevenue.observe({ method }, amount);
    }
  }
  
  trackCacheHit(key: string, hit: boolean) {
    this.metrics.cacheRequestsTotal.inc({
      cache_type: this.getCacheType(key),
      status: hit ? 'hit' : 'miss',
    });
  }
  
  private getQueryType(query: string): string {
    if (query.trim().toLowerCase().startsWith('select')) return 'select';
    if (query.trim().toLowerCase().startsWith('insert')) return 'insert';
    if (query.trim().toLowerCase().startsWith('update')) return 'update';
    if (query.trim().toLowerCase().startsWith('delete')) return 'delete';
    return 'other';
  }
  
  private getCacheType(key: string): string {
    if (key.startsWith('product:')) return 'product';
    if (key.startsWith('user:')) return 'user';
    if (key.startsWith('session:')) return 'session';
    return 'other';
  }
}
```

#### Frontend Performance Monitoring
```typescript
// frontend/src/monitoring/performance-monitor.ts
export class PerformanceMonitor {
  private static metrics: any = {};
  
  static initialize() {
    // Core Web Vitals monitoring
    this.observeCoreWebVitals();
    
    // Custom metrics
    this.observeCustomMetrics();
    
    // Error tracking
    this.observeErrors();
    
    // Send metrics to backend
    this.scheduleMetricsReporting();
  }
  
  private static observeCoreWebVitals() {
    // Largest Contentful Paint (LCP)
    new PerformanceObserver((list) => {
      for (const entry of list.getEntries()) {
        if (entry.entryType === 'largest-contentful-paint') {
          this.metrics.lcp = entry.startTime;
        }
      }
    }).observe({ entryTypes: ['largest-contentful-paint'] });
    
    // First Input Delay (FID)
    new PerformanceObserver((list) => {
      for (const entry of list.getEntries()) {
        if (entry.entryType === 'first-input') {
          this.metrics.fid = entry.processingStart - entry.startTime;
        }
      }
    }).observe({ entryTypes: ['first-input'] });
    
    // Cumulative Layout Shift (CLS)
    let clsValue = 0;
    new PerformanceObserver((list) => {
      for (const entry of list.getEntries()) {
        if (entry.entryType === 'layout-shift' && !entry.hadRecentInput) {
          clsValue += entry.value;
          this.metrics.cls = clsValue;
        }
      }
    }).observe({ entryTypes: ['layout-shift'] });
  }
  
  private static observeCustomMetrics() {
    // Page load time
    window.addEventListener('load', () => {
      const navigation = performance.getEntriesByType('navigation')[0] as PerformanceNavigationTiming;
      this.metrics.pageLoadTime = navigation.loadEventEnd - navigation.navigationStart;
    });
    
    // API response times
    const originalFetch = window.fetch;
    window.fetch = async (...args) => {
      const start = performance.now();
      const response = await originalFetch(...args);
      const end = performance.now();
      
      this.recordApiCall(args[0], response.status, end - start);
      
      return response;
    };
  }
  
  private static observeErrors() {
    window.addEventListener('error', (event) => {
      this.recordError({
        type: 'javascript',
        message: event.message,
        filename: event.filename,
        lineno: event.lineno,
        colno: event.colno,
        stack: event.error?.stack,
      });
    });
    
    window.addEventListener('unhandledrejection', (event) => {
      this.recordError({
        type: 'promise_rejection',
        message: event.reason?.message || 'Unhandled promise rejection',
        stack: event.reason?.stack,
      });
    });
  }
  
  private static recordApiCall(url: string, status: number, duration: number) {
    if (!this.metrics.apiCalls) {
      this.metrics.apiCalls = [];
    }
    
    this.metrics.apiCalls.push({
      url,
      status,
      duration,
      timestamp: Date.now(),
    });
    
    // Keep only last 100 API calls
    if (this.metrics.apiCalls.length > 100) {
      this.metrics.apiCalls = this.metrics.apiCalls.slice(-100);
    }
  }
  
  private static recordError(error: any) {
    if (!this.metrics.errors) {
      this.metrics.errors = [];
    }
    
    this.metrics.errors.push({
      ...error,
      timestamp: Date.now(),
      userAgent: navigator.userAgent,
      url: window.location.href,
    });
    
    // Keep only last 50 errors
    if (this.metrics.errors.length > 50) {
      this.metrics.errors = this.metrics.errors.slice(-50);
    }
  }
  
  private static scheduleMetricsReporting() {
    // Report metrics every 30 seconds
    setInterval(() => {
      this.reportMetrics();
    }, 30000);
    
    // Report metrics when page is unloaded
    window.addEventListener('beforeunload', () => {
      this.reportMetrics();
    });
  }
  
  private static async reportMetrics() {
    try {
      await fetch('/api/analytics/metrics', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          ...this.metrics,
          timestamp: Date.now(),
          userAgent: navigator.userAgent,
          url: window.location.href,
        }),
      });
      
      // Clear metrics after successful report
      this.metrics = {};
    } catch (error) {
      console.error('Failed to report metrics:', error);
    }
  }
}
```

### 6.4 Scalability Implementations

#### Horizontal Scaling Configuration
```typescript
// backend/src/scaling/scaling.service.ts
import { Injectable } from '@nestjs/common';
import { DataSource } from 'typeorm';

@Injectable()
export class ScalingService {
  constructor(private dataSource: DataSource) {}
  
  async checkScalingNeeds(): Promise<ScalingRecommendation> {
    const currentLoad = await this.getCurrentLoad();
    const databaseConnections = await this.getDatabaseConnections();
    const queueSize = await this.getQueueSize();
    
    return {
      needsScaling: this.shouldScale(currentLoad, databaseConnections, queueSize),
      currentLoad,
      databaseConnections,
      queueSize,
      recommendedInstances: this.calculateRecommendedInstances(currentLoad),
    };
  }
  
  private async getCurrentLoad(): Promise<number> {
    // Get current system load
    const os = require('os');
    return os.loadavg()[0]; // 1-minute average
  }
  
  private async getDatabaseConnections(): Promise<number> {
    const result = await this.dataSource.query(
      'SELECT count(*) FROM pg_stat_activity WHERE state = \'active\''
    );
    return parseInt(result[0].count);
  }
  
  private async getQueueSize(): Promise<number> {
    // Get Redis queue size
    const redis = require('ioredis');
    const client = new redis(process.env.REDIS_URL);
    return client.llen('background-jobs');
  }
  
  private shouldScale(load: number, connections: number, queueSize: number): boolean {
    return (
      load > 0.7 || // CPU load > 70%
      connections > 80 || // Database connections > 80
      queueSize > 100 // Queue size > 100
    );
  }
  
  private calculateRecommendedInstances(load: number): number {
    // Calculate recommended instances based on current load
    if (load < 0.5) return 1;
    if (load < 1.0) return 2;
    if (load < 1.5) return 3;
    if (load < 2.0) return 4;
    return 5; // Maximum instances
  }
  
  async triggerAutoScaling(): Promise<void> {
    const recommendation = await this.checkScalingNeeds();
    
    if (recommendation.needsScaling) {
      console.log('Triggering auto-scaling:', recommendation);
      
      // Trigger scaling via cloud provider API
      await this.scaleInstances(recommendation.recommendedInstances);
    }
  }
  
  private async scaleInstances(targetInstances: number): Promise<void> {
    // Implementation to call cloud provider API
    // This would be specific to your cloud provider (AWS, DigitalOcean, etc.)
    console.log(`Scaling to ${targetInstances} instances`);
  }
}

interface ScalingRecommendation {
  needsScaling: boolean;
  currentLoad: number;
  databaseConnections: number;
  queueSize: number;
  recommendedInstances: number;
}
```

#### Database Read Replicas Setup
```typescript
// backend/src/database/read-replica.service.ts
import { Injectable } from '@nestjs/common';
import { DataSource } from 'typeorm';

@Injectable()
export class ReadReplicaService {
  private primaryDataSource: DataSource;
  private replicaDataSources: DataSource[] = [];
  
  constructor() {
    this.initializeDataSources();
  }
  
  private async initializeDataSources() {
    // Primary database (write operations)
    this.primaryDataSource = new DataSource({
      type: 'postgres',
      host: process.env.DB_PRIMARY_HOST,
      port: parseInt(process.env.DB_PORT || '5432'),
      username: process.env.DB_USERNAME,
      password: process.env.DB_PASSWORD,
      database: process.env.DB_NAME,
      entities: ['src/**/*.entity.ts'],
      synchronize: false,
      logging: process.env.NODE_ENV === 'development',
    });
    
    await this.primaryDataSource.initialize();
    
    // Read replicas (read operations)
    const replicaHosts = process.env.DB_REPLICA_HOSTS?.split(',') || [];
    
    for (const host of replicaHosts) {
      const replicaDataSource = new DataSource({
        type: 'postgres',
        host: host.trim(),
        port: parseInt(process.env.DB_PORT || '5432'),
        username: process.env.DB_USERNAME,
        password: process.env.DB_PASSWORD,
        database: process.env.DB_NAME,
        entities: ['src/**/*.entity.ts'],
        synchronize: false,
        logging: false, // Disable logging for replicas
      });
      
      await replicaDataSource.initialize();
      this.replicaDataSources.push(replicaDataSource);
    }
  }
  
  getReadDataSource(): DataSource {
    // Round-robin selection of replica
    if (this.replicaDataSources.length === 0) {
      return this.primaryDataSource;
    }
    
    const randomIndex = Math.floor(Math.random() * this.replicaDataSources.length);
    return this.replicaDataSources[randomIndex];
  }
  
  getWriteDataSource(): DataSource {
    return this.primaryDataSource;
  }
  
  async query<T>(sql: string, parameters?: any[]): Promise<T[]> {
    // Determine if query is read or write
    const isReadQuery = sql.trim().toLowerCase().startsWith('select');
    
    const dataSource = isReadQuery ? this.getReadDataSource() : this.getWriteDataSource();
    
    return dataSource.query(sql, parameters);
  }
}
```

---

## CONCLUSION

This comprehensive technology stack recommendation document provides a complete roadmap for implementing the Saffron Bakery & Dairy e-commerce platform with 100% fulfillment of all specified requirements. The recommendations are specifically tailored for:

1. **Solo Developer Efficiency**: MCP server integration, advanced HMR, automated workflows, and comprehensive debugging tools
2. **Bangladesh Market Optimization**: Native payment gateway integration, bilingual support, network optimization, and regulatory compliance
3. **Performance and Scalability**: Multi-level caching, database optimization, horizontal scaling, and performance monitoring
4. **Security Excellence**: Comprehensive security configurations, payment security, and data protection

### Implementation Priority

1. **Phase 1 (Months 1-3)**: Core technology stack setup, local development environment, and basic functionality
2. **Phase 2 (Months 4-6)**: Advanced features, payment integration, and performance optimization
3. **Phase 3 (Months 7-9)**: Security hardening, scalability features, and production deployment

### Success Metrics

- **Development Efficiency**: 50% faster development with MCP server and advanced HMR
- **Performance**: <2 second page load times on 4G networks
- **Security**: Zero critical vulnerabilities in security audits
- **Bangladesh Optimization**: 95% successful payment transactions with local methods
- **Scalability**: Support for 10x traffic growth without performance degradation

This technology stack provides a solid foundation for building a world-class e-commerce platform that meets all requirements while optimizing for the unique challenges of the Bangladesh market and solo development workflow.

---

**Document prepared with extensive research and industry best practices for e-commerce platforms in Bangladesh and globally.**

**Recommended for immediate implementation.**

**Last Updated:** December 2, 2025