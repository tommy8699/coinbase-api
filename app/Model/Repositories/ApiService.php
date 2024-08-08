<?php

declare(strict_types=1);

namespace App\Model\Repositories;

final class ApiService
{
    private const BASE_URL = 'https://ares.gov.cz/ekonomicke-subjekty-v-be/rest/ekonomicke-subjekty/';

    public function getCompanyData(string $ico)
    {

        $url = self::BASE_URL . $ico;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error) {
            throw new RuntimeException('Curl error: ' . $error);
        }

        if ($httpCode !== 200) {
            throw new RuntimeException('HTTP error: ' . $httpCode);
        }

        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('JSON decode error: ' . json_last_error_msg());
        }

        return $data;
    }

    public function getWarehouseValue()
    {
        try {
            $ico = '01569651';
            $companyData = $this->getCompanyData($ico);
            dumpe($companyData);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
