<?php

namespace spec\PressKit;

use PressKit\XML;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class XMLSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/full.xml');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(XML::class);
    }

    function it_can_handle_invalid_xml()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/invalid.xml');
    }

    function it_can_parse_the_title()
    {
        $this->getData()->shouldHaveKeyWithValue('title', 'Title');
    }

    function it_can_handle_a_missing_title()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('title');
    }

    function it_can_parse_the_website()
    {
        $this->getData()->shouldHaveKeyWithValue('website', 'http://www.website.com/');
    }

    function it_can_handle_a_missing_website()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('website');
    }

    function it_can_parse_based_in()
    {
        $this->getData()->shouldHaveKeyWithValue('basedIn', 'City, Country');
    }

    function it_can_handle_a_missing_based_in()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('basedIn');
    }

    function it_can_parse_the_founding_date()
    {
        $this->getData()->shouldHaveKeyWithValue('foundingDate', 'November 1, 2019');
    }

    function it_can_handle_a_missing_founding_date()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('foundingDate');
    }

    function it_can_parse_the_press_contact()
    {
        $this->getData()->shouldHaveKeyWithValue('pressContact', 'press-contact@example.com');
    }

    function it_can_handle_a_missing_press_contact()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('pressContact');
    }

    function it_can_parse_the_social_links()
    {
        $this->getData()->shouldHaveKeyWithValue('socialLinks', [
            [
                'name' => 'twitter.com',
                'url' => 'http://www.twitter.com/'
            ],
            [
                'name' => 'facebook.com',
                'url' => 'http://www.facebook.com/'
            ]
        ]);

    }

    function it_can_handle_missing_social_links()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('socialLinks');
    }

    function it_can_parse_the_address()
    {
        $this->getData()->shouldHaveKeyWithValue('address', [
            'Line One',
            'Line Two'
        ]);
    }

    function it_can_handle_a_missing_address()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('address');
    }

    function it_can_parse_the_phone_number()
    {
        $this->getData()->shouldHaveKeyWithValue('phoneNumber', '555-2368');
    }

    function it_can_handle_a_missing_phone_number()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('phoneNumber');
    }

    function it_can_parse_the_description()
    {
        $this->getData()->shouldHaveKeyWithValue('description', 'A full-featured XML file');
    }

    function it_can_handle_a_missing_description()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('description');
    }

    function it_can_parse_the_history()
    {
        $this->getData()->shouldHaveKeyWithValue('history', [
            [
                'header' => 'Some history',
                'body' => 'A nice story'
            ],
            [
                'header' => 'More history',
                'body' => 'A nice story'
            ]
        ]);
    }

    function it_can_handle_missing_history()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('history');
    }

    function it_can_parse_the_trailers()
    {
        $this->getData()->shouldHaveKeyWithValue('trailers', [
            [
                'name' => 'Trailer name',
                'videos' => [
                    [
                        'service' => 'youtube',
                        'id' => 'P2rtqVma_Ww'
                    ],
                    [
                        'service' => 'vimeo',
                        'id' => '166807261'
                    ]
                ]
            ],
            [
                'name' => 'Trailer name',
                'videos' => [
                    [
                        'service' => 'file',
                        'id' => 'trailer.mp4'
                    ],
                    [
                        'service' => 'file',
                        'id' => 'trailer.mov'
                    ]
                ]
            ]
        ]);
    }

    function it_can_handle_missing_trailers()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('trailers');
    }

    function it_can_parse_the_awards()
    {
        $this->getData()->shouldHaveKeyWithValue('awards', [
            [
                'award' => 'First Award',
                'about' => 'Place, Date'
            ],
            [
                'award' => 'Second Award',
                'about' => 'Name, Date'
            ]
        ]);
    }

    function it_can_handle_missing_awards()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('awards');
    }

    function it_can_parse_quotes()
    {
        $this->getData()->shouldHaveKeyWithValue('quotes', [
           [
               'description' => 'First quote',
               'author' => 'Name',
               'website' => [
                   'name' => 'Website name',
                   'url' => 'http://www.example.com/'
               ]
           ],
            [
                'description' => 'Second quote',
                'author' => 'Name',
                'website' => [
                    'name' => 'Website name',
                    'url' => 'http://example.com/'
                ]
            ]
        ]);
    }

    function it_can_handle_missing_quotes()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('quotes');
    }

    function it_can_parse_additional_links()
    {
        $this->getData()->shouldHaveKeyWithValue('additionalLinks', [
            [
                'title' => 'Additional link',
                'description' => 'It\'s a website',
                'url' => 'http://example.com/'
            ]
        ]);
    }

    function it_can_handle_missing_additional_links()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('additionalLinks');
    }

    function it_can_parse_the_credits()
    {
        $this->getData()->shouldHaveKeyWithValue('credits', [
            [
                'name' => 'Person One',
                'role' => 'Programmer',
            ],
            [
                'name' => 'Person Two',
                'role' => 'Artist',
                'url' => 'http://www.example.com/'
            ]
        ]);
    }

    function it_can_handle_missing_credits()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('credits');
    }

    function it_can_parse_contacts()
    {
        $this->getData()->shouldHaveKeyWithValue('contacts', [
            [
                'title' => 'Email',
                'url' => 'mailto:person@example.com'
            ],
            [
                'title' => 'Twitter',
                'url' => 'http://twitter.com/'
            ]
        ]);
    }

    function it_can_handle_missing_contacts()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('contacts');
    }

    function it_can_parse_the_analytics_tracking_code()
    {
        $this->getData()->shouldHaveKeyWithValue('analytics', [
            'id' => 'UA-000000-1',
            'provider' => 'google-analytics'
        ]);
    }

    function it_can_handle_missing_analytics()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml/empty.xml');
        $this->getData()->shouldNotHaveKey('analytics');
    }
}
