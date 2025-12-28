# Roo Code Troubleshooting Guide

## Common Issues and Solutions

### Issue: "Failed to connect to embedder service"

**Error Message:**
```
Error - Failed during initial scan: Indexing partially failed: Only 14671 of 51751 blocks were indexed. 
Failed to process batch after 3 attempts: Failed to connect to embedder service.
```

**Cause:** Roo Code cannot connect to the local embedder service (Ollama).

**Solutions:**

#### Solution 1: Install and Run Ollama (Recommended)

1. **Run the setup script:**
   ```bash
   ./scripts/setup-ollama.sh
   ```

2. **Or install manually:**
   ```bash
   # Install Ollama
   curl -fsSL https://ollama.com/install.sh | sh
   
   # Pull the embedding model
   ollama pull nomic-embed-text
   
   # Start Ollama
   ollama serve
   ```

3. **Verify Ollama is running:**
   ```bash
   curl http://localhost:11434/api/tags
   ```

#### Solution 2: Use Cloud Embedder

If you don't want to use local Ollama:

1. Open `.vscode/settings.json`
2. Change `"rooCode.embedder.useLocalEmbedder": true` to `false`
3. Remove or comment out the `"rooCode.embedder.serviceUrl"` line
4. Reload VS Code

#### Solution 3: Check Port Availability

Ensure port 11434 is not blocked:

```bash
# Check if port is in use
netstat -tuln | grep 11434

# Or using lsof
lsof -i :11434
```

If another service is using port 11434, either:
- Stop that service, or
- Change the port in `.vscode/settings.json`:
  ```json
  "rooCode.embedder.serviceUrl": "http://localhost:11435"
  ```

#### Solution 4: Check Firewall

Ensure port 11434 is allowed through your firewall:

```bash
# UFW (Ubuntu)
sudo ufw allow 11434/tcp

# firewalld (CentOS/RHEL)
sudo firewall-cmd --add-port=11434/tcp --permanent
sudo firewall-cmd --reload
```

---

### Issue: Slow Indexing

**Cause:** Too many files being indexed or large files.

**Solutions:**

1. **Exclude more directories** in `.vscode/.vscodeignore`:
   ```
   packages/Webkul/Installer/src/Resources/assets/**
   packages/Webkul/Installer/src/Data/**
   ```

2. **Reduce batch size** in `.vscode/settings.json`:
   ```json
   "rooCode.indexing.batchSize": 50
   ```

3. **Increase timeout** in `.vscode/settings.json`:
   ```json
   "rooCode.indexing.timeout": 60000
   ```

---

### Issue: High Memory Usage

**Cause:** Roo Code is caching too much data.

**Solutions:**

1. **Reduce cache size** in `.vscode/settings.json`:
   ```json
   "rooCode.performance.cacheSize": 500
   ```

2. **Reduce max memory usage** in `.vscode/settings.json`:
   ```json
   "rooCode.performance.maxMemoryUsage": 256
   ```

3. **Clear cache manually:**
   - Open Roo Code panel
   - Click "Clear Cache"
   - Re-index if needed

---

### Issue: Indexing Fails on Specific Files

**Cause:** Large files or files with special characters.

**Solutions:**

1. **Check log file:**
   ```bash
   tail -f storage/logs/roocode.log
   ```

2. **Exclude problematic files** in `.vscode/.vscodeignore`:
   ```
   path/to/problematic/file.php
   ```

3. **Increase max file size** in `.vscode/settings.json`:
   ```json
   "rooCode.indexing.maxFileSize": 2097152
   ```

---

### Issue: Ollama Model Not Found

**Error Message:**
```
Error: model 'nomic-embed-text' not found
```

**Solution:**

Pull the required model:
```bash
ollama pull nomic-embed-text
```

Or use a different model in `.vscode/settings.json`:
```json
"rooCode.embedder.model": "all-minilm"
```

---

### Issue: Ollama Service Won't Start

**Solutions:**

1. **Check if Ollama is already running:**
   ```bash
   ps aux | grep ollama
   ```

2. **Kill existing Ollama process:**
   ```bash
   pkill ollama
   ```

3. **Start Ollama with verbose output:**
   ```bash
   ollama serve --verbose
   ```

4. **Check system logs:**
   ```bash
   journalctl -u ollama -f
   ```

---

## Quick Reference Commands

### Ollama Commands

```bash
# Start Ollama
ollama serve

# Pull a model
ollama pull nomic-embed-text

# List available models
ollama list

# Check Ollama status
curl http://localhost:11434/api/tags

# Stop Ollama
pkill ollama
```

### Roo Code Commands

In VS Code:
- `Ctrl+Shift+P` → "Roo Code: Re-index"
- `Ctrl+Shift+P` → "Roo Code: Clear Cache"
- `Ctrl+Shift+P` → "Roo Code: Show Logs"

---

## Getting Help

If you're still experiencing issues:

1. Check the Roo Code logs: `storage/logs/roocode.log`
2. Check the Ollama logs: `journalctl -u ollama`
3. Visit [Roo Code Documentation](https://github.com/yourusername/roocode)
4. Visit [Ollama Documentation](https://ollama.com/docs)

---

## Performance Tips

1. **Use incremental indexing** - Only changed files are re-indexed
2. **Disable startup indexing** - Index manually when needed
3. **Exclude unnecessary files** - Use `.vscode/.vscodeignore`
4. **Use local embedder** - Faster than cloud-based solutions
5. **Keep Ollama running** - Avoid startup overhead
