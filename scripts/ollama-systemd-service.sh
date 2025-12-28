#!/bin/bash

# ============================================
# Ollama Systemd Service Setup Script
# ============================================
# This script creates a systemd service for Ollama
# to auto-start on boot and manage the service properly
# ============================================

set -e

echo "=========================================="
echo "Ollama Systemd Service Setup"
echo "=========================================="
echo ""

# Check if running as root
if [ "$EUID" -ne 0 ]; then
    echo "Please run as root (use sudo)"
    exit 1
fi

# Get current user
CURRENT_USER=${SUDO_USER:-$USER}
echo "Setting up service for user: $CURRENT_USER"
echo ""

# Create systemd service file
SERVICE_FILE="/etc/systemd/system/ollama.service"

echo "Creating systemd service file at $SERVICE_FILE..."

cat > "$SERVICE_FILE" << EOF
[Unit]
Description=Ollama Service for Roo Code
After=network-online.target
Wants=network-online.target

[Service]
Type=simple
User=$CURRENT_USER
Group=$CURRENT_USER
Environment="OLLAMA_HOST=0.0.0.0"
Environment="OLLAMA_PORT=11434"
Environment="OLLAMA_NUM_THREAD=8"
Environment="OLLAMA_MAX_LOADED_MODELS=3"
Environment="OLLAMA_LOAD_TIMEOUT=5m"
Environment="OLLAMA_MODELS=/home/$CURRENT_USER/.ollama/models"
ExecStart=/usr/local/bin/ollama serve
Restart=always
RestartSec=10
StandardOutput=journal
StandardError=journal
SyslogIdentifier=ollama

# Security settings
NoNewPrivileges=true
PrivateTmp=true
ProtectSystem=strict
ProtectHome=true
ReadWritePaths=/home/$CURRENT_USER/.ollama

# Resource limits
LimitNOFILE=65536
LimitNPROC=4096
MemoryMax=4G

[Install]
WantedBy=multi-user.target
EOF

echo "✓ Service file created"
echo ""

# Reload systemd
echo "Reloading systemd daemon..."
systemctl daemon-reload
echo "✓ Systemd daemon reloaded"
echo ""

# Enable service
echo "Enabling Ollama service to start on boot..."
systemctl enable ollama.service
echo "✓ Service enabled"
echo ""

# Start service
echo "Starting Ollama service..."
systemctl start ollama.service
echo "✓ Service started"
echo ""

# Wait for service to be ready
echo "Waiting for Ollama to be ready..."
sleep 5

# Check service status
if systemctl is-active --quiet ollama.service; then
    echo "✓ Ollama service is running!"
    echo ""
    echo "=========================================="
    echo "Setup complete!"
    echo "=========================================="
    echo ""
    echo "Service commands:"
    echo "  Check status:  sudo systemctl status ollama"
    echo "  Start:        sudo systemctl start ollama"
    echo "  Stop:         sudo systemctl stop ollama"
    echo "  Restart:      sudo systemctl restart ollama"
    echo "  View logs:     sudo journalctl -u ollama -f"
    echo ""
    echo "Ollama API endpoint: http://localhost:11434"
    echo ""
    echo "To verify Ollama is working:"
    echo "  curl http://localhost:11434/api/tags"
    echo ""
else
    echo "✗ Failed to start Ollama service"
    echo ""
    echo "Check logs for errors:"
    echo "  sudo journalctl -u ollama -n 50"
    exit 1
fi
