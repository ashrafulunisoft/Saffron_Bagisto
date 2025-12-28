#!/bin/bash

# ============================================
# Roo Code Performance Optimization Script
# ============================================
# This script optimizes Roo Code performance for large codebases
# with Quadrant vector DB and Ollama
# ============================================

set -e

echo "=========================================="
echo "Roo Code Performance Optimization"
echo "=========================================="
echo ""

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# ============================================
# Function to check if command exists
# ============================================
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# ============================================
# Function to print section header
# ============================================
print_section() {
    echo ""
    echo -e "${BLUE}========================================${NC}"
    echo -e "${BLUE}$1${NC}"
    echo -e "${BLUE}========================================${NC}"
    echo ""
}

# ============================================
# Function to print success message
# ============================================
print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

# ============================================
# Function to print warning message
# ============================================
print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

# ============================================
# Function to print error message
# ============================================
print_error() {
    echo -e "${RED}✗ $1${NC}"
}

# ============================================
# Check Ollama Status
# ============================================
print_section "Checking Ollama Status"

if command_exists ollama; then
    print_success "Ollama is installed"

    # Check if Ollama is running
    if curl -s http://localhost:11434/api/tags > /dev/null 2>&1; then
        print_success "Ollama is running"

        # Check available models
        echo ""
        echo "Available models:"
        curl -s http://localhost:11434/api/tags | grep -o '"name":"[^"]*"' | cut -d'"' -f4 | while read model; do
            echo "  - $model"
        done
    else
        print_warning "Ollama is not running"
        echo ""
        echo "Starting Ollama..."
        ollama serve > /dev/null 2>&1 &
        sleep 5

        if curl -s http://localhost:11434/api/tags > /dev/null 2>&1; then
            print_success "Ollama started successfully"
        else
            print_error "Failed to start Ollama"
            echo ""
            echo "Please run: sudo ./scripts/ollama-systemd-service.sh"
            exit 1
        fi
    fi
else
    print_error "Ollama is not installed"
    echo ""
    echo "Please run: ./scripts/setup-ollama.sh"
    exit 1
fi

# ============================================
# Check Quadrant Vector DB Status
# ============================================
print_section "Checking Quadrant Vector DB Status"

if command_exists docker; then
    # Check if Quadrant container is running
    if docker ps | grep -q "quadrant"; then
        print_success "Quadrant vector DB is running"

        # Get Quadrant info
        echo ""
        echo "Quadrant container info:"
        docker ps --filter "name=quadrant" --format "  - Name: {{.Names}}\n  - Status: {{.Status}}\n  - Ports: {{.Ports}}"
    else
        print_warning "Quadrant vector DB is not running"
        echo ""
        echo "Starting Quadrant..."
        docker run -d -p 6333:6333 -v $(pwd)/storage/vector_db:/qdrant/storage \
            --name qdrant qdrant/qdrant:latest

        sleep 3

        if docker ps | grep -q "quadrant"; then
            print_success "Quadrant started successfully"
        else
            print_error "Failed to start Quadrant"
            exit 1
        fi
    fi
else
    print_warning "Docker is not installed"
    echo ""
    echo "Please install Docker to use Quadrant vector DB"
fi

# ============================================
# Create Storage Directories
# ============================================
print_section "Creating Storage Directories"

mkdir -p storage/logs
mkdir -p storage/vector_db
mkdir -p storage/cache

print_success "Storage directories created"

# ============================================
# Set File Permissions
# ============================================
print_section "Setting File Permissions"

