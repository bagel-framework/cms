<?php namespace Bagel\Cms\Translator;

use App;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\Model;

trait Translatable {

    /**
     * On the Eloquent Model save event, we prepare the corresponding
     * language model. If we create it new, we don't know the id yet,
     * so it gets cached in this variable for the created event.
     */
    public $cachedLanguageModel;

    /**
     * name of the translation object
     *
     * @var object
     */
    protected $translatedModel;

    /**
     * get all the attributes that are
     * translated of this object
     *
     * @return  array
     */
    public function getTranslatedAttributes()
    {
        return $this->translatedAttributes;
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model)
        {
            // Cancel if not localized
            if(empty($model->translatedAttributes))
            {
                return true;
            }

            // Get the model's attributes
            $attributes = $model->getAttributes();
            $translated = array();

            // Extract the values which are stored
            // translated in a seperate DB and unset
            // them on the actual model
            foreach($attributes as $key => $value)
            {
                if(in_array($key, $model->translatedAttributes))
                {
                    unset($model->$key);
                    $translated[$key] = $value;
                }
            }

            //If no localized attributes, continue
            if(empty($translated))
            {
                return true;
            }

            // Get the current lang and Lang model
            $langId = Bagel::language()->getCurrentId();
            $langModel = $model->translations()->where('language_id', $langId)->first();

            // If no Lang model, prepare one,
            // otherwise update the existing one
            if(!$langModel)
            {
                $langModel = $model->newTranslatedModel($translated);
                $langModel->language_id = $langId;
                $model->cachedLanguageModel = $langModel;
            }else
            {
                $langModel->update($translated);
            }

            return true;
        });

        static::saved(function ($model)
        {
            if($model->cachedLanguageModel !== null)
            {
                $model->translations()->save($model->cachedLanguageModel);
            }

            return true;
        });
    }

    /**
     * create a new model with the translated values
     * the name of this model must be set in the original model
     *
     * @param  array $values
     * @return object
     */
    public function newTranslatedModel(array $values)
    {
        $model = $this->translatedModel;

        return new $model($values);
    }

    /**
     * Checks if a field isset while taking into account localized attributes
     *
     * @param string $key
     * @return boolean
     */
    public function __isset($key)
    {
        if($this->translatedAttributes)
        {
            if(in_array($key, $this->translatedAttributes)) return true;
        }

        return parent::__isset($key);
    }

    /**
     * Magic function to get the correct value
     * if a translation is available. If not, return default string
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        // If the attribute is set to be automatically localized
        if($this->translatedAttributes)
        {
            if(in_array($key, $this->translatedAttributes))
            {
                if($this->currentTranslation) return $this->currentTranslation->$key;
            }
        }

        return parent::__get($key);
    }
}