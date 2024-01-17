<?php

namespace App\Service\Behat;

use Symfony\Component\HttpKernel\KernelInterface;
use Ivoz\Api\Behat\Context\FeatureContext as IvozApiFeatureContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends IvozApiFeatureContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(
        KernelInterface $kernel
    ) {
        parent::__construct($kernel);
    }

    /**
     * @Given I add :header header with :value value
     */
    public function iAddHeaderWithValue(string $header, string $value): void
    {
        if (!$this->request instanceof \Behatch\HttpCall\Request) {
            throw new \Exception('Unexpected request object');
        }

        /** @phpstan-ignore-next-line */
        $this->request->setHttpHeader($header, $value);
    }
}
