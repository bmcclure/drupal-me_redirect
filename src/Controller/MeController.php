<?php

namespace Drupal\me_redirect\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class MeController extends ControllerBase {
  public function me($user_path) {
    $userId = $uid = \Drupal::currentUser()->id();

    if (!empty($userId)) {
      // Logged in, replace "me" in path and redirect.
      $uri = '/user/' . $userId;

      if (!empty($user_path)) {
        $user_path = str_replace(':', '/', $user_path);

        $uri .= '/' . $user_path;
      }

      return new RedirectResponse($uri, 302);
    } else {
      // Not logged in, throw access denied.
      throw new AccessDeniedHttpException();
    }
  }
}
