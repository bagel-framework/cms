<?php namespace Bagel\Cms\Translator;

trait Translatable {

    /**
     * On the Eloquent Model save event, we prepare the corresponding
     * translated model. If we create it new, we don't know the id yet,
     * so it gets cached in this variable for the created event.
     */
    public $cachedTranslatedModel;

    /**
     * The different translations this model has.
     * Simpler function call for currentTranslation and
     * specificTranslation.
     *
     * @param string $locale
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations($locale = null)
    {
        if ($locale === null)
        {
            return $this->currentTranslation();
        }

        return $this->specificTranslation($locale);
    }

    /**
     * Get the relation of the currently active language
     *
     * @todo Get the actual current language id
     * @return \Illuminate\Database\Eloquent\Relations\HasOne;
     */
    public function currentTranslation()
    {
        $languageId = 1;

        return $this->hasOne($this->translatedModel, $this->translatedModelForeignKey)->where('language_id',
            $languageId);
    }

    /**
     * Get the relation to a specific language
     *
     * @todo Get the actual language id by the locale
     * @param string $locale
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function specificTranslation($locale)
    {
        $languageId = 1;

        return $this->hasOne($this->translatedModel, $this->translatedModelForeignKey)->where('language_id',
            $languageId);
    }

    /**
     * Extract all the attributes which later will be stored
     * in the translatedModel
     *
     * @return array
     */
    public function extractAttributesToTranslate()
    {
        $translated = [];

        foreach ($this->getAttributes() as $key => $value)
        {
            if (in_array($key, $this->translatedAttributes))
            {
                $translated[$key] = $value;
            }
        }

        return $translated;
    }

    /**
     *
     *
     * @param array $translatedAttributes
     */
    public function createOrUpdateTranslatedModel(array $translatedAttributes)
    {
        // Get the current lang and Lang model
        $languageId = 1;
        $translatedModel = $this->translations()->where('language_id', $languageId)->first();

        // If there is no Language Model yet for this translation, create one. Otherwise
        // we can just update the existing one
        if (!$translatedModel)
        {
            $translatedModel = $this->newTranslatedModel($translatedAttributes);
            $translatedModel->language_id = $languageId;
            $this->cachedTranslatedModel = $translatedModel;
        }
        else
        {
            $translatedModel->update($translatedAttributes);
        }
    }

    /**
     * Create a new model with the translated values
     *
     * @param array $values
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
        if ($this->translatedAttributes)
        {
            if (in_array($key, $this->translatedAttributes))
            {
                return true;
            }
        }

        return parent::__isset($key);
    }

    /**
     * Magic function to get the correct value if a translation is available.
     * If not, delegate to parent.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        // If the attribute is set to be automatically localized
        if (in_array($key, $this->translatedAttributes))
        {
            if ($this->currentTranslation)
            {
                return $this->currentTranslation->$key;
            }
        }

        return parent::__get($key);
    }

    /**
     * Setup custom saving and saved triggers to extract attributes
     * we need to translate and save/update them in the dedicated model
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model)
        {
            $translatedAttributes = $model->extractAttributesToTranslate();

            // If there aren't any attributes to translate, we can continue
            if (empty($translatedAttributes))
            {
                return true;
            }

            // We can now unset the translated attributes in our original model
            foreach ($translatedAttributes as $key => $value)
            {
                unset($model->attributes[$key]);
            }

            $model->createOrUpdateTranslatedModel($translatedAttributes);

            return true;
        });

        static::saved(function ($model)
        {
            if ($model->cachedTranslatedModel !== null)
            {
                $model->translations()->save($model->cachedTranslatedModel);
            }

            return true;
        });
    }

}