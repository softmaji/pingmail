<?php
namespace SoftMaji\PingMail;

class PingMail {
    private $socket;
    private $host;
    private $port;
    private $user;
    private $pass;
    private $secure;
    private $timeout = 15;
    private $logs = [];

    public function __construct($host, $port, $user, $pass, $secure = 'tls') {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;
        $this->secure = $secure;
    }

  
    private function readResponse() {
        $response = "";
        while ($line = fgets($this->socket, 512)) {
            $response .= $line;
            $this->logs[] = "SERVER: " . trim($line);
            
            
            if (substr($line, 3, 1) === " ") {
                return $line; 
            }
        }
        return false;
    }

    private function cmd($command, $expected_code) {
        $this->logs[] = "CLIENT: $command";
        fwrite($this->socket, $command . "\r\n");
        
        $response = $this->readResponse();
        
        if (!$response) {
            throw new \Exception("No response from server.");
        }

        $code = (int)substr($response, 0, 3);
        if ($code !== $expected_code) {
            throw new \Exception("SMTP Error ($code): $response");
        }
        
        return true;
    }

    public function send($to, $from, $subject, $body) {
        $this->logs = [];
        $protocol = ($this->secure === 'ssl') ? 'ssl://' : '';
        $this->socket = @fsockopen($protocol . $this->host, $this->port, $errno, $errstr, $this->timeout);
        
        if (!$this->socket) {
            throw new \Exception("Connection Failed: $errstr ($errno)");
        }

        $this->readResponse(); 


        $this->cmd("EHLO " . $_SERVER['HTTP_HOST'], 250);

        if ($this->secure === 'tls') {
            $this->cmd("STARTTLS", 220);
            if (!stream_socket_enable_crypto($this->socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                throw new \Exception("TLS Handshake Failed");
            }
            $this->cmd("EHLO " . $_SERVER['HTTP_HOST'], 250);
        }

        // Auth
        $this->cmd("AUTH LOGIN", 334);
        $this->cmd(base64_encode($this->user), 334);
        $this->cmd(base64_encode($this->pass), 235);

        // Data
        $this->cmd("MAIL FROM:<$from>", 250);
        $this->cmd("RCPT TO:<$to>", 250);
        $this->cmd("DATA", 354);

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Date: " . date('r') . "\r\n";
        $headers .= "From: PingMail Tester <$from>\r\n";
        $headers .= "To: $to\r\n";
        $headers .= "Subject: $subject\r\n";
        $headers .= "X-Mailer: PingMail-SoftMaji-v2\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n\r\n";

        fwrite($this->socket, $headers . $body . "\r\n.\r\n");
        $this->readResponse();

        $this->cmd("QUIT", 221);
        fclose($this->socket);
        
        return true;
    }

    public function getDebugLog() {
        return $this->logs;
    }
}
