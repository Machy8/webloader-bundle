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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


class Configuration implements ConfigurationInterface
{

	/**
	 * Generates the configuration tree builder.
	 *
	 * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
	 */
	public function getConfigTreeBuilder() : TreeBuilder
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('web_loader');

		$rootNode
			->children()
				->booleanNode('disableCache')->end()
				->scalarNode('documentRoot')->end()
				->scalarNode('outputDir')->end()

				->arrayNode('filesCollections')
					->arrayPrototype()
						->children()
							->arrayNode('cssFiles')
								->prototype('scalar')->end()
							->end()
							->arrayNode('cssFilters')
								->prototype('scalar')->end()
							->end()
							->booleanNode('cssLoadContent')
								->defaultFalse()
							->end()
							->arrayNode('cssOutputElementAttributes')
								->prototype('scalar')->end()
							->end()
							->arrayNode('jsFiles')
								->prototype('scalar')->end()
							->end()
							->arrayNode('jsFilters')
								->prototype('scalar')->end()
							->end()
							->booleanNode('jsLoadContent')
								->defaultFalse()
							->end()
							->arrayNode('jsOutputElementAttributes')
								->prototype('scalar')->end()
							->end()
						->end()
					->end()
				->end()

				->arrayNode('filesCollectionsContainers')
					->arrayPrototype()
						->children()
							->arrayNode('cssCollections')
								->prototype('scalar')->end()
							->end()
							->arrayNode('jsCollections')
								->prototype('scalar')->end()
							->end()
						->end()
					->end()
				->end()

				->arrayNode('pathPlaceholders')->end()
				->scalarNode('pathPlaceholderDelimiter')->end()
			->end();

		return $treeBuilder;
	}

}
