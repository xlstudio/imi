<?php

declare(strict_types=1);

namespace Imi\Server\Http\Message;

use Imi\Util\Stream\FileStream;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;

class UploadedFile implements UploadedFileInterface
{
    /**
     * 临时文件名.
     */
    protected ?string $tmpFileName = null;

    /**
     * 文件流
     */
    protected ?StreamInterface $stream = null;

    /**
     * 文件是否被移动过.
     */
    protected bool $isMoved = false;

    /**
     * @param string|StreamInterface $tmpFileName
     */
    public function __construct(
        /**
         * 文件在客户端时的文件名.
         */
        protected string $fileName,
        /**
         * 文件mime类型.
         */
        protected string $mediaType, $tmpFileName,
        /**
         * 文件大小，单位：字节
         */
        protected int $size,
        /**
         * 错误码
         */
        protected int $error)
    {
        if ($tmpFileName instanceof StreamInterface)
        {
            $this->stream = $tmpFileName;
        }
        else
        {
            $this->tmpFileName = $tmpFileName;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getStream(): StreamInterface
    {
        return $this->stream ??= new FileStream($this->tmpFileName);
    }

    /**
     * {@inheritDoc}
     */
    public function moveTo(string $targetPath): void
    {
        if (!\is_string($targetPath))
        {
            throw new \InvalidArgumentException('$targetPath specified is invalid');
        }
        if ($this->isMoved)
        {
            throw new \RuntimeException('$file can not be moved');
        }
        if (null === $this->tmpFileName)
        {
            $this->isMoved = false;
            $srcStream = $this->getStream();
            $srcStream->rewind();
            $targetStream = new FileStream($targetPath);
            while ('' !== ($content = $srcStream->read(4096)))
            {
                $targetStream->write($content);
            }
            $targetStream->close();
            $this->isMoved = true;
        }
        else
        {
            if (is_uploaded_file($this->tmpFileName))
            {
                $this->isMoved = move_uploaded_file($this->tmpFileName, $targetPath);
            }
            else
            {
                $this->isMoved = rename($this->tmpFileName, $targetPath);
            }
        }
        if (!$this->isMoved)
        {
            throw new \RuntimeException(sprintf('File %s move to %s failed', $this->tmpFileName, $targetPath));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * {@inheritDoc}
     */
    public function getError(): int
    {
        return $this->error;
    }

    /**
     * {@inheritDoc}
     */
    public function getClientFilename(): ?string
    {
        return $this->fileName;
    }

    /**
     * {@inheritDoc}
     */
    public function getClientMediaType(): ?string
    {
        return $this->mediaType;
    }

    /**
     * Get 临时文件名.
     */
    public function getTmpFileName(): ?string
    {
        return $this->tmpFileName;
    }
}
