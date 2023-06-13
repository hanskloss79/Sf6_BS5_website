<?php

namespace App\DataFixtures;

use App\Entity\PricingPlan;
use App\Entity\PricingPlanBenefit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PricingPlanFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $firstPlanBenefits = ['10 użytkowników w zestawie', '2 GB pamięci', 'Wsparcie mailowe',
            'Dostęp do centrum pomocy'
        ];
        
        $firstPricingPlan = new PricingPlan();
        $firstPricingPlan->setName('Darmowy');
        $firstPricingPlan->setPrice(0);
        foreach ($firstPlanBenefits as $benefit) 
        {
            $newBenefit = new PricingPlanBenefit();
            $newBenefit->setName($benefit);
            $manager->persist($newBenefit);
            $firstPricingPlan->addBenefit($newBenefit);
        }

        $secondPlanBenefits = ['20 użytkowników w zestawie', '10 GB pamięci', 
        'Priorytetowe wsparcie mailowe', 'Dostęp do centrum pomocy'];
        
        $secondPricingPlan = new PricingPlan();
        $secondPricingPlan->setName('Profi');
        $secondPricingPlan->setPrice(60);
        foreach ($secondPlanBenefits as $benefit) 
        {
            $newBenefit = new PricingPlanBenefit();
            $newBenefit->setName($benefit);
            $manager->persist($newBenefit);
            $secondPricingPlan->addBenefit($newBenefit);
        }

        $manager->persist($firstPricingPlan);
        $manager->persist($secondPricingPlan);
        $manager->flush();
    }
}
