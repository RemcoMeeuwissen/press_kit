<?php

namespace spec\PressKit;

use PressKit\Url;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UrlSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(__DIR__);
        $this->shouldHaveType(Url::class);
    }

    function it_can_find_a_xml_file()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml');
        $this->get('game')->shouldReturn('game.xml');
    }

    function it_can_find_the_default_xml_file_when_called_with_null()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml');
        $this->get(null)->shouldReturn('company.xml');
    }

    function it_returns_false_if_it_cannot_find_a_matching_file()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml');
        $this->get('nothing')->shouldReturn(false);
    }

    function it_guards_against_directory_traversal()
    {
        $this->beConstructedWith(__DIR__ . '/../fixtures/xml');
        $this->get('test/company')->shouldReturn('company.xml');
    }
}
