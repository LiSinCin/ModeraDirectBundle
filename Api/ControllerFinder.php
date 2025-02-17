<?php

namespace Modera\DirectBundle\Api;

use Symfony\Component\Finder\Finder;

class ControllerFinder
{
    /**
     * Find all controllers from a bundle.
     * 
     * @param \Symfony\HttpKernel\Bundle\Bundle $bundle
     *
     * @return mixed
     */
    public function getControllers($bundle)
    {
        $dir = $bundle->getPath().'/Controller';
        $controllers = array();

        if (is_dir($dir)) {
            $finder = new Finder();
            $finder->files()->in($dir)->name('*Controller.php');

            foreach ($finder as $file) {
                if ($file->getRelativePath() === 'Base') {
                    continue;
                }
                $name = explode('.', $file->getFileName());
                $class = $bundle->getNamespace().'\\Controller\\'.$name[0];
                $controllers[] = $class;
            }
        }

        return $controllers;
    }
}
