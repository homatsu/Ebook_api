<?php

namespace App\DataFixtures;

use App\Entity\Lesson;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LessonFixtures extends BaseFixture implements DependentFixtureInterface
{
    private static $lessonTitle = [
        'Temat 1 taki sobie',
        'Temat 2 taki sobie',
        'Temat 3 jest jaki jest',
    ];

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(75, 'lessons', function () {
            $lesson = new Lesson();
            $lesson->setTitle($this->faker->randomElement(self::$lessonTitle));
            $lesson->setContent('<p>Oddziaływanie elektromagnetyczne ma fundamentalne znaczenie, bo pozwala wyjaśnić nie tylko zjawiska elektryczne, ale też siły zespalające materię na poziomie atomów, cząsteczek.</p>

        <p>Istnienie ładunków można stwierdzić w najprostszym znanym nam powszechnie zjawisku elektryzowania się ciał. Doświadczenie pokazuje, że w przyrodzie mamy do czynienia z dwoma rodzajami ładunków: dodatnimi i ujemnymi oraz że ładunki jednoimienne odpychają się, a różnoimienne przyciągają się.
        </p>

        <div class="openaghdefinition openaghdefinition-pl">
                <div class="openaghdefinition-name">
                    <h4>Definicja 1: Jednostka ładunku</h4>
                </div>
                <div class="openaghdefinition-data">
                    W układzie SI jednostką ładunku jest kulomb (C). Jest to ładunek przenoszony przez prąd o natężeniu 1 ampera w czasie sekundy 1 C = 1 A·s.
                </div>
        </div>

        <p><br />Również doświadczalnie stwierdzono, że żadne naładowane ciało nie może mieć ładunku mniejszego niż ładunek elektronu czy protonu. Ładunki te równe co do wartości bezwzględnej nazywa się ładunkiem elementarnym  \( e=1.6·10^{-19} \) C. Wszystkie realnie istniejące ładunki są wielokrotnością ładunku  \( e \). Jeżeli wielkość fizyczna, taka jak ładunek elektryczny, występuje w postaci określonych "porcji" to mówimy, że wielkość ta jest skwantowana.
        </p>

        <p>Jednym z podstawowych praw fizyki jest zasada zachowania ładunku. Zasada ta, sformułowana przez Franklina, mówi, że
        </p>

        <div class="openaghlaw openaghlaw-pl">
            <div class="openaghlaw-name">
                <h4>Prawo 1: Zasada zachowania ładunku</h4>
            </div>
            <br>
            <div class="openaghlaw-data">
                Wypadkowy ładunek elektryczny w układzie zamkniętym jest stały.
            </div>
        </div>

        <div class="openaghsimulation openaghsimulation-pl" fileId="1261">
            <h4>Symulacja 1: Balony i elektrostatyka</h4>
            <a href="tiki-download_file.php?fileId=1261">Pobierz symulację</a>
            <p>Program przedstawia elektryzowanie się ciał na przykładzie balonu pocieranego o sweter.</p>
            <p class="description-image">
                Autor: 
                <a class="wiki external" target="_blank" href="http://phet.colorado.edu" rel="external nofollow">PhET Interactive Simulations University of Colorado</a>
                <img src="img/icons/external_link.gif" alt="(external link)" width="15" height="14" title="(external link)" class="icon" />
            </p>
            <p class="description-image">
                Licencja: 
                <a class="wiki external" target="_blank" href="https://creativecommons.org/licenses/by/3.0/us/" rel="external nofollow">
                    Creative Commons Attribution 3.0 United States
                </a>
                <img src="img/icons/external_link.gif" alt="(external link)" width="15" height="14" title="(external link)" class="icon" />
            </p>
        </div>
');
            $lesson->setChapter($this->getRandomReference('chapters'));

            return $lesson;
        });

        $manager->flush();
    }

    public function getDependencies()
    {
       return [
           ChapterFixtures::class
       ];
    }
}
