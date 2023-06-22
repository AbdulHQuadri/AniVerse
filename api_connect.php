<?php
use GuzzleHttp\Client;

function fetchAnimeList($search, $page) {

    require __DIR__ . '/vendor/autoload.php';
    
    // Define the GraphQL query and variables
    $query = '
        query ($page: Int,  $search: String) {
            Page(page: $page) {
                pageInfo {
                    total
                    currentPage
                    lastPage
                    hasNextPage
                    perPage
                }
                media(type: ANIME, search: $search) {
                    id
                    title {
                        romaji
                        english
                        native
                    }
                    coverImage {
                        medium
                    }
                }
            }
        }
    ';

    $variables = [
        "search" => $search,
        "perPage" => 15,
        "page" => $page
    ];

    // Make the HTTP API request
    $http = new Client;
    $response = $http->post('https://graphql.anilist.co', [
        'json' => [
            'query' => $query,
            'variables' => $variables,
        ]
    ]);

    // Extract the data from the API response
    $data = json_decode($response->getBody()->getContents(), true);

    // Check if the expected keys exist in the response
    if (isset($data['data']['Page']['media'])) {
        // Retrieve the list of anime titles and page information
        $animeList = $data['data']['Page']['media'];
        $pageInfo = $data['data']['Page']['pageInfo'];

        // Return the anime list and page information
        return ['animeList' => $animeList, 'pageInfo' => $pageInfo];
    } else {
        // Handle the case when the expected keys are missing or the response structure is different
        return null;
    }
}