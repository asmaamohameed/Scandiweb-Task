<?php

namespace Scandiweb\Validation;

use Scandiweb\Validation\ErrorBag;
use Scandiweb\Validation\Rules\Rule;


class Validator
{
    protected array $data = [];
    protected array $rules = [];
    protected ErrorBag $errorBag;

    public function make($data)
    {
        $this->data = $data;
        $this->errorBag = new ErrorBag();
        $this->validate();
    }

    protected function validate()
    {
        foreach($this->rules as $field => $rules) {  
            foreach(RulesResolver::make($rules) as $rule) { 
                $this->applyRule($field, $rule);
                
            }

        }
    }

    protected function applyRule($field, Rule $rule)
    {
        if(!$rule->apply($field, $this->getFieldValue($field), $this->data))
        {
            $this->errorBag->add($field, Message::generate($rule,  $field));
        }
    }

    public function getFieldValue($field)
    {
        return $this->data[$field] ?? null;
    }

    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    public function passes(): bool
    {
        return empty($this->errors());

    }

    public function errors($key = null)
    {
        return $key ? $this->errorBag->errors[$key] : $this->errorBag->errors;

    }

}