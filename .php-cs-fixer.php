<?php

use PhpCsFixer\Finder;

$gitIgnoreFiles = Finder::create()
    ->name('/^.gitignore$/')
    ->ignoreVCS(false)
    ->ignoreDotFiles(false)
    ->in(__DIR__)
;

$ignores = [];

foreach ($gitIgnoreFiles as $key => $file) {
    if (str_ends_with($key, '.gitignore')) {
        foreach(explode(PHP_EOL, $file->getContents()) as $ignore) {
            if (strlen($ignore) > 0) {
                $ignores[] = $ignore;
            }
        }
    }
}

$finder = Finder::create()->in(__DIR__);

foreach($ignores as $ignore) {
    if (str_starts_with($ignore, '/')) {
        $finder->exclude($ignore);
    } else {
        $finder->notName($ignore);
    }
}

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@PhpCsFixer' => true,
        'yoda_style' => false,
        'declare_strict_types' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
