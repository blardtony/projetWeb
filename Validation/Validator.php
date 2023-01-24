<?php

namespace Validation;

class Validator
{
    private array $errors;
    public function __construct(private array $data)
    {
        $this->errors = [];
    }

    public function validate(array $rules): ?array
    {
        foreach ($rules as $name => $constraints) {
            if (array_key_exists($name, $this->data)){
                foreach ($constraints as $constraint) {
                    switch ($constraint) {
                        case 'required':
                            $this->required($name, $this->data[$name]);
                            break;
                        
                        case substr($constraint, 0, 3) === 'min':
                            $this->min($name, $this->data[$name], $constraint);
                            break;
                        case 'email':
                            $this->email($name, $this->data[$name]);
                            break;
                        case 'day':
                            $this->day($name, $this->data[$name]);
                            break;
                        default:
                            # code...
                            break;
                    }
                }
            }
        }
        return $this->errors;
    }

    private function required(string $name, string $value): void
    {
        $value = trim($value);

        if (!isset($value) || is_null($value) || empty($value)) {
            $this->errors[$name][] = "{$name} est requis."; 
        }
    }
    private function email(string $name, string $value): void
    {
        $value = trim($value);

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$name][] = "{$name} est non valide."; 
        }
    }

    private function min(string $name, string $value, string $constraint): void
    {
        preg_match_all('/(\d+)/', $constraint, $matches);
        $limit = (int) $matches[0][0];

        $options = [
            'options' => [
                'min_range' => $limit,
            ]
        ];
        if (!filter_var(strlen($value), FILTER_VALIDATE_INT, $options)) {
            $this->errors[$name][] = "{$name} doit avoir un minimum de {$limit} caractères";
        }
    }

    private function day(string $name, string $value): void
    {
        $options = [
            'options' => [
                'min_range' => 1,
                'max_range' => 38
            ]
        ];
        if (!filter_var($value, FILTER_VALIDATE_INT, $options)) {
            $this->errors[$name][] = "{$name} must be between 1 and 38";
        }
    }
}