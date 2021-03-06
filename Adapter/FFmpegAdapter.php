<?php

namespace AC\Component\Transcoding\Adapter;

use AC\Component\Transcoding\Preset;
use AC\Component\Transcoding\Adapter;
use AC\Component\Transcoding\File;
use AC\Component\Transcoding\FileHandlerDefinition;
use Symfony\Component\Process\Process;

/**
 * A ffmpeg adapter, see
 *
 * Written by Andrew Freix
 */
class FFmpegAdapter extends AbstractCliAdapter
{
    protected $key = "ffmpeg";
    protected $name = "FFmpeg";
    protected $description = "Uses ffmpeg presets to convert/edit audio, video, and image files.";

    /**
     * undocumented variable
     *
     * @var string Path to ffmpeg executable, received in constructor
     */
    private $ffmpeg_path;

    /**
     * FFmpeg needs a path to the `ffmpeg` executable
     *
     * @param string $ffmpeg_path
     * @param int    $timeout     Time in seconds for process timeout, null means no timeout
     */
    public function __construct($ffmpeg_path, $timeout = null)
    {
        parent::__construct(array(
            'timeout' => $timeout
        ));

        $this->ffmpeg_path = $ffmpeg_path;
    }

    /**
     * {@inheritdoc}
     */
    public function verifyEnvironment()
    {
        if (!file_exists($this->ffmpeg_path)) {
            throw new \RuntimeException(sprintf("Could not find ffmpeg executable, given path {%s}", $this->ffmpeg_path));
        }

        return true;
    }

    /**
     * Must receive binary files
     *
     * {@inheritdoc}
     */
    protected function buildInputDefinition()
    {
        return new FileHandlerDefinition(array(
            'requiredMimeEncodings' => array('binary'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildProcess(File $inFile, Preset $preset, $outFilePath)
    {
        //get builder with required options for in/out file
        $builder = $this->getProcessBuilder(array(
            $this->ffmpeg_path,
            '-i',
            $inFile->getPathname(),
            '-o',
            $outFilePath,
        ));

        //add preset options
        foreach ($preset->getOptions() as $key => $value) {
            if (!empty($key)) {
                $builder->add($key);
            }
            if (!empty($value)) {
                $builder->add($value);
            }
        }

        return $builder;
    }

}
