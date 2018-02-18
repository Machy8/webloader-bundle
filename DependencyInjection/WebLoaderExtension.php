<?php

/**
 *
 * Copyright (c) Vladimír Macháček
 *
 * For the full copyright and license information, please view the file license.md
 * that was distributed with this source code.
 *
 */

declare(strict_types = 1);

namespace WebLoader\WebLoaderBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;


class WebLoaderExtension extends Extension
{

	/**
	 * @throws \InvalidArgumentException When provided tag is not defined in this extension
	 */
	public function load(array $configs, ContainerBuilder $container)
	{
		$configuration = new Configuration();
		$config = $this->processConfiguration($configuration, $configs);

		$loader = new YamlFileLoader (
			$container,
			new FileLocator(__DIR__.'/../Resources/config')
		);

		$loader->load('services.yaml');

		/* @var Definition $webLoader*/
		$webLoader = $container->getDefinition('web_loader');

		if (isset($config['disableCache']) && $config['disableCache']) {
			$webLoader->addMethodCall('disableCache');
		}

		if (isset($config['documentRoot'])) {
			$webLoader->addMethodCall('setDocumentRoot', [$config['documentRoot']]);
		}

		if (isset($config['filesCollections'])) {
			$webLoader->addMethodCall('createFilesCollectionsFromArray', [$config['filesCollections']]);
		}

		if (isset($config['filesCollectionsContainers'])) {
			$webLoader->addMethodCall(
				'createFilesCollectionsContainersFromArray', [$config['filesCollectionsContainers']]
			);
		}

		if (isset($config['outputDir'])) {
			$webLoader->addMethodCall('setOutputDir', [$config['outputDir']]);
		}

		if (isset($config['pathPlaceholderDelimiter'])) {
			$webLoader->addMethodCall('setPathPlaceholderDelimiter', [$config['pathPlaceholderDelimiter']]);
		}

		if (isset($config['pathPlaceholders'])) {
			$webLoader->addMethodCall('addPathsPlaceholders', [$config['pathPlaceholders']]);
		}
	}

}
