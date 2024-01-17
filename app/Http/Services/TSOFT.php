<?php

namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TSOFT
{
    public static string $apiUrl = '';

    private static string $username = '';

    private static string $password = '';

    private static string $token = '';

    public static array $user = [];

    public function __construct()
    {
        self::$apiUrl = config('panel.TSOFT.API_URL');
        self::$username = config('panel.TSOFT.API_USERNAME');
        self::$password = config('panel.TSOFT.API_PASSWORD');

        self::getToken();
    }

    /**
     * @return string
     */
    public static function getToken(): string
    {
        if (empty(self::$token)) {
            self::setToken();
        }

        return self::$token;
    }


    /**
     * @return void
     */
    private static function setToken(): void
    {
        if (Cache::has('TSOFT_USER')) {
            self::$user = Cache::get('TSOFT_USER');

            if (self::$user['expirationTime'] < Carbon::now()->format('d-m-Y H:i:s')) {
                self::$token = self::$user['token'];
                return;
            }
        }

        $response = self::getCurlResponse(self::$apiUrl . '/auth/login/' . self::$username, [
            'pass' => self::$password,
        ]);

        if ($response && $response['success']) {
            self::$user = $response['data'][0];
            self::$token = self::$user['token'];

            Cache::put('TSOFT_USER', self::$user, 60 * 60 * 24);
        } else {
            Log::channel('db')->error('TSOFT API Auth Error', ['user_id' => Auth::id()]);
        }
    }

    /**
     * @param int $start
     * @param int $limit
     * @param string $ids
     * @return array
     */
    public static function getProducts(int $start = 0, int $limit = 500, string $ids = ""): array
    {
        $data = array(
            'token' => self::getToken(),
            'start' => $start,
            'limit' => $limit,
        );

        if (!empty($ids)) {
            $data['ProductIds'] = $ids;
        }

        $response = self::getCurlResponse(self::$apiUrl . '/product/get', $data);

        if ($response && $response['success']) {
            return $response['data'];
        } else {
            Log::channel('db')->error('TSOFT API Product Error', ['user_id' => Auth::id()]);

            return [];
        }
    }

    /**
     * @param int $start
     * @param int $limit
     * @return array
     */
    public static function getCategories(int $start = 0, int $limit = 500): array
    {
        $response = self::getCurlResponse(self::$apiUrl . '/category/getCategories', array(
            'token' => self::getToken(),
            'start' => $start,
            'limit' => $limit,
        ));

        if ($response && $response['success']) {
            return $response['data'];
        } else {
            Log::channel('db')->error('TSOFT API Category Error', ['user_id' => Auth::id()]);

            return [];
        }
    }

    /**
     * @param int $start
     * @param int $limit
     * @return array
     */
    public static function getCustomers(int $start = 0, int $limit = 500): array
    {
        $response = self::getCurlResponse(self::$apiUrl . '/customer/getCustomers', array(
            'token' => self::getToken(),
            'start' => $start,
            'limit' => $limit,
        ));

        if ($response && $response['success']) {
            return $response['data'];
        } else {
            Log::channel('db')->error('TSOFT API Customer Error', ['user_id' => Auth::id()]);

            return [];
        }
    }

    private static function getCurlResponse($url, $data = [])
    {
        try {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            curl_close($ch);

            $json = json_decode($response, true);

            if (!$json) {
                Log::channel('db')->error('TSOFT API Error', ['user_id' => Auth::id()]);

                return [
                    'success' => false,
                    'message' => 'TSOFT API Error',
                ];
            }

            Log::channel('db')->info('TSOFT API Response', ['user_id' => Auth::id(), 'response' => $json]);

            return $json;
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['user_id' => Auth::id()]);

            return [
                'success' => false,
                'message' => $th->getMessage(),
            ];
        }

    }
}
