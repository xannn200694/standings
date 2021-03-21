<?php

namespace App;

use Acelaya\Doctrine\Type\PhpEnumType;
use App\Domain\Entity\Championship\ChampionshipStatus;
use App\Domain\Entity\Playoff\PlayoffMatchStep;
use App\Domain\Entity\Playoff\PlayoffStep;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/services.yaml')) {
            $container->import('../config/services.yaml');
            $container->import('../config/{services}_'.$this->environment.'.yaml');
        } elseif (is_file($path = \dirname(__DIR__).'/config/services.php')) {
            (require $path)($container->withPath($path), $this);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import('../config/{routes}/*.yaml');

        if (is_file(\dirname(__DIR__).'/config/routes.yaml')) {
            $routes->import('../config/routes.yaml');
        } elseif (is_file($path = \dirname(__DIR__).'/config/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }
    }

    public function boot(): void
    {
        $dbalTypes = [
            'championship_status' => ChampionshipStatus::class,
            'playoff_step' => PlayoffStep::class,
            'playoff_match_step' => PlayoffMatchStep::class,
        ];

        foreach ($dbalTypes as $name => $class) {
            if (! PhpEnumType::hasType($name)) {
                PhpEnumType::registerEnumType($name, $class);
            }
        }

        parent::boot();
    }
}
