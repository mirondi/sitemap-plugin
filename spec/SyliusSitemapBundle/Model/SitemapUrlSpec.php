<?php

namespace spec\SyliusSitemapBundle\Model;

use PhpSpec\ObjectBehavior;
use SyliusSitemapBundle\Model\ChangeFrequency;
use SyliusSitemapBundle\Model\SitemapUrl;
use SyliusSitemapBundle\Model\SitemapUrlInterface;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
final class SitemapUrlSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SitemapUrl::class);
    }

    function it_implements_sitemap_url_interface()
    {
        $this->shouldImplement(SitemapUrlInterface::class);
    }

    function it_has_localization()
    {
        $this->setLocalization('http://sylius.org/');
        $this->getLocalization()->shouldReturn('http://sylius.org/');
    }

    function it_has_last_modification(\DateTime $now)
    {
        $this->setLastModification($now);
        $this->getLastModification()->shouldReturn($now);
    }

    function it_has_change_frequency()
    {
        $this->setChangeFrequency(ChangeFrequency::always());
        $this->getChangeFrequency()->shouldReturn('always');
    }

    function it_has_priority()
    {
        $this->setPriority(0.5);
        $this->getPriority()->shouldReturn(0.5);
    }

    function it_throws_invalid_argument_exception_if_priority_wont_be_between_zero_and_one()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', array(-1));
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', array(-0.5));
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', array(2));
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', array(1.1));
    }

    function it_throws_invalid_argument_exception_if_priority_will_be_not_a_number()
    {
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', array('Mike'));
        $this->shouldThrow(\InvalidArgumentException::class)->during('setPriority', array(true));
    }
}