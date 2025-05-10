<?php

declare(strict_types=1);

use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

pest()->extends(WebTestCase::class);

it('should sign in with  the correct credentials', function () {
    $client = $this->createClient();
    $client->request('GET', '/en/authentication/sign-in');

    $client->submitForm('Sign In', [
        'sign_in[email]' => 'user@example.com',
        'sign_in[password]' => 'password',
    ]);

    $this->assertResponseRedirects('http://localhost/en/dashboard');
});

test('redirects if user was already signed in', function () {
    $client = $this->createClient();

    $container = $this->getContainer();
    $userRepository = $container->get(UserRepositoryInterface::class);
    $user = $userRepository->findByUserIdentifier('user@example.com');

    $client->loginUser($user);
    $client->request('GET', '/en/authentication/sign-in');
    $this->assertResponseRedirects('/en/dashboard');
});
