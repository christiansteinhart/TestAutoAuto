<?php

namespace TestAutoAuto\Command;

use Facebook\WebDriver\WebDriverBy;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TestAutoAuto\Entity\TestCase;
use TestAutoAuto\Entity\TestElement;
use TestAutoAuto\Entity\TestStep;
use TestAutoAuto\Helper\CapabilityInvestigator;
use TestAutoAuto\InteractiveElementFinder\InteractiveElementFinder;
use TestAutoAuto\Status\Status;
use TestAutoAuto\WebDriver\WebdriverFactory;

class GenerateTests extends Command
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
     * @var CapabilityInvestigator
     */
    private $investigator;

    /**
     * @param null|string $name
     * @param WebdriverFactory $webDriverFactory
     * @param InteractiveElementFinder $finder
     * @param CapabilityInvestigator $investigator
     */
    public function __construct(
        $name,
        WebdriverFactory $webDriverFactory,
        InteractiveElementFinder $finder,
        CapabilityInvestigator $investigator
    ) {
        parent::__construct($name);
        $this->webDriverFactory = $webDriverFactory;
        $this->finder = $finder;
        $this->investigator = $investigator;
    }

    protected function configure()
    {
        $this->setDescription('Create tests from an URL')
            ->addArgument('url', InputArgument::REQUIRED, 'The URL of the page')
            ->addArgument('element', InputArgument::OPTIONAL, 'CSS Selector of an element');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');
        $elementLocator = $input->getArgument('element');
        $driver = $this->webDriverFactory->getChromeDriver();


        $elements = $this->getTestElements($driver, $url, $elementLocator);

        $testCases = [];
        foreach ($elements as $testElement) {
            $this->investigator->getCapabilities($testElement);

            foreach ($testElement->getTestCases() as $interaction) {
                $testStep = new TestStep();
                $testStep->setElement($testElement);
                $testStep->setInteraction($interaction);

                $testCase = new TestCase();
                $testCase->setUrl($url);
                $testCase->setStep($testStep);

                $testDriver = $this->webDriverFactory->getChromeDriver();
                $testCase->execute($testDriver);
                $statusAfter = Status::createFromDriver($driver);
                $testCase->setResult($statusAfter);
                $testDriver->close();

                $testCases[] = $testCase;
            }
        }

        $driver->close();

        $i = 1;
        $testMethods = '';

        /** @var TestCase $case */
        foreach ($testCases as $case) {
            $methodCode = '';
            $methodCode .= "\t" . 'public function testCase' . $i . '() {' . PHP_EOL;
            $methodCode .= $case->generateExecutionCode('$this->driver') . PHP_EOL;
            $methodCode .= $case->generateVerificationCode('$this->driver') . PHP_EOL;
            $methodCode .= "\t" . '}' . PHP_EOL . PHP_EOL;
            $testMethods .= $methodCode;
            $i++;
        }

        $testClassTemplateString = include __DIR__ . '/../TestWriter/templates/TestTemplate.php';

        $testClassName = 'AutoTestTest';

        $testClassString = sprintf(
            $testClassTemplateString,
            $testClassName,
            $testMethods
        );

        file_put_contents(
            __DIR__ . '/../../Tests/' . $testClassName . '.php',
            $testClassString
        );
    }

    /**
     * @param $driver
     * @param $url
     * @param $elementLocator
     * @return TestElement[]
     */
    protected function getTestElements($driver, $url, $elementLocator = null)
    {

        $driver->get($url);
        if ($elementLocator === null) {
            $elements = $this->finder->findElements($driver);
        } else {
            $selectedElement = $driver->findElement(WebDriverBy::cssSelector($elementLocator));
            $testElement = new TestElement();
            $testElement->setLocator($elementLocator);
            $testElement->setElement($selectedElement);
            $elements = [
                $testElement
            ];
        }

        return $elements;
    }


}