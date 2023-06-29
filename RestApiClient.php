<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class RestApiClient
{
  private $base_url;
  private $client;

  public function __construct(string $base_url)
  {
    $this->base_url = $base_url;
    $this->client = new Client(['base_uri' => $this->base_url]);
  }

  /**
   * Perform a GET request
   *
   * @param string $url
   * @param array $queries
   * @param string $token
   * @return array|string
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function get(string $url, array $queries = [], string $token = null)
  {
    try {
      $headers = ['Content-Type' => 'application/json'];
      if ($token) {
        $headers['Authorization'] = 'Bearer ' . $token;
      }
      $fullUrl = $this->base_url . '/' . $url;

      $response = $this->client->get($fullUrl, ['query' => $queries, 'headers' => $headers]);
      return $this->handleResponse($response);
    } catch (RequestException $e) {
      return $this->handleException($e);
    }
  }

  /**
   * Perform a POST request
   *
   * @param string $url
   * @param array $data
   * @param string $token
   * @return array|string
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function post(string $url, array $data, string $token = null)
  {
    try {
      $headers = ['Content-Type' => 'application/json'];
      if ($token) {
        $headers['Authorization'] = 'Bearer ' . $token;
      }
      $fullUrl = $this->base_url . '/' . $url;
      $response = $this->client->post($fullUrl, ['json' => $data, 'headers' => $headers]);
      return $this->handleResponse($response);
    } catch (RequestException $e) {
      return $this->handleException($e);
    }
  }

  /**
   * Perform a PUT request
   *
   * @param string $url
   * @param array $data
   * @param string $token
   * @return array|string
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function put(string $url, array $data, string $token = null)
  {
    try {
      $headers = ['Content-Type' => 'application/json'];
      if ($token) {
        $headers['Authorization'] = 'Bearer ' . $token;
      }
      $fullUrl = $this->base_url . '/' . $url;
      $response = $this->client->put($fullUrl, ['json' => $data, 'headers' => $headers]);
      return $this->handleResponse($response);
    } catch (RequestException $e) {
      return $this->handleException($e);
    }
  }

  /**
   * Perform a DELETE request
   *
   * @param string $url
   * @param string $token
   * @return array|string
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function delete(string $url, string $token = null)
  {
    try {
      $headers = ['Content-Type' => 'application/json'];
      if ($token) {
        $headers['Authorization'] = 'Bearer ' . $token;
      }
      $fullUrl = $this->base_url . '/' . $url;
      $response = $this->client->delete($fullUrl, ['headers' => $headers]);
      return $this->handleResponse($response);
    } catch (RequestException $e) {
      return $this->handleException($e);
    }
  }

  /**
   * Handle the API response
   *
   * @param \Psr\Http\Message\ResponseInterface $response
   * @return array|string
   */
  private function handleResponse(ResponseInterface $response)
  {
    $statusCode = $response->getStatusCode();
    $body = $response->getBody()->getContents();
    $data = json_decode($body, true);

    if ($statusCode >= 200 && $statusCode < 300) {
      return $data;
    } else {
      return $data['mensagem'] ?? 'An error occurred';
    }
  }

  /**
   * Handle the API request exception
   *
   * @param \GuzzleHttp\Exception\RequestException $e
   * @return string
   */
  private function handleException(RequestException $e)
  {
    $response = $e->getResponse();
    $statusCode = $response ? $response->getStatusCode() : null;

    if ($statusCode === 401) {
      return 'Unauthorized';
    } elseif ($response) {
      $body = $response->getBody()->getContents();
      $data = json_decode($body, true);

      if (isset($data['mensagem'])) {
        return $data['mensagem'];
      }
    }

    return 'An error occurred';
  }
}