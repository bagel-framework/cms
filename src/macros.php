<?php

Form::macro('bagelSubmit', function ($cancelLink, $parameters = array())
{
    $html = '
    <div class="form-group">
        <div class="col-lg-9 col-lg-offset-2">
            <a class="btn btn-white btn-sm" href="' . action($cancelLink, $parameters) . '">Abbrechen</a>
            <button class="btn btn-primary btn-sm action-update" type="submit">Übernehmen</button>
            <button class="btn btn-primary btn-sm action-save" type="submit">Speichern</button>
        </div>
    </div>';

    return $html;
});

Form::macro('bagelInput', function ($name, $label, $value, $required)
{
    $options = array();
    $form = app()->make('form');

    if ($required)
    {
        $options['data-required'] = 'true';
    }

    $options['class'] = 'form-control';

    $html = '
    <div class="form-group">
        <label class="col-lg-2 control-label">' . $label . '</label>
        <div class="col-lg-9">' . $form->input('text', $name, $value, $options) . '</div>
    </div>';

    return $html;
});

/**
 * Form macro to generate the markup of a dropdown.
 * This will be handled by JS on the clientside
 *
 * @todo Remove normal dropdown as soon as the JS is implemented
 */
Form::macro('bagelDropdown', function ($name, $label, $preSelectedValue, $items)
{
    $options = array();
    $form = app()->make('form');
    $itemsMarkup = '';
    $dropdownLabel = 'bitte auswählen';

    foreach ($items as $id => $item)
    {
        $activeClass = '';
        $checked = null;
        if ($id == $preSelectedValue)
        {
            $activeClass = 'class="active"';
            $checked = true;
            $dropdownLabel = $item;
        }

        // $itemsMarkup .= '<li '.$activeClass.'><a href="#">'. $form->radio($name, $id, $checked) .' '.$item.'</a></li>';
        $itemsMarkup .= '<option value="' . $id . '">' . $item . '</option>';
    }

    // $html = '
    // <div class="form-group">
    //     <label class="col-lg-2 control-label">'.$label.'</label>
    //     <div class="col-lg-9">
    //         <div class="btn-group">
    //             <button class="btn btn-sm btn-white dropdown-toggle" data-toggle="dropdown"><span class="dropdown-label">'.$dropdownLabel.'</span> <span class="caret"></span></button>
    //             <ul class="dropdown-menu dropdown-select">'.$itemsMarkup.'</ul>
    //         </div>
    //     </div>
    // </div>';

    $html = '
    <div class="form-group">
        <label class="col-lg-2 control-label">' . $label . '</label>
        <div class="col-lg-9">
            <select name="' . $name . '">' . $itemsMarkup . '</select>
        </div>
    </div>
    ';

    return $html;
});












