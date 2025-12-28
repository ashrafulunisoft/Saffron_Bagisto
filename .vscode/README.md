# Roo Code Configuration Guide

This directory contains configuration files to optimize Roo Code indexing and performance for the Saffron Bakery & Dairy Enterprise project.

## Files

- **settings.json** - Main VS Code and Roo Code configuration
- **.vscodeignore** - Files and directories to exclude from indexing

## Configuration Overview

### Indexing Exclusions

The following directories are excluded from indexing to improve performance:

- `vendor/` - PHP dependencies
- `node_modules/` - JavaScript dependencies
- `storage/` - Laravel storage directory
- `public/build/` - Compiled assets
- `bootstrap/cache/` - Bootstrap cache
- `lang/` - Language translation files
- `db_bkp/` - Database backups
- `tests/` - Test files (optional)

### Performance Settings

- **Batch Size**: 100 files per batch
- **Timeout**: 30 seconds per batch
- **Max File Size**: 1MB for indexing
- **Parallel Processing**: Enabled
- **Max Concurrent Requests**: 5
- **Cache Enabled**: Yes (1 hour TTL)

### Embedder Service Configuration

The embedder service is configured to use a local Ollama instance:

```json
{
  "rooCode.embedder.serviceUrl": "http://localhost:11434",
  "rooCode.embedder.model": "nomic-embed-text",
  "rooCode.embedder.timeout": 60000,
  "rooCode.embedder.maxRetries": 5,
  "rooCode.embedder.retryDelay": 2000
}
```

## Troubleshooting Embedder Service Issues

### Error: "Failed to connect to embedder service"

This error occurs when Roo Code cannot connect to the local embedder service (Ollama).

#### Solution 1: Install and Run Ollama

1. **Install Ollama**:
   ```bash
   # Linux
   curl -fsSL https://ollama.com/install.sh | sh
   
   # macOS
   brew install ollama
   
   # Windows
   # Download from https://ollama.com/download
   ```

2. **Pull the embedding model**:
   ```bash
   ollama pull nomic-embed-text
   ```

3. **Start Ollama**:
   ```bash
   ollama serve
   ```

4. **Verify Ollama is running**:
   ```bash
   curl http://localhost:11434/api/tags
   ```

#### Solution 2: Use Alternative Embedder

If you prefer not to use Ollama, you can configure Roo Code to use a different embedder:

1. Open VS Code Settings (Ctrl+,)
2. Search for "rooCode.embedder"
3. Change the service URL to your preferred embedder

#### Solution 3: Disable Local Embedder

If you want to use Roo Code's cloud-based embedder instead:

1. Open `.vscode/settings.json`
2. Change `"rooCode.embedder.useLocalEmbedder": true` to `false`
3. Remove or comment out the `"rooCode.embedder.serviceUrl"` line

#### Solution 4: Check Firewall/Network

Ensure that port 11434 is not blocked by your firewall:

```bash
# Check if port is listening
netstat -tuln | grep 11434

# Or using lsof
lsof -i :11434
```

## Re-indexing Your Project

After fixing the embedder service, you may need to re-index your project:

1. Open the Roo Code panel in VS Code
2. Click on "Re-index" or "Clear Cache"
3. Wait for the indexing to complete

## Monitoring Indexing Progress

Check the Roo Code logs for detailed information:

```bash
tail -f storage/logs/roocode.log
```

## Additional Tips

1. **Reduce Indexing Scope**: If indexing is still slow, consider excluding more directories in `.vscodeignore`

2. **Increase Memory**: If you have sufficient RAM, increase `rooCode.performance.maxMemoryUsage` in settings.json

3. **Disable Startup Indexing**: Set `rooCode.indexing.indexOnStartup` to `false` to index manually when needed

4. **Use Incremental Indexing**: Keep `rooCode.indexing.incrementalIndexing` enabled for faster updates

## Support

For more information about Roo Code configuration, visit:
- Roo Code Documentation
- Ollama Documentation: https://ollama.com/docs
