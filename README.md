# Checksum-Checker
Check if the checksum of a file is valid

```bash
# Just run it:
php checksum-checker.php <filepath> <algorithm:hash_checksum>

# Or build the phar archive and run it:
php scripts/create-phar.php
./checksum.phar

# (Optional) move the archive to PATH
sudo mv checksum.phar /usr/local/bin/checksum
```

### Example
```bash
php src/checksum-checker.php ~/Downloads/better-touch-linux-amd64-v1.2.0.tar.gz sha256:7ab2700441fc9d645f422f28956c5829dc060f1bf3d64560a57d9366aa25f765
```
