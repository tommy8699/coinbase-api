<?php

declare(strict_types=1);

namespace App\Model\Repositories;

final class CoinBaseService
{
    private const BASE_URL = 'https://api.coingecko.com/api/v3/coins/';

    public function getCompanyData(string $url)
    {

        $url = self::BASE_URL. $url;

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

        $data = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException('JSON decode error: ' . json_last_error_msg());
        }

        return $data;
    }

    public function getCoinBase()
    {
        try {
            $coinsList = $this->getCoinsList();
            $getCategoriesList = $this->getCategoriesList();
            bdump($coinsList);
            dumpe($getCategoriesList);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getCoinsList()
    {
        try {
            $url = 'coins/list';
            $coinsList = $this->getCompanyData($url);
            bdump($coinsList);
            return $coinsList;
        } 
        catch (Exception $e) {
            Debugger::log(json_encode($e), "coin_base");
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function getCategoriesList()
    {
        try {
            $url = 'coins/categories/list';
            $categoriesList = $this->getCompanyData($url);
            return $categoriesList;
        } 
        catch (Exception $e) {
            Debugger::log(json_encode($e), "coin_base");
            echo 'Error: ' . $e->getMessage();
        }
    }
}
