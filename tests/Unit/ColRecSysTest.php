<?php

namespace Tests\Unit;


use PHPUnit\Framework\TestCase;
use App\Services\CollaborativeRecommenderSystem;
use function PHPUnit\Framework\assertIsArray;
//use function PHPUnit\Framework\assertInstanceOf;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CollaborativeRecommenderSystemTest extends TestCase {

    protected function setUp(): void {
        parent::setUp();
        $this->sut = new CollaborativeRecommenderSystem();
    }

    public function test_system_exists() {
        return $this->assertInstanceOf(CollaborativeRecommenderSystem::class, $this->sut);
    }
}
