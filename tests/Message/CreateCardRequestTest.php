<?php

declare(strict_types=1);

namespace Ampeco\OmnipayMobilExpress\Tests\Message;

use Ampeco\OmnipayMobilExpress\Message\CreateCardRequest;
use Mockery;
use Omnipay\Common\Http\ClientInterface;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class CreateCardRequestTest extends TestCase
{
    private CreateCardRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $httpClient = Mockery::mock(ClientInterface::class);
        $httpRequest = Mockery::mock(HttpRequest::class);

        $this->request = new CreateCardRequest($httpClient, $httpRequest);
        $this->request->initialize([
            'email' => 'test@example.com',
            'customerId' => 'customer-123',
            'returnUrl' => 'https://example.com/return',
        ]);
    }

    #[Test]
    public function it_uses_default_design_type_when_not_configured(): void
    {
        $data = $this->request->getData();

        $this->assertArrayHasKey('uiDesignInfo', $data);
        $this->assertArrayHasKey('designType', $data['uiDesignInfo']);
        $this->assertEquals('0.1.4', $data['uiDesignInfo']['designType']);
    }

    #[Test]
    public function it_uses_configured_design_type_when_set(): void
    {
        $this->request->setDesignType('4');

        $data = $this->request->getData();

        $this->assertArrayHasKey('uiDesignInfo', $data);
        $this->assertArrayHasKey('designType', $data['uiDesignInfo']);
        $this->assertEquals('4', $data['uiDesignInfo']['designType']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
