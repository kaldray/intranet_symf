<?php

namespace App\Services;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Filesystem\Filesystem;

class FileService
{
    public function __construct(
        #[Autowire('%kernel.project_dir%/public/uploads/contrats')]
        private string           $baseDirectory,
        private SluggerInterface $slugger,
        private Filesystem        $filesystem,
    )
    {
    }

    public function upload(UploadedFile $file, int $user_id)
    {

        $userDirectory = $this->baseDirectory . '/' . $user_id;

        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);

        if (!file_exists($userDirectory)) {
            mkdir($userDirectory, 0777, true);
        }

        $filename =  $safeFilename . '_' . uniqid() . '_' . $file->guessExtension();

        try {
            $file->move($userDirectory, $filename);
        } catch (FileException $e) {

        }
        return $filename;
    }

    public function delete(string $path, int $user_id)
    {
        $filename = $this->baseDirectory . '/' . $user_id . '/' . $path;
        $this->filesystem->remove($filename);
    }
}