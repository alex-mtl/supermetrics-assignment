<?php

declare(strict_types = 1);

namespace Tests\unit;

use PHPUnit\Framework\TestCase;
use SocialPost\Dto\SocialPostTo;
use Statistics\Calculator\AveragePostsPerUser;
use Statistics\Dto\ParamsTo;

/**
 * Class ATestTest
 *
 * @package Tests\unit
 */
class TestAveragePostsPerUser extends TestCase
{
    private AveragePostsPerUser $userCalc;

    protected function setUp(): void
    {
        $this->userCalc = (new AveragePostsPerUser())->setParameters((new ParamsTo())->setStatName('TestAveragePostsPerUser'));
    }

    /**
     * @test

     */
    /**
     * @param array|null $data
     * @param int|null $result
     * @dataProvider dataProvider
     */
    public function testAveragePostsPerUser(array $data, int $result): void
    {
        foreach ($data as $postData) {
            $post = new SocialPostTo();
            $post->setAuthorId($postData['authorId']);
            $post->setId(uniqid());
            $this->userCalc->accumulateData($post);
        }
        $this->assertEquals($result, $this->userCalc->calculate()->getValue());
    }

    public function dataProvider(): array {
        return [
            "No data" => [[], 0],
            "1 user 3 posts" => [
                [
                    ['authorId' => "1"],
                    ['authorId' => "1"],
                    ['authorId' => "1"]
                ],
                3
            ],
            "3 users 3 posts" => [
                [
                    ['authorId' => "1"],
                    ['authorId' => "2"],
                    ['authorId' => "3"]
                ],
                1
            ],
            "3 users 12 posts" => [
                [
                    ['authorId' => "1"],
                    ['authorId' => "1"],
                    ['authorId' => "1"],
                    ['authorId' => "1"],
                    ['authorId' => "2"],
                    ['authorId' => "2"],
                    ['authorId' => "3"],
                    ['authorId' => "3"],
                    ['authorId' => "2"],
                    ['authorId' => "2"],
                    ['authorId' => "3"],
                    ['authorId' => "3"],
                ],
                4
            ],
        ];
    }
}
