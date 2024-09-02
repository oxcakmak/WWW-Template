<?php
class CatcHe
{
    private string $cacheDir;
    private int $defaultTtl;

    public function __construct(string $cacheDir, int $defaultTtl = 3600)
    {
        $this->cacheDir = rtrim($cacheDir, '/') . '/';
        $this->defaultTtl = $defaultTtl;

        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    public function get(string $key)
    {
        $cacheFile = $this->getCacheFile($key);
        if (!file_exists($cacheFile)) {
            return null;
        }

        $cacheData = file_get_contents($cacheFile);
        if (!$cacheData) {
            return null;
        }

        $data = unserialize($cacheData);
        if (!$data || $data['timestamp'] + $data['ttl'] < time()) {
            $this->delete($key);
            return null;
        }

        return $data['value'];
    }

    public function set(string $key, $value, int $ttl = null)
    {
        $ttl = $ttl ?? $this->defaultTtl;
        $cacheFile = $this->getCacheFile($key);
        $data = serialize(['value' => $value, 'timestamp' => time() + $ttl, 'ttl' => $ttl]);
        return file_put_contents($cacheFile, $data) !== false;
    }

    public function delete(string $key): bool
    {
        $cacheFile = $this->getCacheFile($key);
        return unlink($cacheFile);
    }

    public function clear(): bool
    {
        $files = glob($this->cacheDir . '*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
        return true;
    }

    private function getCacheFile(string $key): string
    {
        return $this->cacheDir . md5($key) . '.cache';
    }
}
?>
