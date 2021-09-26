<?php

namespace App\Services\Integration\Dto;

use Illuminate\Http\UploadedFile;

class IntegrationCreateDto
{
    /**
     * @var UploadedFile
     */
    private UploadedFile $file;

    /**
     * @param UploadedFile $file
     */
    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): UploadedFile
    {
        return $this->file;
    }

}
