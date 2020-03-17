<?php

namespace App\Application;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormView;

/**
 * Class RequestFormValidationHelper
 * @package App\Application
 */
class RequestFormValidationHelper
{
    /**
     * @param FormView $formView
     * @return array
     */
    public static function getFlatArrayErrors(FormView $formView): array
    {
        $values = [];

        /** @var FormView $subView */
        foreach ($formView->vars['form']->children as $subView) {
            if (count($subView->children)) {
                $values = array_merge($values, static::getFlatArrayErrors($subView));
            } elseif (!empty($subView->vars['errors'])) {
                foreach ($subView->vars['errors'] as $error) {
                    /** @var FormError $error */
                    $values[$subView->vars['id']][] = $error->getMessage();
                }
            }
        }

        return $values;
    }
}
