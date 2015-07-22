<?php namespace Wubs\Trakt;


use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Url;
use Guzzle\Service\Client;
use GuzzleHttp\ClientInterface;
use League\OAuth2\Client\Provider\ProviderInterface;
use League\OAuth2\Client\Token\AccessToken;
use Wubs\Trakt\Api\Calendars;
use Wubs\Trakt\Api\CheckIn;
use Wubs\Trakt\Api\Comments;
use Wubs\Trakt\Api\Episodes;
use Wubs\Trakt\Api\Genres;
use Wubs\Trakt\Api\Movies;
use Wubs\Trakt\Api\People;
use Wubs\Trakt\Api\Recommendations;
use Wubs\Trakt\Api\Scrobble;
use Wubs\Trakt\Api\Search;
use Wubs\Trakt\Api\Seasons;
use Wubs\Trakt\Api\Shows;
use Wubs\Trakt\Api\Users;
use Wubs\Trakt\Contracts\RequestInterface;
use Wubs\Trakt\Exception\InvalidOauthRequestException;
use Wubs\Trakt\Provider\TraktProvider;
use Wubs\Trakt\Request\AbstractRequest;

class Trakt
{
    /**
     * @var Calendars
     */
    public $calendars;

    /**
     * @var CheckIn
     */
    public $checkIn;

    /**
     * @var Comments
     */
    public $comments;

    /**
     * @var Episodes
     */
    public $episodes;

    /**
     * @var Genres
     */
    public $genres;
    /**
     * @var Movies
     */
    public $movies;

    /**
     * @var People
     */
    public $people;

    /**
     * @var Recommendations
     */
    public $recommendations;

    /**
     * @var Scrobble
     */
    public $scrobble;

    /**
     * @var Search
     */
    public $search;

    /**
     * @var Seasons
     */
    public $seasons;
    /**
     * @var Shows
     */
    public $shows;

    /**
     * @var Users
     */
    public $users;
    /**
     * @var ClientInterface
     */
    private $client;


    private $clientId;
    /**
     * @var TraktProvider
     */
    public $auth;

    /**
     * @param $clientId
     * @param ClientInterface $client
     * @param Auth $auth
     */
    public function __construct($clientId, ClientInterface $client, Auth $auth = null)
    {
        $this->client = $client;
        $this->clientId = $clientId;
        $this->auth = $auth;
        $this->createWrappers();
    }


    /**
     * Creates the wrappers for all public properties and sets them.
     */
    private function createWrappers()
    {
        $this->calendars = new Calendars($this->clientId, $this->client);
        $this->checkIn = new CheckIn($this->clientId, $this->client);
        $this->comments = new Comments($this->clientId, $this->client);
        $this->episodes = new Episodes($this->clientId, $this->client);
        $this->genres = new Genres($this->clientId, $this->client);
        $this->movies = new Movies($this->clientId, $this->client);
        $this->people = new People($this->clientId, $this->client);
        $this->recommendations = new Recommendations($this->clientId, $this->client);
        $this->scrobble = new Scrobble($this->clientId, $this->client);
        $this->search = new Search($this->clientId, $this->client);
        $this->seasons = new Seasons($this->clientId, $this->client);
        $this->shows = new Shows($this->clientId, $this->client);
        $this->users = new Users($this->clientId, $this->client);
    }
}