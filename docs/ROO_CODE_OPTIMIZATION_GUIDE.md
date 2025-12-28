# Roo Code Optimization Guide
## Quadrant Vector DB + Ollama (nomic-embed-text) Setup

This guide provides comprehensive instructions for optimizing Roo Code performance with Quadrant vector database and Ollama embedding service for large codebases.

---

## Table of Contents

1. [Overview](#overview)
2. [Prerequisites](#prerequisites)
3. [Quick Start](#quick-start)
4. [Configuration](#configuration)
5. [Performance Tuning](#performance-tuning)
6. [Troubleshooting](#troubleshooting)
7. [Best Practices](#best-practices)

---

## Overview

This optimized setup includes:

- **Quadrant Vector Database**: High-performance vector similarity search with HNSW indexing
- **Ollama Embedder**: Local embedding service using nomic-embed-text model
- **Optimized Settings**: Fine-tuned configuration for large codebases
- **Auto-start Services**: Systemd service for Ollama
- **Performance Monitoring**: Built-in health checks and optimization scripts

### Key Features

| Feature | Benefit |
|----------|----------|
| HNSW Indexing | Fast approximate nearest neighbor search |
| Vector Compression | Reduced memory usage |
| Connection Pooling | Efficient resource utilization |
| Incremental Indexing | Only re-index changed files |
| Semantic Chunking | Better code understanding |
| Hybrid Search | Combines semantic and keyword search |
| Query Caching | Faster repeated queries |

---

## Prerequisites

### System Requirements

- **Operating System**: Linux (Ubuntu 20.04+, Debian 11+, or similar)
- **Memory**: Minimum 4GB RAM (8GB+ recommended)
- **Disk Space**: 10GB+ free space
- **Docker**: Required for Quadrant vector DB
- **VS Code**: Latest version with Roo Code extension

### Software Requirements

```bash
# Check if Docker is installed
docker --version

# Check if Ollama is installed
ollama --version

# Check if VS Code is installed
code --version
```

---

## Quick Start

### Step 1: Install Ollama

```bash
# Run the setup script
chmod +x scripts/setup-ollama.sh
./scripts/setup-ollama.sh
```

Or install manually:

```bash
# Install Ollama
curl -fsSL https://ollama.com/install.sh | sh

# Pull the embedding model
ollama pull nomic-embed-text

# Start Ollama
ollama serve
```

### Step 2: Start Quadrant Vector DB

```bash
# Pull and run Quadrant
docker run -d \
  -p 6333:6333 \
  -v $(pwd)/storage/vector_db:/qdrant/storage \
  --name qdrant \
  qdrant/qdrant:latest
```

### Step 3: Setup Ollama Systemd Service

```bash
# Run the systemd setup script
chmod +x scripts/ollama-systemd-service.sh
sudo ./scripts/ollama-systemd-service.sh
```

This will:
- Create a systemd service for Ollama
- Enable auto-start on boot
- Configure resource limits
- Set up proper security settings

### Step 4: Run Performance Optimization

```bash
# Run the optimization script
chmod +x scripts/optimize-roocode-performance.sh
./scripts/optimize-roocode-performance.sh
```

This will:
- Check Ollama and Quadrant status
- Create necessary directories
- Set proper permissions
- Clean old logs
- Test all services
- Provide performance recommendations

### Step 5: Reload VS Code

1. Open VS Code
2. Press `Ctrl+Shift+P`
3. Type "Reload Window"
4. Press Enter

### Step 6: Re-index Codebase

1. Press `Ctrl+Shift+P`
2. Type "Roo Code: Re-index"
3. Press Enter

---

## Configuration

### Vector Database Settings

Located in [`.vscode/settings.json`](../.vscode/settings.json):

```json
{
  "rooCode.vectorDatabase.type": "quadrant",
  "rooCode.vectorDatabase.host": "localhost",
  "rooCode.vectorDatabase.port": 6333,
  "rooCode.vectorDatabase.collectionName": "saffron_codebase",
  "rooCode.vectorDatabase.dimension": 768,
  "rooCode.vectorDatabase.distanceMetric": "cosine",
  "rooCode.vectorDatabase.indexType": "hnsw",
  "rooCode.vectorDatabase.hnswParams": {
    "m": 32,
    "efConstruction": 200,
    "efSearch": 128
  }
}
```

#### HNSW Parameters Explained

| Parameter | Description | Recommended Value |
|-----------|-------------|-------------------|
| `m` | Number of bi-directional links per node | 16-64 (higher = better recall, more memory) |
| `efConstruction` | Size of dynamic candidate list during index building | 100-400 (higher = better quality, slower build) |
| `efSearch` | Size of dynamic candidate list during search | 50-200 (higher = better recall, slower search) |

### Embedder Settings

```json
{
  "rooCode.embedder.serviceUrl": "http://localhost:11434",
  "rooCode.embedder.serviceType": "ollama",
  "rooCode.embedder.model": "nomic-embed-text",
  "rooCode.embedder.timeout": 120000,
  "rooCode.embedder.maxRetries": 10,
  "rooCode.embedder.batchSize": 50,
  "rooCode.embedder.maxConcurrentRequests": 3
}
```

### Indexing Settings

```json
{
  "rooCode.indexing.maxFileSize": 5242880,
  "rooCode.indexing.batchSize": 50,
  "rooCode.indexing.timeout": 120000,
  "rooCode.indexing.parallelProcessing": true,
  "rooCode.indexing.incrementalIndexing": true,
  "rooCode.indexing.enableChunking": true,
  "rooCode.indexing.chunkSize": 1000,
  "rooCode.indexing.chunkOverlap": 200,
  "rooCode.indexing.enableSemanticChunking": true
}
```

### Performance Settings

```json
{
  "rooCode.performance.enableCaching": true,
  "rooCode.performance.cacheSize": 2000,
  "rooCode.performance.maxMemoryUsage": 1024,
  "rooCode.performance.enableConnectionPooling": true,
  "rooCode.performance.maxPoolSize": 10
}
```

---

## Performance Tuning

### For Low Memory Systems (< 4GB RAM)

Reduce these settings in [`.vscode/settings.json`](../.vscode/settings.json):

```json
{
  "rooCode.performance.cacheSize": 500,
  "rooCode.performance.maxMemoryUsage": 512,
  "rooCode.indexing.batchSize": 25,
  "rooCode.embedder.batchSize": 25,
  "rooCode.embedder.maxConcurrentRequests": 2
}
```

### For High Memory Systems (8GB+ RAM)

Increase these settings:

```json
{
  "rooCode.performance.cacheSize": 3000,
  "rooCode.performance.maxMemoryUsage": 2048,
  "rooCode.indexing.batchSize": 100,
  "rooCode.embedder.batchSize": 100,
  "rooCode.embedder.maxConcurrentRequests": 5
}
```

### For Faster Indexing

```json
{
  "rooCode.indexing.parallelProcessing": true,
  "rooCode.indexing.maxConcurrentRequests": 5,
  "rooCode.embedder.maxConcurrentRequests": 5
}
```

### For Better Search Quality

```json
{
  "rooCode.vectorDatabase.hnswParams": {
    "m": 64,
    "efConstruction": 400,
    "efSearch": 200
  },
  "rooCode.query.enableReranking": true,
  "rooCode.query.enableHybridSearch": true
}
```

---

## Troubleshooting

### Ollama Issues

#### Ollama Not Running

```bash
# Check status
sudo systemctl status ollama

# Start service
sudo systemctl start ollama

# View logs
sudo journalctl -u ollama -f
```

#### Model Not Found

```bash
# Pull the model
ollama pull nomic-embed-text

# List available models
ollama list
```

#### Connection Timeout

Increase timeout in [`.vscode/settings.json`](../.vscode/settings.json):

```json
{
  "rooCode.embedder.timeout": 180000
}
```

### Quadrant Issues

#### Quadrant Not Running

```bash
# Check if container is running
docker ps | grep qdrant

# Start container
docker start qdrant

# View logs
docker logs qdrant
```

#### Connection Failed

```bash
# Check if port is accessible
curl http://localhost:6333/health

# Check container status
docker ps -a | grep qdrant
```

### Indexing Issues

#### Indexing Fails

1. Check logs: `tail -f storage/logs/roocode.log`
2. Reduce batch size in settings
3. Increase timeout in settings
4. Exclude problematic files in [`.vscode/.vscodeignore`](../.vscode/.vscodeignore)

#### Slow Indexing

1. Reduce batch size
2. Disable parallel processing temporarily
3. Exclude more directories
4. Check system resources

### Performance Issues

#### High Memory Usage

```bash
# Check memory usage
free -h

# Reduce cache size in settings
"rooCode.performance.cacheSize": 500
```

#### Slow Queries

```bash
# Check Quadrant performance
curl http://localhost:6333/collections

# Reduce efSearch parameter
"rooCode.vectorDatabase.hnswParams.efSearch": 64
```

---

## Best Practices

### 1. Keep Services Running

Keep Ollama and Quadrant running at all times to avoid startup overhead:

```bash
# Check Ollama status
sudo systemctl status ollama

# Check Quadrant status
docker ps | grep qdrant
```

### 2. Use Incremental Indexing

Enable incremental indexing to only re-index changed files:

```json
{
  "rooCode.indexing.incrementalIndexing": true,
  "rooCode.indexing.autoReindex": false
}
```

### 3. Exclude Unnecessary Files

Use [`.vscode/.vscodeignore`](../.vscode/.vscodeignore) to exclude:
- Vendor directories
- Node modules
- Build artifacts
- Log files
- Temporary files

### 4. Monitor Performance

Regularly check logs and performance metrics:

```bash
# View Roo Code logs
tail -f storage/logs/roocode.log

# View Ollama logs
sudo journalctl -u ollama -f

# View Quadrant logs
docker logs qdrant -f
```

### 5. Clear Cache Periodically

Clear cache when performance degrades:

1. Press `Ctrl+Shift+P`
2. Type "Roo Code: Clear Cache"
3. Press Enter

### 6. Optimize for Your Use Case

- **Development**: Use smaller cache, faster indexing
- **Code Review**: Use larger cache, better search quality
- **Documentation**: Enable semantic chunking, hybrid search

### 7. Regular Maintenance

Run the optimization script weekly:

```bash
./scripts/optimize-roocode-performance.sh
```

---

## Service Management

### Ollama Service Commands

```bash
# Start
sudo systemctl start ollama

# Stop
sudo systemctl stop ollama

# Restart
sudo systemctl restart ollama

# Status
sudo systemctl status ollama

# Enable on boot
sudo systemctl enable ollama

# Disable on boot
sudo systemctl disable ollama

# View logs
sudo journalctl -u ollama -f
```

### Quadrant Container Commands

```bash
# Start
docker start qdrant

# Stop
docker stop qdrant

# Restart
docker restart qdrant

# Status
docker ps | grep qdrant

# View logs
docker logs qdrant

# Remove
docker rm qdrant

# Re-create
docker run -d -p 6333:6333 -v $(pwd)/storage/vector_db:/qdrant/storage --name qdrant qdrant/qdrant:latest
```

---

## API Endpoints

### Ollama API

```bash
# List models
curl http://localhost:11434/api/tags

# Generate embedding
curl -X POST http://localhost:11434/api/embeddings \
  -H "Content-Type: application/json" \
  -d '{"model": "nomic-embed-text", "prompt": "Your text here"}'

# Health check
curl http://localhost:11434/api/tags
```

### Quadrant API

```bash
# Health check
curl http://localhost:6333/health

# List collections
curl http://localhost:6333/collections

# Collection info
curl http://localhost:6333/collections/saffron_codebase

# Search
curl -X POST http://localhost:6333/collections/saffron_codebase/points/search \
  -H "Content-Type: application/json" \
  -d '{"vector": [0.1, 0.2, ...], "limit": 10}'
```

---

## File Structure

```
saffron-backend-3/
├── .vscode/
│   ├── settings.json          # Roo Code configuration
│   └── .vscodeignore        # Files to exclude from indexing
├── storage/
│   ├── logs/
│   │   └── roocode.log      # Roo Code logs
│   └── vector_db/            # Quadrant storage
├── scripts/
│   ├── setup-ollama.sh        # Ollama installation script
│   ├── ollama-systemd-service.sh  # Systemd service setup
│   └── optimize-roocode-performance.sh  # Performance optimization
└── docs/
    ├── ROO_CODE_OPTIMIZATION_GUIDE.md  # This file
    └── ROO_CODE_TROUBLESHOOTING.md  # Troubleshooting guide
```

---

## Additional Resources

- [Roo Code Documentation](https://github.com/yourusername/roocode)
- [Ollama Documentation](https://ollama.com/docs)
- [Quadrant Documentation](https://qdrant.tech/documentation/)
- [nomic-embed-text Model](https://ollama.com/library/nomic-embed-text)

---

## Support

For issues or questions:

1. Check [ROO_CODE_TROUBLESHOOTING.md](ROO_CODE_TROUBLESHOOTING.md)
2. Review logs in `storage/logs/roocode.log`
3. Check Ollama logs: `sudo journalctl -u ollama -n 50`
4. Check Quadrant logs: `docker logs qdrant -n 50`

---

## Version History

| Version | Date | Changes |
|---------|--------|----------|
| 1.0.0 | 2024-12-24 | Initial release with Quadrant + Ollama optimization |

---

**Last Updated**: 2024-12-24
