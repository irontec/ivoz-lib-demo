<?php

declare(strict_types=1);

namespace Demo\Domain\Model\Timezone;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Demo\Domain\Model\Administrator\AdministratorInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Collections\Criteria;

/**
* @codeCoverageIgnore
*/
trait TimezoneTrait
{
    /**
     * @var ?int
     */
    protected $id = null;

    /**
     * @var Collection<array-key, AdministratorInterface> & Selectable<array-key, AdministratorInterface>
     * AdministratorInterface mappedBy timezoneId
     */
    protected $administrators;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->administrators = new ArrayCollection();
    }

    abstract protected function sanitizeValues(): void;

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TimezoneDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        $administrators = $dto->getAdministrators();
        if (!is_null($administrators)) {

            /** @var Collection<array-key, AdministratorInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $administrators
            );
            $self->replaceAdministrators($replacement);
        }

        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TimezoneDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        parent::updateFromDto($dto, $fkTransformer);
        $administrators = $dto->getAdministrators();
        if (!is_null($administrators)) {

            /** @var Collection<array-key, AdministratorInterface> $replacement */
            $replacement = $fkTransformer->transformCollection(
                $administrators
            );
            $this->replaceAdministrators($replacement);
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TimezoneDto
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    public function addAdministrator(AdministratorInterface $administrator): TimezoneInterface
    {
        $this->administrators->add($administrator);

        return $this;
    }

    public function removeAdministrator(AdministratorInterface $administrator): TimezoneInterface
    {
        $this->administrators->removeElement($administrator);

        return $this;
    }

    /**
     * @param Collection<array-key, AdministratorInterface> $administrators
     */
    public function replaceAdministrators(Collection $administrators): TimezoneInterface
    {
        foreach ($administrators as $entity) {
            $entity->setTimezoneId($this);
        }

        $toStringCallable = fn(mixed $val): \Stringable|string => $val instanceof \Stringable ? $val : serialize($val);
        foreach ($this->administrators as $key => $entity) {
            /**
             * @psalm-suppress MixedArgument
             */
            $currentValue = array_map(
                $toStringCallable,
                (function (): array {
                    return $this->__toArray(); /** @phpstan-ignore-line */
                })->call($entity)
            );

            $match = false;
            foreach ($administrators as $newKey => $newEntity) {
                /**
                 * @psalm-suppress MixedArgument
                 */
                $newValue = array_map(
                    $toStringCallable,
                    (function (): array {
                        return $this->__toArray(); /** @phpstan-ignore-line */
                    })->call($newEntity)
                );

                $diff = array_diff_assoc(
                    $currentValue,
                    $newValue
                );
                unset($diff['id']);

                if (empty($diff)) {
                    unset($administrators[$newKey]);
                    $match = true;
                    break;
                }
            }

            if (!$match) {
                $this->administrators->remove($key);
            }
        }

        foreach ($administrators as $entity) {
            $this->addAdministrator($entity);
        }

        return $this;
    }

    /**
     * @return array<array-key, AdministratorInterface>
     */
    public function getAdministrators(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->administrators->matching($criteria)->toArray();
        }

        return $this->administrators->toArray();
    }
}
