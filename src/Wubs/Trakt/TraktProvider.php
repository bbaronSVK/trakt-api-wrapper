<?php
/**
 * Created by PhpStorm.
 * User: bwubs
 * Date: 20/02/15
 * Time: 22:12
 */

namespace Wubs\Trakt;


use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

class TraktProvider extends AbstractProvider
{
    private $base = "https://api-v2launch.trakt.tv";

    public function __construct()
    {
        parent::__construct(
            [
                'clientId' => getenv("CLIENT_ID"),
                'clientSecret' => getenv("CLIENT_SECRET"),
                "redirectUri" => getenv("TRAKT_REDIRECT_URI")
            ]
        );
    }

    /**
     * Get the URL that this provider uses to begin authorization.
     *
     * @return string
     */
    public function urlAuthorize()
    {
        return $this->base . '/oauth/authorize';
    }

    /**
     * Get the URL that this provider users to request an access token.
     *
     * @return string
     */
    public function urlAccessToken()
    {
        return $this->base . '/oauth/token';
    }

    public function urlUserDetails(AccessToken $token)
    {
    }

    public function userDetails($response, AccessToken $token)
    {
    }
}