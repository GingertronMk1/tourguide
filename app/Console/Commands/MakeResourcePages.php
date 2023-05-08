<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeResourcePages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-resource-pages {resourceFolderName?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a set of resource pages under a given folder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->argument('resourceFolderName');
        while (! is_string($path)) {
            $path = $this->ask('What is the name of the resource?');
        }

        $filesToCreate = [
            'Components' => ['EditForm'],
            'Pages' => ['Create', 'Edit', 'Index', 'Show'],
        ];
        foreach ($filesToCreate as $dir => $fileNames) {
            $dirPath = resource_path("js/{$dir}/{$path}");
            foreach ($fileNames as $fileName) {
                $filePath = "{$dirPath}/{$fileName}.vue";
                if (is_file($filePath)) {
                    $this->info("{$filePath} already exists, skipping...");

                    continue;
                }

                $this->info("Creating {$filePath}");
                file_put_contents(
                    $filePath,
                    <<<'JS'
<script setup>

</script>
<template>
</template>

JS
                );
            }
        }
    }
}
