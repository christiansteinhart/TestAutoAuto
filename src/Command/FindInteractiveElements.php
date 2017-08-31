<?php

namespace TestAutoAuto\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TestAutoAuto\Entity\TestElement;
use TestAutoAuto\InteractiveElementFinder\InteractiveElementFinder;
use TestAutoAuto\WebDriver\WebdriverFactory;

class FindInteractiveElements extends Command
{
    /**
     * @var WebdriverFactory
     */
    private $webDriverFactory;

    /**
     * @var InteractiveElementFinder
     */
    private $finder;

    /**
     * @param null|string $name
     * @param WebdriverFactory $webDriverFactory
     * @param InteractiveElementFinder $finder
     */
    public function __construct($name, WebdriverFactory $webDriverFactory, InteractiveElementFinder $finder)
    {
        parent::__construct($name);
        $this->webDriverFactory = $webDriverFactory;
        $this->finder = $finder;
    }


    protected function configure()
    {
        $this->setDescription('Find interactive HTML Elements an a page.')
            ->addArgument('url', InputArgument::REQUIRED, 'The URL of the page');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');

        $driver = $this->webDriverFactory->getChromeDriver();

        $driver->get($url);

        $elements = $this->finder->findElements($driver);

        $driver->close();

        $output->writeln("The following interacte elements with locators have been found:");
        /** @var TestElement $element */
        foreach ($elements as $element) {
            $output->writeln( $element->getLocator());
        }

        if (empty($elements)) {
            $output->writeln("<error>No elements have been found.</error>");
        }
    }
}