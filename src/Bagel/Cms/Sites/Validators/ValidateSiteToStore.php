<?php namespace Bagel\Cms\Sites\Validators;

use Bagel\Cms\Validator\ValidationException;
use Bagel\Cms\Validator\Validator;

class ValidateSiteToStore extends Validator {

    protected $message = 'Site not valid for storage';

    /**
     * Validation rules for creating
     * a new site
     *
     * @var  array
     * @todo check for unique slug in this language and in this parent
     * @todo check if template exists in db
     */
    protected $rules = [
        'parent_site' => 'required|exists:sites,id',
        'type'        => 'required|max:255',
        'template_id' => 'required|max:255',
        'name'        => 'required|max:255',
        'slug'        => 'required|max:255|alpha_dash',
        'is_home'     => 'in:0,1',
    ];

    /**
     * Prepare data for validation
     *
     * @param   object $command Bagel\Cms\Sites\Commands\StoreSiteCommand
     * @return  void
     */
    public function execute($command)
    {
        $data = [
            'parent_site' => $command->parent_site,
            'type'        => $command->type,
            'template_id' => $command->template_id,
            'name'        => $command->name,
            'slug'        => $command->slug,
            'is_home'     => $command->is_home,
        ];

        $this->validate($data);
    }

}