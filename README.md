# PingMail by SoftMaji 📧

![Version](https://img.shields.io/badge/version-3.0.0-blue.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)
![Size](https://img.shields.io/badge/size-2KB-orange.svg)
![PHP](https://img.shields.io/badge/php-%3E%3D7.4-8892BF.svg)

**PingMail** is a lightweight, zero-dependency SMTP client for PHP. It uses raw `fsockopen` streams to communicate with mail servers, making it significantly faster and lighter than PHPMailer or SwiftMailer.

### 🚀 Why PingMail?
- **Tiny Footprint:** ~2KB vs PHPMailer's 200KB+.
- **Zero Dependencies:** No Composer required. Just drop the file and run.
- **Fast:** Direct TCP socket connection.
- **Secure:** Supports TLS 1.2/1.3 encryption automatically.

---

## 📦 Installation
Since PingMail is a single-file library, installation is simple.

1. **Download** the `PingMail.php` file from this repository.
2. **Include** it in your PHP script:

```php
require_once 'PingMail.php';
use SoftMaji\PingMail\PingMail;
