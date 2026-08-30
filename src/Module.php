<?php

namespace Modularis;

final class Module
{
    public function __construct(
        protected string $name,
        protected string $alias,
        protected ?string $description,
    ) {
    }
}
