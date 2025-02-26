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

    private function verifyAndStore($file, $extension)
    {
        if (in_array($extension, $this->imageExtensions)) {
            return $this->storeImage($file, $extension);
        } elseif (in_array($extension, $this->documentExtensions)) {
            return $this->storeDocument($file, $extension);
        } else {
            return ['error' => 'Unknown file extension'];
        }
    }

    private function storeImage($file, $extension)
    {
        $originalNameWithExtension = $file->getClientOriginalName();
        $uniqueFileName = date('Y_m_d_H_i_s') . '_' . uniqid() . '.' . $extension;
        $directory = 'public/uploads/' . MediaTypeEnum::IMAGE . '/original';

        // Ensure the directory is created
        Storage::makeDirectory($directory);

        // Store the file in the specified directory
        Storage::putFileAs($directory, $file, $uniqueFileName);

        $this->storeImageSizes($file, $uniqueFileName);

        return $this->storeInDatabase($originalNameWithExtension, $uniqueFileName, MediaTypeEnum::IMAGE);
    }

    private function storeDocument($file, $extension)
    {
        $originalNameWithExtension = $file->getClientOriginalName();
        $uniqueFileName = date('Y_m_d_H_i_s') . '_' . uniqid() . '.' . $extension;
        $directory = 'public/uploads/' . MediaTypeEnum::FILE;

        // Ensure the directory is created
        Storage::makeDirectory($directory);

        // Store the file in the specified directory
        Storage::putFileAs($directory, $file, $uniqueFileName);

        // Store the file information in the database
        return $this->storeInDatabase($originalNameWithExtension, $uniqueFileName, MediaTypeEnum::FILE);
    }

    private function storeImageSizes($file, $fileName)
    {
        $imageSizes = config('common.imagesSizes');
        foreach ($imageSizes as $imageSize) {
            if (!$imageSize['convertable']) continue;

            $folderName = $imageSize['name'];
            $directory = 'public/uploads/' . MediaTypeEnum::IMAGE . '/' . $folderName;

            Storage::makeDirectory($directory);
            Storage::putFileAs($directory, $file, $fileName);
        }
    }

    private function storeInDatabase($displayName, $fileName, $type)
    {
        $fileData = [
            'display_name' => $displayName,
            'name' => $fileName,
            'type' => $type
        ];
        return $this->mediaRepositoryInterface->create($fileData);
    }
}
