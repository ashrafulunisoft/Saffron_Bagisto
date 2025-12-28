#!/bin/bash

# Roo Code Ollama Setup Script
# This script helps set up Ollama for Roo Code embedder service

set -e

echo "=========================================="
echo "Roo Code Ollama Setup Script"
echo "=========================================="
echo ""

# Check if Ollama is installed
if ! command -v ollama &> /dev/null; then
    echo "Ollama is not installed. Installing..."

    # Detect OS
    if [[ "$OSTYPE" == "linux-gnu"* ]]; then
        echo "Detected Linux. Installing Ollama..."
        curl -fsSL https://ollama.com/install.sh | sh
    elif [[ "$OSTYPE" == "darwin"* ]]; then
        echo "Detected macOS. Please install Ollama using Homebrew:"
        echo "  brew install ollama"
        exit 1
    else
        echo "Unsupported OS. Please install Ollama manually from https://ollama.com/download"
        exit 1
    fi

    echo "Ollama installed successfully!"
else
    echo "Ollama is already installed."
fi

echo ""
echo "Pulling nomic-embed-text model..."
ollama pull nomic-embed-text

echo ""
echo "Starting Ollama service..."
# Start Ollama in background
ollama serve > /dev/null 2>&1 &
OLLAMA_PID=$!

echo "Waiting for Ollama to start..."
sleep 5

# Check if Ollama is running
if curl -s http://localhost:11434/api/tags > /dev/null 2>&1; then
    echo "✓ Ollama is running successfully!"
    echo ""
    echo "Available models:"
    curl -s http://localhost:11434/api/tags | grep -o '"name":"[^"]*"' | cut -d'"' -f4
    echo ""
    echo "=========================================="
    echo "Setup complete!"
    echo "=========================================="
    echo ""
    echo "Ollama is now running in the background (PID: $OLLAMA_PID)"
    echo "To stop Ollama, run: kill $OLLAMA_PID"
    echo ""
    echo "You can now use Roo Code with the local embedder service."
    echo ""
    echo "To start Ollama automatically on boot, add this to your startup script:"
    echo "  ollama serve &"
else
    echo "✗ Failed to start Ollama. Please check the logs."
    kill $OLLAMA_PID 2>/dev/null || true
    exit 1
fi
