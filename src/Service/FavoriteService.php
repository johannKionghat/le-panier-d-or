<?php
namespace App\Service;

use App\Entity\Favorite;
use App\Entity\User;
use App\Entity\Annonce;
use App\Entity\Favorites;
use App\Entity\Listings;
use Doctrine\ORM\EntityManagerInterface;

class FavoriteService
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function addFavorite(User $user, Listings $annonce): void
    {
        $favorite = new Favorites();
        $favorite->setUser($user);
        $favorite->setListning($annonce);

        $this->em->persist($favorite);
        $this->em->flush();
    }

    public function removeFavorite(User $user, Listings $annonce): void
    {
        $favorite = $this->em->getRepository(Favorites::class)->findOneBy([
            'user' => $user,
            'listning' => $annonce,
        ]);

        if ($favorite) {
            $this->em->remove($favorite);
            $this->em->flush();
        }
    }

    public function isFavorite(User $user, Listings $annonce): bool
    {
        return (bool) $this->em->getRepository(Favorites::class)->findOneBy([
            'user' => $user,
            'listning' => $annonce,
        ]);
    }
}
