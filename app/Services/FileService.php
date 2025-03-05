<?php

namespace App\Services;

use Throwable;

class FileService
{
    const LIMIT_FILES_INSIDE_SOURCE_DIRECTORY = 4;

    public function uploadFile($request, string $sourcePath): void
    {
        try {
            if (!file_exists($sourcePath)) {
                mkdir($sourcePath, 0755, true);
            }

            $request->validate([
                'image' => 'required|array',
                'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                foreach ($files = $request->file('image') ?? [] as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move($sourcePath, $filename);
                }
                $this->removeExcessFiles($sourcePath);
            }

        } catch (Throwable $e) {
            dd('Error: ', $e->getMessage());
        }
    }

    public function removeLeaveTheLastOne(string $sourcePath)
    {
        $files = scandir($sourcePath);
        for ($i = 0; $i < count($files) -1; $i++) {
            if ($files[$i] !== '.' && $files[$i] !== '..') {
                $filePath = $sourcePath . '/' . $files[$i];
                if (is_file($filePath)) {
                    unlink($filePath);
                }
            }
        }
    }

    public function getAllFile(string $sourcePath): array
    {
        return scandir($sourcePath, 1);
    }

    public function getLastFile(string $sourcePath): string
    {
        return scandir($sourcePath, 1)[0];
    }

    public function removeExcessFiles(string $sourcePath)
    {
        $removeFiles = function($sourcePath) {
            if (count($this->getAllFile($sourcePath)) > self::LIMIT_FILES_INSIDE_SOURCE_DIRECTORY) {
                $this->removeLeaveTheLastOne($sourcePath);
            }
        };
        $removeFiles($sourcePath);
    }
}
