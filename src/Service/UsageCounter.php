<?php

namespace Service;

use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Device;
use Sinergi\BrowserDetector\Os;

class UsageCounter
{
    public function detectBrowser(): array
    {
        $browser = new Browser();
        $os = new Os();
        $device = new Device();

        $platform = "{$os->getName()} {$os->getVersion()}, {$browser->getName()} {$browser->getVersion()}";
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"] ?? $this->getIp();

        $currentDateTime = new \DateTime('now', new \DateTimeZone('Europe/Moscow'));

        return [
            'device_name' => $device->getUserAgent()->getUserAgentString(),
            'device_os' => $platform,
            'device_ip' => $ip,
            'referer' => $_SERVER['HTTP_REFERER'] ?: '',
            'requested_url' => $_SERVER['REQUEST_URI'] ?: '',
            'created_at' => $currentDateTime->format(DATE_W3C)
        ];
    }

    public function getIp(): string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}