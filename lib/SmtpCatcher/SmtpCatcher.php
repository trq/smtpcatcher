<?php

namespace SmtpCatcher;

class SmtpCatcher
{
    protected $mail = '';
    protected $raw  = '';

    public function catchMail()
    {
        $this->parseMail(file_get_contents('php://stdin', 'r'));
        $this->writeFile();
    }

    public function serveMail()
    {
        echo "Visit: http://localhost:8100\n";
        chdir(__DIR__ . '/../../www');
        exec('php -S localhost:8100');
    }

    protected function parseMail($raw)
    {
        $this->raw = $raw;
        $lines     = explode("\n", $raw);

        $headers          = array();
        $to               = '';
        $from             = '';
        $subject          = '';
        $message          = '';
        $header           = true;

        for ($i=0; $i < count($lines); $i++) {
            if ($header) {
                $headers[] = $lines[$i];

                // look out for special headers

                if (preg_match("/^To: (.*)/", $lines[$i], $matches)) {
                    $to = trim($matches[1]);
                }

                if (preg_match("/^From: (.*)/", $lines[$i], $matches)) {
                    $from = trim($matches[1]);
                }

                if (preg_match("/^Subject: (.*)/", $lines[$i], $matches)) {
                    $subject = trim($matches[1]);
                }
            } else {
                $message .= $lines[$i] . "\n";
            }

            if (trim($lines[$i]) == "") {
                $header = false;
            }
        }

        $this->mail = compact('headers', 'to', 'from', 'subject', 'message', 'raw');
    }

    protected function writeFile()
    {
        $time = time();
        if (file_exists(__DIR__ . '/../../cache/database.json')) {
            $database = json_decode(file_get_contents(__DIR__ . '/../../cache/database.json'), true);
            $database[$time] = $this->mail;
        } else {
            $database = [];
            $database[$time] = $this->mail;
        }

        file_put_contents(__DIR__ . '/../../cache/database.json', json_encode($database));
        file_put_contents(__DIR__ . '/../../cache/raw-' . $time . '.txt', $this->raw);
    }
}
