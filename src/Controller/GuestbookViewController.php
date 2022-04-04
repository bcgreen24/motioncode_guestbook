<?php

namespace Drupal\guestbook\Controller;

use Drupal\Core\Controller\ControllerBase;

class GuestbookViewController extends ControllerBase
{

    public function guestbook()
    {
        
        $database = \Drupal::database();
        $result = $database->query("SELECT * FROM {guestbook}");
        return [
            '#theme' => 'guestbook-template',
            '#entries' => $result->fetchAll(),
            '#cache' => [
                'max-age' => 0
            ],
            '#attached' => [
                'library' => [
                    'guestbook/guestbook-library'
                ]
            ]
        ];
    }
}