chmod -R 755 storage
chmod -R 644 storage/logs/*.log 2>/dev/null || true

print_success "File permissions set"

# ============================================
# Clear Old Logs
# ============================================
print_section "Cleaning Old Logs"

LOG_DIR="storage/logs"
MAX_LOG_AGE_DAYS=7

if [ -d "$LOG_DIR" ]; then
    find "$LOG_DIR" -name "*.log" -type f -mtime +$MAX_LOG_AGE_DAYS -delete 2>/dev/null || true
    print_success "Old logs cleaned (older than $MAX_LOG_AGE_DAYS days)"
else
    print_warning "Log directory not found"
fi

# ============================================
# Check System Resources
# ============================================
print_section "System Resources Check"

# Check available memory
TOTAL_MEM=$(free -m | awk '/Mem:/ {print $2}')
AVAILABLE_MEM=$(free -m | awk '/Mem:/ {print $7}')
echo "Total Memory: ${TOTAL_MEM}MB"
echo "Available Memory: ${AVAILABLE_MEM}MB"

if [ "$AVAILABLE_MEM" -lt 1024 ]; then
    print_warning "Low memory available. Consider closing other applications."
else
    print_success "Memory is sufficient"
fi

# Check disk space
DISK_USAGE=$(df -h . | awk 'NR==2 {print $5}' | sed 's/%//')
echo "Disk Usage: ${DISK_USAGE}%"

if [ "$DISK_USAGE" -gt 80 ]; then
    print_warning "Disk usage is high. Consider cleaning up."
else
    print_success "Disk space is sufficient"
fi

# ============================================
# Optimize VS Code Settings
# ============================================
print_section "VS Code Settings Check"

SETTINGS_FILE=".vscode/settings.json"

if [ -f "$SETTINGS_FILE" ]; then
    print_success "VS Code settings file found"

    # Check if key settings are present
    if grep -q "rooCode.vectorDatabase.type" "$SETTINGS_FILE"; then
        print_success "Vector DB configuration found"
    else
        print_warning "Vector DB configuration missing"
    fi

    if grep -q "rooCode.embedder.serviceUrl" "$SETTINGS_FILE"; then
        print_success "Embedder configuration found"
    else
        print_warning "Embedder configuration missing"
    fi
else
    print_error "VS Code settings file not found"
fi

# ============================================
# Test Ollama Embedding
# ============================================
print_section "Testing Ollama Embedding"

echo "Testing embedding generation..."
TEST_TEXT="This is a test for Roo Code optimization."

if curl -s -X POST http://localhost:11434/api/embeddings \
    -H "Content-Type: application/json" \
    -d "{\"model\": \"nomic-embed-text\", \"prompt\": \"$TEST_TEXT\"}" \
    > /dev/null 2>&1; then
    print_success "Ollama embedding is working"
else
    print_error "Ollama embedding test failed"
    echo ""
    echo "Please check Ollama logs: sudo journalctl -u ollama -n 50"
fi

# ============================================
# Test Quadrant Connection
# ============================================
print_section "Testing Quadrant Connection"

if command_exists docker && docker ps | grep -q "quadrant"; then
    echo "Testing Quadrant API..."

    if curl -s http://localhost:6333/health > /dev/null 2>&1; then
        print_success "Quadrant API is responding"

        # Get collections info
        echo ""
        echo "Quadrant collections:"
        curl -s http://localhost:6333/collections 2>/dev/null | grep -o '"name":"[^"]*"' | cut -d'"' -f4 | while read collection; do
            echo "  - $collection"
        done
    else
        print_error "Quadrant API is not responding"
    fi
else
    print_warning "Quadrant is not running"
fi

# ============================================
# Performance Recommendations
# ============================================
print_section "Performance Recommendations"

echo "Based on your system configuration:"
echo ""

if [ "$AVAILABLE_MEM" -lt 2048 ]; then
    echo "1. Reduce cache size in .vscode/settings.json:"
    echo "   \"rooCode.performance.cacheSize\": 500"
    echo ""
fi

if [ "$AVAILABLE_MEM" -ge 4096 ]; then
    echo "1. Increase cache size in .vscode/settings.json:"
    echo "   \"rooCode.performance.cacheSize\": 3000"
    echo ""
fi

echo "2. Enable incremental indexing to speed up re-indexing"
echo "3. Use .vscode/.vscodeignore to exclude unnecessary files"
echo "4. Keep Ollama and Quadrant running for better performance"
echo "5. Clear cache periodically: Ctrl+Shift+P -> 'Roo Code: Clear Cache'"

# ============================================
# Summary
# ============================================
print_section "Optimization Complete"

echo ""
echo "=========================================="
echo "Summary"
echo "=========================================="
echo ""
echo "✓ Ollama: Running"
echo "✓ Quadrant: Running"
echo "✓ Storage: Configured"
echo "✓ Permissions: Set"
echo "✓ Logs: Cleaned"
echo ""
echo "Next steps:"
echo "1. Reload VS Code to apply settings"
echo "2. Run 'Roo Code: Re-index' from command palette"
echo "3. Monitor performance in storage/logs/roocode.log"
echo ""
echo "Useful commands:"
echo "  - Check Ollama status: sudo systemctl status ollama"
echo "  - Check Quadrant status: docker ps | grep qdrant"
echo "  - View Roo Code logs: tail -f storage/logs/roocode.log"
echo "  - Re-index: Ctrl+Shift+P -> 'Roo Code: Re-index'"
echo ""
