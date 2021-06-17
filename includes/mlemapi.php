<?php
/**
 * Functions for communicating with the MelmAPI API
 */

function mlem_get_json($url) {
	// Get data from remote URL
	$response = wp_remote_get($url, [
		'headers' => [
			'X-RapidAPI-Key' => WCMM_RAPIDAPI_KEY,
			'X-RapidAPI-Host' => WCMM_RAPIDAPI_HOST,
		],
	]);

	// Make sure we got a valid response
	if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
		throw new Exception("Failed to get proper response from API");
	}

	// Fetch body and decode it
	$body = wp_remote_retrieve_body($response);
	$payload = json_decode($body);

	// Return body 🧟‍♂️🧟‍♀️
	return $payload;
}

function mlem_get_random_mlem() {
	// Request a mlem 🐶
	try {
		$response = mlem_get_json("https://mlemapi.p.rapidapi.com/randommlem");

	} catch (Exception $e) {
		// The mlem caused an error 😥
		return [
			'success' => false,
			'data' => 'Failed to retrieve a random mlem',
		];
	}

	// All Your Mlems Are Belong To Me
	return [
		'success' => true,
		'data' => $response,
	];
}
