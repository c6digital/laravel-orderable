<?php

namespace C6Digital\Orderable;

use Closure;

class OrderableOptions
{
    protected string $column = 'order';

    protected bool $reorderOnCreate = true;

    protected bool $moveToEndOnCreate = true;

    protected bool $moveToStartOnCreate = false;

    /**
     * @var (Closure(\Illuminate\Database\Eloquent\Model): void)|null
     */
    protected ?Closure $setOrderUsing = null;

    public static function default(): static
    {
        return new static();
    }

    public function column(string $column): static
    {
        $this->column = $column;

        return $this;
    }

    public function reorderOnCreate(bool $reorderOnCreate = true): static
    {
        $this->reorderOnCreate = $reorderOnCreate;

        return $this;
    }

    public function moveToEndOnCreate(bool $moveToEndOnCreate = true): static
    {
        $this->moveToEndOnCreate = $moveToEndOnCreate;

        return $this;
    }

    public function moveToStartOnCreate(bool $moveToStartOnCreate = true): static
    {
        $this->moveToEndOnCreate = false;
        $this->moveToStartOnCreate = $moveToStartOnCreate;

        return $this;
    }

    /**
     * @param  Closure(\Illuminate\Database\Eloquent\Model): void  $reorderUsing
     */
    public function setOrderUsing(Closure $reorderUsing): static
    {
        $this->setOrderUsing = $reorderUsing;

        return $this;
    }

    public function getColumn(): string
    {
        return $this->column;
    }

    public function shouldReorderOnCreate(): bool
    {
        return $this->reorderOnCreate;
    }

    public function shouldMoveToEndOnCreate(): bool
    {
        return $this->moveToEndOnCreate;
    }

    public function shouldMoveToStartOnCreate(): bool
    {
        return $this->moveToStartOnCreate;
    }

    /**
     * @return null|(Closure(\Illuminate\Database\Eloquent\Model): void)
     */
    public function getSetOrderUsing(): ?Closure
    {
        return $this->setOrderUsing;
    }
}
