<?php

require_once 'Exceptions/CtctException.php';
require_once 'Util/CtctConfig.php';
require_once 'Util/CtctCurlResponse.php';
require_once 'Util/CtctRestClientInterface.php';
require_once 'Util/CtctRestClient.php';

class Ctct{
	/**
	 * Constant Contact API Key
	 * @var string
	 */
	private $apiKey;

	/**
	 * RestClient Implementation to use for HTTP requests
	 * @var CtctRestClientInterface
	 */
	protected $restClient;

	public function __construct($apiKey){
		$this->apiKey = $apiKey;
		$this->restClient = new CtctRestClient();
	}

	/**
	 * Get details for account associated with an access token
	 * @param string $accessToken - Constant Contact OAuth2 access token
	 * @return stdClass
	 */
	public function getAccountInfo($accessToken)
	{
		$baseUrl = CtctConfig::get('endpoints.base_url') . CtctConfig::get('endpoints.account_info');

		$url = $this->buildUrl($baseUrl);

		$response = $this->restClient->get($url, self::getHeaders($accessToken));

		return json_decode($response->body);
	}

	/**
	 * Get lists
	 * @param string $accessToken - Valid access token
	 * @param array $params - associative array of query parameters and values to append to the request.
	 *      Allowed parameters include:
	 *      modified_since - ISO-8601 formatted timestamp.
	 * @return array of stdClass
	 */
	public function getLists($accessToken, array $params = array())
	{
		$baseUrl = CtctConfig::get('endpoints.base_url') . CtctConfig::get('endpoints.lists');
		$url = $this->buildUrl($baseUrl, $params);
		$response = $this->restClient->get($url, self::getHeaders($accessToken));

		$lists = array();
		foreach (json_decode($response->body) as $contact) {
			$lists[] = $contact;
		}
		return $lists;
	}

	/**
	 * Get contacts with a specified email address
	 * @param string $accessToken - Constant Contact OAuth2 access token
	 * @param string $email - contact email address to search for
	 * @return array - stdClass
	 */
	public function getContactByEmail($accessToken, $email)
	{
		$baseUrl = CtctConfig::get('endpoints.base_url') . CtctConfig::get('endpoints.contacts');
		$url = $this->buildUrl($baseUrl, array('email' => $email));

		$response = $this->restClient->get($url, self::getHeaders($accessToken));
		$body = json_decode($response->body);
		$contacts = array();
		foreach ($body->results as $contact) {
			$contacts[] = $contact;
		}

		return $contacts;
	}


	/**
	 * Add a new contact to an account
	 * @param string $accessToken - Valid access token
	 * @param stdClass $contact - Contact to add
	 * @param boolean $actionByVisitor - is the action being taken by the visitor
	 * @return stdClass representing contact
	 */
	public function addContact($accessToken, stdClass $contact, $actionByVisitor = false)
	{
		$params = array();
		if ($actionByVisitor == true) {
			$params['action_by'] = "ACTION_BY_VISITOR";
		}

		$baseUrl = CtctConfig::get('endpoints.base_url') . CtctConfig::get('endpoints.contacts');
		$url = $this->buildUrl($baseUrl, $params);
		$response = $this->restClient->post($url, self::getHeaders($accessToken), json_encode($contact));
		return json_decode($response->body);
	}


	/**
	 * Update an individual contact
	 * @param string $accessToken - Valid access token
	 * @param stdClass $contact - Contact to update
	 * @param boolean $actionByVisitor - is the action being taken by the visitor, default is false
	 * @return stdClass object representing contact
	 */
	public function updateContact($accessToken, stdClass $contact, $actionByVisitor = false)
	{
		$params = array();
		if ($actionByVisitor == true) {
			$params['action_by'] = "ACTION_BY_VISITOR";
		}

		$baseUrl = CtctConfig::get('endpoints.base_url') . sprintf(CtctConfig::get('endpoints.contact'), $contact->id);
		$url = $this->buildUrl($baseUrl, $params);
		$response = $this->restClient->put($url, self::getHeaders($accessToken), json_encode($contact));
		return json_decode($response->body, true);
	}

	/**
	 * Build a URL from a base url and optional array of query parameters to append to the url. URL query parameters
	 * should not be URL encoded and this method will handle that.
	 * @param $url
	 * @param array $queryParams
	 * @return string
	 */
	public function buildUrl($url, array $queryParams = null)
	{
		$keyArr = array('api_key' => $this->apiKey);
		if ($queryParams) {
			$params = array_merge($keyArr, $queryParams);
		} else {
			$params = $keyArr;
		}

		return $url . '?' . http_build_query($params, '', '&');
	}

	/**
	 * Helper function to return required headers for making an http request with constant contact
	 * @param $accessToken - OAuth2 access token to be placed into the Authorization header
	 * @return array - authorization headers
	 */
	protected static function getHeaders($accessToken)
	{
		return array(
			'Content-Type: application/json',
			'Accept: application/json',
			'Authorization: Bearer ' . $accessToken
		);
	}
}