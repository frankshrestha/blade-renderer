<?php

namespace abitofmaya\BladeRenderer;

use Illuminate\View\View;
use Illuminate\View\Factory;
use Illuminate\Events\Dispatcher;
use Illuminate\View\FileViewFinder;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Compilers\BladeCompiler;

class BladeRenderer
{
    private Factory $factory;

    public function __construct()
    {
        $basePath = getcwd() . '/../';

        $viewPath =  realpath($basePath . 'resources/views');
        $cachePath = realpath($basePath . 'storage/framework/views');

        $engineResolver = new EngineResolver();

        $engineResolver->register(
            'blade',
            fn() => new CompilerEngine(
                new BladeCompiler(
                    new Filesystem(),
                    $cachePath,
                    $basePath
                )
            )
        );

        $fileViewFinder = new FileViewFinder(new Filesystem(), [$viewPath]);

        $this->factory = new Factory($engineResolver, $fileViewFinder, new Dispatcher());
    }

    public function view(string $view, array $data = []): View
    {
        return $this->factory->make($view, $data);
    }
}
