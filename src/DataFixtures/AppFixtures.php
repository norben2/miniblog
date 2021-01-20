<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Mime\Encoder\EncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        for ($u = 0; $u < 10; $u++) {
            $user = new User();
            $passHash = $this->encoder->encodePassword($user, 'password');

            $user->setEmail($faker->email)
                ->setPassword($passHash);

            $manager->persist($user);

            for ($a = 0; $a < mt_rand(5, 15); $a++) {
                $article = new Article();
                $article->setName($faker->text(50))
                    ->setContent($faker->text(300));
                $manager->persist($article);
            }
            $manager->flush();
        }





        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
