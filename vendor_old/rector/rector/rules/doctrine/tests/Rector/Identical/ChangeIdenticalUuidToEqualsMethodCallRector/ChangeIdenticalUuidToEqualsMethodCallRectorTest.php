<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Rector\Identical\ChangeIdenticalUuidToEqualsMethodCallRector;

use Iterator;
use Rector\Core\Testing\PHPUnit\AbstractRectorTestCase;
use Rector\Doctrine\Rector\Identical\ChangeIdenticalUuidToEqualsMethodCallRector;
use Symplify\SmartFileSystem\SmartFileInfo;

final class ChangeIdenticalUuidToEqualsMethodCallRectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(SmartFileInfo $file): void
    {
        $this->doTestFileInfo($file);
    }

    public function provideData(): Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    protected function getRectorClass(): string
    {
        return ChangeIdenticalUuidToEqualsMethodCallRector::class;
    }
}
