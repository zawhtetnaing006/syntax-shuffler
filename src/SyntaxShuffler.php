<?php

namespace Zaw\SyntaxShuffler;

class SyntaxShuffler
{
    public function shuffleVariables($code)
    {
        return preg_replace('/\$(\w+)/', '$var_' . rand(1000, 9999), $code);
    }

    public function shuffleFunctionNames($code)
    {
        return preg_replace('/function (\w+)/', 'function fn_' . rand(1000, 9999), $code);
    }

    public function shuffleComments($code)
    {
        return preg_replace('/\/\/.+/', '// Shuffled Comment', $code);
    }

    public function shuffleFile($filePath)
    {
        $code = file_get_contents($filePath);
        $code = $this->shuffleVariables($code);
        $code = $this->shuffleFunctionNames($code);
        $code = $this->shuffleComments($code);
        file_put_contents($filePath, $code);
    }

    public function shuffleDirectory($directory)
    {
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory));

        foreach ($files as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $this->shuffleFile($file->getRealPath());
                echo "Shuffled: " . $file->getRealPath() . PHP_EOL;
            }
        }
    }
}
