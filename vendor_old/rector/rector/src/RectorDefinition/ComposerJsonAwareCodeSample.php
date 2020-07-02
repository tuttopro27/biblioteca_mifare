<?php

declare(strict_types=1);

namespace Rector\Core\RectorDefinition;

use Rector\Core\Contract\RectorDefinition\CodeSampleInterface;

final class ComposerJsonAwareCodeSample implements CodeSampleInterface
{
    /**
     * @var string
     */
    private $codeBefore;

    /**
     * @var string
     */
    private $codeAfter;

    /**
     * @var string
     */
    private $composerJsonContent;

    /**
     * @var string|null
     */
    private $extraFileContent;

    public function __construct(
        string $codeBefore,
        string $codeAfter,
        string $composerJsonContent,
        ?string $extraFileContent = null
    ) {
        $this->codeBefore = $codeBefore;
        $this->codeAfter = $codeAfter;
        $this->composerJsonContent = $composerJsonContent;
        $this->extraFileContent = $extraFileContent;
    }

    public function getCodeBefore(): string
    {
        return $this->codeBefore;
    }

    public function getCodeAfter(): string
    {
        return $this->codeAfter;
    }

    public function getComposerJsonContent(): string
    {
        return $this->composerJsonContent;
    }

    public function getExtraFileContent(): ?string
    {
        return $this->extraFileContent;
    }
}
