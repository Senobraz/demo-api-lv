<?php

namespace App\Contracts;

interface DictionaryContract
{
    public function getUlid(): ?string;

    public function getLabel(): string;

    public function getValue(): string|int|null;

    public function getAltValue(): string|int|null;

    public function getPackage(): ?string;

    public function getSort(): int;
}
