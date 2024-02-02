<?php

namespace Demo\Domain\Model\Administrator;

class AdministratorDto extends AdministratorDtoAbstract
{
    /** @var string[]  */
    protected $sensitiveFields = [
        'pass'
    ];

    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context == self::CONTEXT_COLLECTION) {
            return [
                'username' => 'username',
                'email' => 'email',
                'id' => 'id',
            ];
        }

        $response = parent::getPropertyMap($context, $role);

        // active field is hidden in every context
        unset($response['active']);

        return $response;
    }
}
