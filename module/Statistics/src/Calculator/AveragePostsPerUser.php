<?php

declare(strict_types = 1);

namespace Statistics\Calculator;

use SocialPost\Dto\SocialPostTo;
use Statistics\Dto\StatisticsTo;

class AveragePostsPerUser extends AbstractCalculator
{

    protected const UNITS = 'posts';

    /**
     * @var array
     */
    private $authors = [];

    /**
     * @var int
     */
    private $postCount = 0;

    /**
     * @inheritDoc
     */
    protected function doAccumulate(SocialPostTo $postTo): void
    {
        $this->authors[$postTo->getAuthorId()] = true;
        $this->postCount++;
    }

    /**
     * @inheritDoc
     */
    protected function doCalculate(): StatisticsTo
    {
        $value = $this->postCount > 0
            ? $this->postCount / count($this->authors)
            : 0;

        return (new StatisticsTo())->setValue(round($value,0));
    }
}
