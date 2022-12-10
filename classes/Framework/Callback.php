<?php

namespace APIModule\Framework;

use ReflectionMethod;

class Callback {
    public $Method;
    public $Class;
    public $Parameters;

    public function __construct(object $Class, string $Method, array $Parameters = []) {
        $this->Method = $Method;
        $this->Class = $Class;
        $this->Parameters = $Parameters;
    }

    public function run() {

        $Args = [];
        $Reflection = new ReflectionMethod($this->Class, $this->Method);

        foreach($Reflection->getParameters() as $Argument) {
            $Args[$Argument->name] = $this->Parameters[$Argument->name] ?? null;
        }

        return call_user_func([$this->Class, $this->Method], ...$Args);
    }
}