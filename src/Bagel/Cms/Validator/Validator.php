<?php namespace Bagel\Cms\Validator;

use Laracasts\Commander\CommandBus;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\Validator as ValidatorInstance;

abstract class Validator implements CommandBus {

	/**
	 * @var ValidatorFactory
	 */
	protected $validatorFactory;

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
	public function __construct(ValidatorFactory $validatorFactory)
	{
		$this->validatorFactory = $validatorFactory;
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
		$this->validation = $this->validatorFactory->make($data, $this->getValidationRules());

        if($this->validation->fails())
        {
            throw new ValidatorException($this->message, $this->getValidationErrors());
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