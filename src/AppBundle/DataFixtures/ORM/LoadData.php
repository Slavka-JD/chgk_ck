<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

class LoadTeamPlayerData extends DataFixtureLoader
{
    public function load(ObjectManager $om)
    {
        Fixtures::load(__DIR__ . '/fixtures.yml', $om, array('providers' => array($this)));
    }

    public function playerName()
    {
        $names = array(
            'Зеленская Мирослава Викторовна',
            'Шевченко Анжелика Александровна',
            'Иванов Владимир Александрович',
            'Лавриненко Сергей Иванович',
            'Король Николай Николаевич',
            'Кукуев Максим Александрович',
            'Белецкий Виктор Владимирович',
            'Пунова Наталья Владимировна',
            'Баркар Дмитрий Валерьевич',
            'Хомченко Алексей Алексеевич',
            'Мищенко Вадим Николаевич',
            'Луценко Галина Васильевна ',
            'Шмидт Богдан',
            'Коробов Савва',
            'Киркиченко Алексей Алексеевич',
            'Головко Виктор Иванович',
            'Беляков Денис Олегович',
            'Геращенко Артём Григорьевич',
        );

        return $names[array_rand($names)];
    }

    public function playerTypeName()
    {
        $names = array(
            'капитан',
            'базовый игрок',
            'легионер',
        );
        return $names[array_rand($names)];
    }

    public function teamName()
    {
        $names = array(
            'Гешвадер',
            'Черкасское FIDO',
            'ВеЧерКом',
            'Пунктуальность',
            'Кварта',
            'Пионерская Зорька',
            'Случайное Явление',
            'Кусок Забора',
            'Сверкающее Воинство',
        );
        return $names[array_rand($names)];
    }

    public function teamTypeName()
    {
        $names = array(
            'взрослая',
            'молодежная',
            'школьная',
        );
        return $names[array_rand($names)];
    }

    public function tournamentName()
    {
        $names = array(
            'Кубок сирых и убогих',
            'Выездной Кубок /"Сами вы сирые и убогие/"',
            'Турнир имени Никиты Джигурды',
        );

        return $names[array_rand($names)];
    }

    protected function getFixtures()
    {
        return array(
            __DIR__ . '/fixtures.yml',
        );
    }
}