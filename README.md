<div align="center">

  <img src="https://cdn.softmaji.in/assets/logo/softmaji/dark.webp" alt="SoftMaji Logo" width="200" />

  # PingMail PHP Library
  
  **The Ultra-Lightweight (2KB) SMTP Client for Modern PHP Applications.**
  
  [![Version](https://img.shields.io/badge/version-3.0.0-blue.svg?style=for-the-badge&logo=php)](https://github.com/softmaji/pingmail)
  [![License](https://img.shields.io/badge/license-MIT-green.svg?style=for-the-badge)](LICENSE)
  [![Size](https://img.shields.io/badge/size-2KB-orange.svg?style=for-the-badge)](PingMail.php)
  [![Downloads](https://img.shields.io/badge/downloads-10k%2B-lightgrey.svg?style=for-the-badge)](https://github.com/softmaji/pingmail)

  <p align="center">
    <a href="#-why-pingmail">Why Switch?</a> •
    <a href="#-installation">Installation</a> •
    <a href="#-quick-start">Quick Start</a> •
    <a href="#-api-reference">API Docs</a> •
    <a href="#-troubleshooting">Troubleshooting</a>
  </p>
</div>

---

## 🚀 Why PingMail?

Stop loading 200+ files just to send a transactional email. **PingMail** is a zero-dependency SMTP client that communicates directly with mail servers using raw `fsockopen` streams. It is engineered for microservices, legacy systems, and high-performance applications.

| Feature | PingMail ⚡ | PHPMailer 🐢 |
| :--- | :--- | :--- |
| **File Size** | **~2 KB** (Single File) | **~300 KB+** (Multiple Files) |
| **Dependencies** | **Zero** (Native PHP) | Requires Composer / Vendor |
| **Protocol** | Raw Socket Stream | Abstracted Layers |
| **Memory Usage** | Negligible | High |
| **Setup Time** | 30 Seconds | 5-10 Minutes |

---

## 📦 Installation

Since PingMail is a single-file library, you don't need Composer.

### Option 1: Direct Download (Recommended)
1. **Download** the `PingMail.php` file from this repository.
2. **Place it** in your project folder (e.g., `/lib/PingMail.php`).
3. **Require it** in your script:

```php
require_once 'lib/PingMail.php';
use SoftMaji\PingMail\PingMail;
