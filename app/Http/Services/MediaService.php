<?php

namespace App\Http\Services;

use App\Enums\MediaTypeEnum;
use App\Repositories\Media\MediaRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MediaService
{
    protected MediaRepositoryInterface $mediaRepositoryInterface;
    protected $imageExtensions = ['png', 'jpg', 'jpeg', 'svg', 'webp'];
    protected $documentExtensions = ['pdf', 'doc', 'docx', 'txt'];

    public function __construct(MediaRepositoryInterface $mediaRepositoryInterface)
    {
        $this->mediaRepositoryInterface = $mediaRepositoryInterface;
    }

    public function upload($request)
    {
        if (!$request->hasFile('file')) {
            throw new HttpException(422, 'File not found');
        }
        $file = $request['file'];
        $extension = strtolower($file->getClientOriginalExtension());

        $record = $this->verifyAndStore($file, $extension);
        if (isset($record['error'])) {
            throw new HttpException(422, $record['error']);
        }
        return $record;
    }
}
