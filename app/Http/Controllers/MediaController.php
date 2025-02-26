<?php

namespace App\Http\Controllers;

use App\Classes\ErrorResponse;
use App\Http\Requests\MediaRequest;
use App\Http\Resources\MediaResource;
use App\Http\Resources\SuccessResource;
use App\Http\Services\MediaService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MediaController extends Controller
{
    protected MediaService $mediaService;

    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function upload(MediaRequest $request)
    {
        try {
            $data = $this->mediaService->upload($request);
            return new SuccessResource([
                'message' => 'Media uploaded successfully!',
                'data' => new MediaResource($data)]);
        } catch (HttpException $e) {
            ErrorResponse::throwException($e);
        }
    }
}
