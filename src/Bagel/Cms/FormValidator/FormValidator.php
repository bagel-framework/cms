<?php namespace Bagel\Cms\FormValidator;

use Laracasts\Commander\CommandBus;
use Illuminate\Validation\Factory as Validator;
use Illuminate\Validation\Validator as ValidatorInstance;

abstract class FormValidator implements CommandBus {

	/**
	 * @var Validator
	 */
	protected $validator;

	/**
	 * @var ValidatorInstance
	 */
	protected $validation;

	/**
	 * @var string
	 */
	protected $message = 'Validation failed';

	/**
	 * @param Validator $validator
	 */
	public function __construct(Validator $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * Validate the given array against our
	 * defined rules
	 *
	 * @param   array   $data
	 * @throws  FormValidationException
	 * @return  mixed
	 */
	public function validate(array $data)
	{
		$this->validation = $this->validator->make($data, $this->getValidationRules());

        if($this->validation->fails())
        {
            throw new FormValidatorException($this->message, $this->getValidationErrors());
        }

        return true;
	}

	/**
	 * Get the validation rules
	 *
	 * @return array
	 */
	protected function getValidationRules()
	{
		return $this->rules;
	}

	/**
	 * Get the validation errors
	 *
	 * @return \Illuminate\Support\MessageBag
	 */
	protected function getValidationErrors()
	{
		return $this->validation->errors();
	}

}