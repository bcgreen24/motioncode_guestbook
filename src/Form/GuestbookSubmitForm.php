<?php

namespace Drupal\guestbook\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class GuestbookSubmitForm extends FormBase
{

    public function getFormId()
    {
        return 'guestbook_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['name'] = array(
            '#type' => 'textfield',
            '#title' => t('Enter name'),
            '#required' => TRUE
        );

        $form['message'] = array(
            '#type' => 'textfield',
            '#title' => t('Enter message'),
            '#required' => TRUE
        );

        $form['actions']['#type'] = 'actions';

        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Sign Guestbook'),
            '#button_type' => 'primary'        
        );

        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $database = \Drupal::database();
        $database->insert('guestbook');
        $fields = ['name' => $form_state->getValue('name'),
        'message' => $form_state->getValue('message'),
        'date' => date('d-m-y h:i:s')
        ];
        $database->insert('guestbook')->fields($fields)->execute();
        $form_state->setRedirect('guestbook.view');
        return;
    }

    
}
