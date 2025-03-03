<?php

namespace App\Quest\Infrastructure\DataFixture;

use App\Quest\Infrastructure\ORM\GenreORM;
use App\Quest\Infrastructure\ORM\QuestORM;
use App\Quest\Infrastructure\ORM\TagORM;
use App\Quest\Infrastructure\ORM\ThemeORM;
use App\Shared\Infrastructure\ORM\FileORM;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuestFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $genre = (new GenreORM())
            ->setName('Хоррор')
            ->setCode('horror');
        $genre2 = (new GenreORM())
            ->setName('Приключенческое')
            ->setCode('adventure');
        $theme1 = (new ThemeORM())
            ->setName('Для новичков')
            ->setCode('dlya-novichkov');
        $theme2 = (new ThemeORM())
            ->setName('Страшный')
            ->setCode('strashniy');
        $tag1 = (new TagORM())
            ->setName('4-5 человек');
        $tag2 = (new TagORM())
            ->setName('60 минут');
        $file1 = (new FileORM())
            ->setName('photo1.png')
            ->setUrl('/public/img/photo1.png');
        $file2 = (new FileORM())
            ->setName('photo2.png')
            ->setUrl('/public/img/photo2.png');

        $manager->persist($genre);
        $manager->persist($genre2);
        $manager->persist($theme1);
        $manager->persist($theme2);
        $manager->persist($tag1);
        $manager->persist($tag2);
        $manager->persist($file1);
        $manager->persist($file2);

        $quest = (new QuestORM())
            ->setName('Квест "Джуманджи"')
            ->setDescription(
                'Квест «Джуманджи» в городе Тюмень — это квест для всей семьи.
                  В квесте «Джуманджи» жанр: фантастически-приключенческий.'
            )
            ->setCode('jumanji')
            ->setSeatsCount(5)
            ->setDateEvent(new \DateTimeImmutable('31.05.2024'))
            ->setDateFinalAppointment(new \DateTimeImmutable('29.05.2024'))
            ->setGenre($genre)
            ->addTag($tag1)
            ->addTag($tag2)
            ->addTheme($theme1)
            ->addTheme($theme2)
            ->addGallery($file1)
            ->addGallery($file2);

        $quest2 = (new QuestORM())
            ->setName('Форт Боярд')
            ->setDescription('Готовьтесь к тому, что в первую очередь
            будут задействованы ваши руки и ноги, а не голова.
            Внутри вас ждет большое количество командных испытаний, которые приведут к золоту форта Боярд.')
            ->setCode('fort-boyard')
            ->setSeatsCount(12)
            ->setDateEvent(new \DateTimeImmutable('12.06.2024'))
            ->setDateFinalAppointment(new \DateTimeImmutable('05.06.2024'))
            ->setGenre($genre2);

        $manager->persist($quest);
        $manager->persist($quest2);

        $manager->flush();
    }
}
