<?php

namespace App\Service;

use Ivoz\Api\Swagger\Serializer\DocumentationNormalizer\AuthEndpointTrait;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AuthEndpointDecorator implements NormalizerInterface, CacheableSupportsMethodInterface
{
    use AuthEndpointTrait;

    /**
     * @var \ArrayObject
     */
    protected $definitions;

    public function __construct(
        private NormalizerInterface $decoratedNormalizer
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function hasCacheableSupportsMethod(): bool
    {
        return
            $this->decoratedNormalizer instanceof CacheableSupportsMethodInterface
            && $this->decoratedNormalizer->hasCacheableSupportsMethod();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $this->decoratedNormalizer->supportsNormalization(...func_get_args());
    }

    /**
     * {@inheritdoc}
     * @param array<array-key, mixed> $context
     * @return \ArrayObject
     */
    public function normalize($object, $format = null, array $context = [])
    {
        /** @var \ArrayObject  $response */
        $response = $this->decoratedNormalizer->normalize(
            ...func_get_args()
        );
        $paths = $response['paths']->getArrayCopy();

        $auth = [
            '/admin_login' => $this->getAdminLoginSpec(),
            '/token/refresh' => $this->getTokenRefreshSpec()
        ];

        $response['paths'] = array_merge(
            $auth,
            $paths
        );

        return $response;
    }
}
